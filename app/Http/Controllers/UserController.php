<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function logout(){
        auth()->logout();
        return redirect('/');
    }
    
 public function register(Request $request){

        $inconigFields = $request->validate([
            'name' => ['required','min:3','max:10',Rule::unique('users','name')],
            'email'=>['required','email' , Rule::unique('users','email')],
            'password'=>['required','min:8','max:200',]  
        ]);

        $inconigFields['passowrd'] = bcrypt($inconigFields['password']);
        $user = User::create($inconigFields);
        auth()->login($user);
        return redirect('/');
    }
}
