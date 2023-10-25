<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //direct post
    public function index(){
        $category = Category::get();
        $post = Post::get();
        return view('admin.post.index',compact('category','post'));
    }
    //create post
    public function createPost(Request $request){
       $validator = $this->checkPostValidation($request);
       if($validator->fails()){
        return back()->withErrors($validator)->withInput();
       }
       if(!empty($request->postImage)){
        $file = $request->file('postImage');
        $fileName = uniqid().'_'.$file->getClientOriginalName();
        $file->move(public_path().'/postImage',$fileName);
        $data = $this->getPostData($request, $fileName);
       }else{
        $data = $this->getPostData($request, NULL);
       }
       Post::create($data);

       return back();
    }
    //delete post
    public function deletePost($id){
        $postImage = Post::where('id',$id)->first();
        $dbImageName = $postImage['image'];
        Post::where('id',$id)->delete();//delete post in database
        if(File::exists(public_path().'/postImage/'.$dbImageName)){ //delete image
            File::delete(public_path().'/postImage/'.$dbImageName);
        }
        return back();
    }
    //update post
    public function updatePost($id, Request $request){
        $validator = $this->checkPostValidation($request);
           if($validator->fails()){
            return back()->withErrors($validator)->withInput();
           }
        $data = $this->requestUpdatePostData($request);//my changes // change getpostdata and delete id

       if(isset($request->postImage)){
        $this->storeNewUpdateImage($id,$request,$data);
       }else{
        Post::where('id',$id)->update($data);
       }
       return back();
    }
    //post update page
    public function postUpdatePage($id){
        $post = Post::get();
        $postDetails = Post::where('id',$id)->first();
        $category = Category::get();
        // dd($postDetails->toArray());
        return view('admin.post.update',compact('postDetails','category','post'));
    }
    //update post data
    private function requestUpdatePostData($request){
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'category_id' => $request->postCategory,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
    //post image data
    private function getPostData($request,$fileName){
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'image' => $fileName,
            'category_id' => $request->postCategory,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
    //store new update data
    private function storeNewUpdateImage($id,$request,$data){
        //get from client
        $file = $request->file('postImage');
        $fileName = uniqid().'_'.$file->getClientOriginalName();
        //put new image to data array
        $data['image'] = $fileName;

        //get image name from database
        $postImage = Post::where('id',$id)->first();
        $dbImageName = $postImage['image'];
       //delete image from public folder
        if(File::exists(public_path().'/postImage/'.$dbImageName)){ //delete image
            File::delete(public_path().'/postImage/'.$dbImageName);
        }
        //store new image
        $file->move(public_path().'/postImage',$fileName);
        //update data with image
        Post::where('id',$id)->update($data);
    }
    //post validation check
    private function checkPostValidation($request){
        $validationRules = [
            'postTitle' => 'required',
            'postDescription' => 'required',
            // 'postImage' => 'required',
            'postCategory' => 'required'
        ];
        $validationMsg = [
            'postTitle.required' => 'Please fill post field!',
            'postDescription.required' => 'Please fill  post description field',
            // 'postImage.required' => 'Please fill post field!',
            'postCategory.required' => 'Please fill post field!',
        ];
        return Validator::make($request->all(), $validationRules, $validationMsg);

    }
}
