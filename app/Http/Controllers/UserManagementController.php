<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserManagementController extends Controller
{
    public function index()
    {
        $usuarios = User::all();

        return view('admin.usuarios', compact('usuarios'));
    }
}
