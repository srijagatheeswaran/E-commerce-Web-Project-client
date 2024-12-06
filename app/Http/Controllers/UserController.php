<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use App\Models\User;
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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(
            ['status' => 200, 'message' => 'registered successfully']
        );

    }
}
