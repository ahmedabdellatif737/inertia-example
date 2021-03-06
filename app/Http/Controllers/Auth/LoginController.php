<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
  public function create()
  {
    return Inertia::render("Auth/Login");
  }

  public function store(Request $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, request('remember'))) {
      $request->session()->regenerate();
      return redirect()->intended('/users')->with(['success' => 'welcome back ' . Auth::user()->name]);
    }

    return back()->withErrors([
      'email' => 'The provided credentials do not match our records.',
    ]);
  }
}
