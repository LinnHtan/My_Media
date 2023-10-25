<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category
    public function index(){
        $category = Category::get();

        return view('admin.category.index',compact('category'));
    }
    //create category
    public function createCategory(Request $request){
        $validator = $this->categoryValidationCheck($request);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $data = $this->getCategoryData($request);
        Category::create($data);
        return back()->with(['createSuccess' => 'Creating category success...']);


    }
    //category delete
    public function deleteCategory($id){
        Category::where('category_id',$id)->delete();
        return redirect()->route('admin#category');
    }
    //category search
    public function categorySearch(Request $request){
        $category = Category::orwhere('title', 'LIKE','%'.$request->categorySearch.'%')
                            ->orwhere('description', 'LIKE','%'.$request->categorySearch.'%')->get();

return view('admin.category.index',compact('category'));

    }
    //edit category page
    public function editCategory($id){
       $category = Category::get();
       $updateCategory = Category::where('category_id',$id)->first();

        return view('admin.category.edit',compact('updateCategory','category'));
    }
    //update category page
    public function categoryUpdate($id, Request $request){
        $validator = $this->categoryValidationCheck($request);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $updateCategory = $this->getUpdateData($request);
        Category::where('category_id',$id)->update($updateCategory);
        return redirect()->route('admin#category');
    }
    //category validation check
    private function categoryValidationCheck($request){
        $validationRules = [
            'categoryName' => 'required',
            'descriptionName' => 'required',
        ];
        $validationMsg = [
            'categoryName.required' => 'Please fill category field!',
            'descriptionName.required' => 'Please fill description field'
        ];
        return Validator::make($request->all(), $validationRules, $validationMsg);
    }
    //get update data
    private function getUpdateData($request){
        return [
            'title' => $request->categoryName,
            'description' => $request->descriptionName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
    //get category data
    private function getCategoryData($request){
        return  [
            'title' => $request->categoryName,
            'description' => $request->descriptionName,
            'created_at' =>Carbon::now(),
            'updated_at' =>Carbon::now()
           ];
    }
}
