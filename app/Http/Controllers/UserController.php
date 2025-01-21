<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function createUser(Request $res){

        $validated = $res->validate([
            'name' => 'required',
            'email' => 'required',
            'password' =>'required',
            'rpassword'=>'required|same:password'
        ]);

     

        $user = new User();
        $user->name = $res->name;
        $user->email = $res->email;
        $user->password = bcrypt($res->password); 
        $user->save();

        // if($user->fails()){
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'User registered successfully!'
        //     ]);
        // }

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully!'
        ]);
    }
}
