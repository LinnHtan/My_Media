<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
    //get all post
    public function getAllPost(){
        $post = Post::get();
        return response()->json([
            'status' => 'success',
            'post' => $post
        ]);
    }
     //post search
     public function postSearch(Request $request){
        $category = Post::where('title','LIKE','%'.$request->key.'%')->get();
       return response()->json([
        'searchData' => $category
       ]);
    }
    //post details
    public function postDetails(Request $request){
        $id = $request->postId;
        $post = Post::where('id',$id)->first();
        return response() ->json([
            'post' => $post
        ]);
    }
}
