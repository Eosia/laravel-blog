<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{

    // Affichage de la page d'inscription au site
    public function index()
    {
        $data = [
            'title' => 'Inscription',
            'description' => 'Inscription sur le site ' . config('app.name'),
        ];

        return view('auth.register', $data);

    }

    // Fonction du traitement du formulaire d'inscription
    public function register(Request $request)
    {

        request()->validate([
            'name' => 'required|min:3|max:191|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|between:4,36',
        ]);


        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = bcrypt($request->pasword);

        $user = new User;
        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->save();

        $success = 'Inscription terminée';

        return back()->withSuccess($success);


    }


}