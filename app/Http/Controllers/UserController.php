<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function create()
    {
        $users = User::all();

        return view('users.create')
            ->with('users', $users);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:usuario,administrador'
        ], [
            'email.unique' => 'O e-mail fornecido já está em uso.',
            'password.confirmed' => 'A confirmação da senha não coincide com a senha fornecida.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->back()
            ->with('success', 'Usuário criado com sucesso.');
    }

    public function edit(User $user)
    {
        $roles = ['administrador', 'usuario'];

        return view ('users.edit')
            ->with('roles', $roles)
            ->with('user', $user);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:usuario,administrador'
        ], [
            'email.unique' => 'O e-mail fornecido já está em uso.'
        ]);

        $user->update($request->all());

        return redirect()->back()->with('success', "Usuário '{$user->name}' atualizado com sucesso!");
    }

    public function destroy(User $user)
    {
        $user->delete();
        
        return redirect()->back()->with('success', "Usuário '{$user->name}' excluído com sucesso!");
    }
}
