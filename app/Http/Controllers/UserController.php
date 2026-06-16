<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {

        if(auth()->user()->role !== 'admin') {
            abort(403, 'Acces interzis');
        }

        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user) {
        $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        $user->update(['role' => $request->role]);

        return redirect()->route('users.index')->with('succes', 'Rol actualizat cu succes');
    }
}
