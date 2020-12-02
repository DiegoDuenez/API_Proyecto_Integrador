<?php

namespace App\Http\Controllers\ApiAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    
    public function login(Request $request){

        $request->validate([

            'email'=> 'required|email',
            'password'=>'required',
            
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){

            throw ValidationException::withMessages([
                'email|password'=>['Datos incorrectos'],
            ]);


        }
        if($user->rol == 'user'){ 
                $token = $user->createToken($request->email,['user:show','user:save','user:edit','user:delete'])->plainTextToken;
        }
        if($user->rol == 'admin'){
                $token = $user->createToken($request->email,['admin:admin'])->plainTextToken;
        }
        return response()->json(['token'=>$token], 201);
    
        

    
    }

    public function logout(Request $request){

        return response()->json(["Sesiones cerradas"=>$request->user()->tokens()->delete()],200);

    }

   
}
