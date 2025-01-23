<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function createUser(Request $res){

        $validate = $res->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' =>'required|confirmed',
           
        ]);

        $checkExistsEmail = User::where('email',$res->email)->exists();
        // dd($checkExistsEmail);
        if(!empty($checkExistsEmail)){
           
            return response()->json([
                'success' => false,
                'message' => 'This email is already taken. Please use a different email.'
            ]);
        }
    
        $user = new User();
        $user->name = $res->name;
        $user->email = $res->email;
        $user->password = bcrypt($res->password); 
        // $user->save();
        try {
            $user->save();
        
            return response()->json([
                'success' => true,
                'message' => 'User registered successfully!'
            ]);
        } catch (QueryException $e) {
        
            return response()->json([
                'success' => false,
                'message' => 'There was an error registering the user. Please try again.'
            ]);
        }

        // return response()->json([
        //     'success' => true,
        //     'message' => 'User registered successfully!'
        // ]);
    }

    public function checkUser(Request $res){
       
        $credentials = $res->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if(Auth::attempt($credentials)){
            return response()->json([
                'success' => true,
                'message' => 'Login successful.',
                'redirectUrl' => route('profile'),
            ]);
        }else{
             return response()->json([
                'success' => false,
                'message' => 'No such User Exists.'
            ]);
        }
    }

    public function profile(){
        if(Auth::check()){
            return view("profile");
        }else{
            return "login first";
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
