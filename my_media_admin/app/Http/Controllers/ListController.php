<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ListController extends Controller
{
    //direct admin list page
    public function index(){
        $userData = User::select('id','name','email','phone','address','gender')->get();

        return view('admin.list.index',compact('userData'));
    }
    //delete admin account
    public function deleteAccount($id){
        User::where('id',$id)->delete();
        return back()->with(['accountDeleteSuccess' => 'Account Delete success...']);
    }
    //admin list search
    public function adminListSearch(Request $request){
        $userData = User::orwhere('name', 'LIKE','%'.$request->adminSearchKey.'%')
                        ->orwhere('email', 'LIKE','%'.$request->adminSearchKey.'%')
                        ->orwhere('phone', 'LIKE','%'.$request->adminSearchKey.'%')
                        ->orwhere('address', 'LIKE','%'.$request->adminSearchKey.'%')
                        ->orwhere('gender', 'LIKE','%'.$request->adminSearchKey.'%')->get();
        // dd($userData->toArray());
        return view('admin.list.index',compact('userData'));
        // return back()->with(['userData'=>$userData]);
    }
}
