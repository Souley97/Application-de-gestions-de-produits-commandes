<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AuthController;
class AuthController extends Controller
{
    public function register(){
        return view('authentifications.register');
       }
    
       public function registerSave(Request $request){
        $request->validate([
            'nom' => 'required|string|max:30|min:2',
            'prenom' => 'required|string|max:50|min:3',
            'email' => 'required|email|unique:users|max:55',
            'password' => 'required|max:20|min:6'

        ]);
        

        $user= new User();
        $user->nom=$request->nom;
        $user->prenom=$request->prenom;
        $user->email=$request->email;
        $user->role="admin";
        $user->password=Hash::make($request->password);
        $user->save();
        return redirect()->route('login');
    
       }


       public function login(){
        return view('authentifications.login');
       }
    
       public function loginSave(Request $request){
        $creditials=[
            'email'=>$request->email,
            'password' => $request->password,
        ];
        if(Auth::attempt($creditials)){
            return redirect ('/')->with('success','connexion avec succes');
        }
     return back()->with('error','vérifier votre mail ou mot de passe');
       }

       public function logout(){
        Auth::logout();
        return redirect()->route('login');
       }
    }
