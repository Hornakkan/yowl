<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{

// Create    
    public function register(Request $request) {
        // validation des champs envoyés
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'admin' => 'nullable|boolean',
            'birthdate' => 'nullable|date',
        ]);

        // création du user après validation
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => password_hash($fields['password'], PASSWORD_DEFAULT),
            // 'admin' => $fields['admin'],
            'admin' => false,
            'birthdate' => $fields['birthdate']
        ]);

        // création du token
        $token = $user->createToken('myAppToken')->plainTextToken;

        // préparation de la réponse pour return
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }


// Read
    public function show($id) {
        $user = User::findOrFail($id);

        // vérifier si le user connecté correspond à l'id
        if($id == Auth::user()->id) {
            $response = [
                'user' => $user
            ];
    
            return response($response, 200);
        }

        return response('Unauthorized', 401);        
    }

    public function show_all() {
        $user = User::findOrFail(Auth::user()->id);

        // afficher tous les users uniquement aux admins
        if($user->admin == true) {
            $response = [
                'users' => User::all()
            ];
    
            return response($response, 200);
        }

        return response('Unauthorized', 401);        
    }


// Update    
    public function update($id, Request $request) {
        $user = User::findOrFail($id);

        if($id == Auth::user()->id || Auth::user()->admin == true) {
            if($request->name) {
                $user->name = $request->name;
            }
            if($request->email) {
                $user->email = $request->email;
            }
            if($request->password) {
                $user->password = password_hash($request->password, PASSWORD_DEFAULT);
            }
            if($request->birthdate) {
                $user->birthdate = $request->birthdate;
            }

            $user->save();
            return response('User updated', 200);
        }

        return response('User not updated', 401);
    }


// Delete
    public function destroy($id) {
        $user = User::findOrFail($id);

        if($id == Auth::user()->id || Auth::user()->admin == true) {
            $user->delete();
            return response('User deleted', 200);
        }

        return response('User not deleted', 401);
    }


// Login
    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // vérifier email
        $user = User::where('email', $fields['email'])->first();

        // vérifier password
        if(!$user || !password_verify($fields['password'], $user->password)) {
            return response('Bad credentials', 401);
        }

        // création token
        $token = $user->createToken('myAppToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 200);
    }


// Logout    
    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        return response('Logged out', 200);
    }


}
