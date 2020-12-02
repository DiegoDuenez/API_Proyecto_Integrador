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

class RegistroController extends Controller
{

    public function registro(Request $request){

        $request ->validate([

            'name'=>'required',
            'email'=> 'required|email|unique:users,email',
            'password'=>'required',
            

        ]);

        $user = new User();
        $datos['name'] = $user->name = $request->name;
        $datos['email'] = $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->rol = 'user';
       // $datos['codigo'] = $user->codigo_act = Str::random(10);;
        
        if($user->save()){
            return response()->json($user, 201);
        }
        return abort(400, "Hubo problemas al registrarse");

    }


}
