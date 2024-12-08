<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
class UserController extends Controller
{
    public function index()
    {
        return view("dashboard");
    }
    function login()
    {
        return view("login");
    }
    function register()
    {
        return view("register");
    }
    function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|max:20|min:5|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|max:100|unique:users,email',
            'mobile_number' => 'required|numeric|digits:10|unique:users,mobile_number',
            'password' => 'required|min:6|max:50',
            'repassword'=>'required|min:6|max:50|same:password'
        ],[
            'repassword.same'=>'Password did not matched!',
            'repassword.required'=>' Confirm Password is required!'
        ]);

        $name = $request->name;
        $email = $request->email;
        $mobile_number=$request->mobile_number;
        $password = $request->password;
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag(),
            ]);
        } else {

            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->mobile_number = $mobile_number;
            $user->password = Hash::make($password);
            $user->save();
            return response()->json(
                ['status' => 200, 'message' => 'registered successfully']
            );
        }

    }
    function logout(){

        if(session()->has('loggedInUser')){
            session()->pull('loggedInUser');
            return redirect('/login');
        }
    }


    function loginPost(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100',
            'password' => 'required|min:6|max:50'
        ]);
        $email = $request->email;
        $password = $request->password;
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag(),
            ]);
        } else {
            $user = User::where(['email' => $email])->first();
            if ($user) {
                if (Hash::check($password, $user->password)) {
                    // return redirect()->intended(route('home'))->with("success", "Login success");
                    $request->session()->put('loggedInUser', $user->id);
                    return response()->json(['status' => 200, 'message' => 'success']);
                } else {
                    return response()->json(['status' => 401, 'message' => 'password is not match']);
                }
            } else {
                return response()->json(['status' => 401, 'message' => 'Email is not match']);
            }
        }

    

    }
}
