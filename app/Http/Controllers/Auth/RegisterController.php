<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class RegisterController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required|min:3|max:255',
            'password' => ['required', 'confirmed', 'min:8', 'regex:/^(?=.*[A-Z])(?=.*[a-z]).*$/'],
        ]);

        $user = User::create([
            'email' => $request->email,
            'name' => $request->username,
            'password' => Hash::make($request->password),
            'tag' => (new \Visus\Cuid2\Cuid2(10))->toString(),
        ]);

        Auth::login($user);

        return redirect('dashboard');
    }
}
