<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //direct admin home page
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::select('id', 'email', 'name', 'address', 'phone', 'gender')->where('id', $id)->first();

        return view('admin.profile.index', compact('user'));
    }
    //change admin password page
    public function changeAdminPasswordPage()
    {
        return view('admin.profile.changePassword');
    }
    //change admin password
    public function changeAdminPassword(Request $request)
    {
        $validator = $this->changePasswordValidationCheck($request);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $dbData = User::where('id',Auth::user()->id)->first();
        $dbPassword = $dbData->password;
        $hashUserPassword = Hash::make($request->newPassword);

        $updateData = [
            'password' => $hashUserPassword,
            'updated_at' => Carbon::now()
        ];
        if(Hash::check( $request->oldPassword,$dbPassword)){
            User::where('id',Auth::user()->id)->update($updateData);
            return redirect()->route('dashboard');
        }else{
            return back()->with(['fail' => 'old password do not match!']);
        }

    }
    //update admin account
    public function updateAdminAccount(Request $request)
    {
        $userData = $this->getUserInfo($request);

        $validator = $this->userValidationCheck($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        User::where('id', Auth::user()->id)->update($userData);
        return back()->with(['updateSuccess' => 'Admin account updated!']);
    }
    //get user info
    private function getUserInfo($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'updated_at' => Carbon::now(),
        ];
    }
    //user validation check
    private function userValidationCheck($request)
    {
        return Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
        ], [
            'name.required' => 'နာမည်လိုအပ်နေပါသည်',
            'email.required' => 'အီးမေးလိုအပ်နေပါသည်',
        ]);
    }
    //password change validation check
    private function changePasswordValidationCheck($request)
    {
        $validationRules = [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|min:8|same:newPassword',
        ];
        $validationMsg = [
            'confirmPassword.same' => 'Old password and new password must be same!',
            'newPassword.min' => 'New password must be at least 8 character!',
            'confirmPassword.min' => 'Confirm password must be at least 8 character!',
        ];
        return Validator::make($request->all(), $validationRules, $validationMsg);
    }
}
