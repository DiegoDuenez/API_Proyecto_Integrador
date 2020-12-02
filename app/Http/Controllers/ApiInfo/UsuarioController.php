<?php

namespace App\Http\Controllers\ApiInfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\MessageBag;

class UsuarioController extends Controller
{
    public function index(Request $request, $id = null){
        
        if($request->user()->tokenCan('admin:admin')){
            if($id){
                $user = Auth::user();
                /*$accion = "";
                $correo= Mail::to($request->user()->email)->send(new Autorizado($user, $accion, $id));*/
                return response()->json(["usuario"=>User::find($id)],200);
            }
            else{
                $user = Auth::user();
                /*$accion = "";
                $correo= Mail::to($request->user()->email)->send(new Autorizado($user, $accion, $id));*/
                return response()->json(["usuarios"=>User::all(),200]);
            }
            
        }
        if(! $request->user()->tokenCan('admin:admin')){
            if($id){
                //$admin = User::where("rol","=","admin")->select("email")->get();
                $user = Auth::user();
                /*$accion = "";
                $correotoadmin = Mail::to($admin)->send(new SinAutorizacion($user, $accion, $id));*/
                return abort(400, "Permisos Invalidos");
            }
            else{
                $user = Auth::user();
                /*$accion = "";
                $correo= Mail::to($request->user()->email)->send(new Autorizado($user, $accion, $id));*/
                return response()->json(["user"=>$user],200);
            }
        }
        

    }


}
