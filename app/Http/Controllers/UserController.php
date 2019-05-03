<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index() {
    return response()->json(User::all());
  }

  public function create(Request $request) {
    $this->validate($request, [
        'username' => 'required',
        'email'    => 'required|email|unique:users',
        'password' => 'required',
    ]);

    $user = new User;

    $user->username = $request->username;
    $user->email = $request->email;
    $user->password = $request->password;

    $user->save();

    return response()->json($user);
  }

  public function show($id) {
    $user = User::find($id);

    return response()->json($user);
  }

  public function update($id, Request $request) {
    $this->validate($request, [
        'username' => 'required',
        'email'    => 'required|email|unique:users',
        'password' => 'required',
    ]);

    $user = User::find($id);

    $user->username = $request->input('username');
    $user->email = $request->input('email');
    $user->password = $request->input('password');

    $user->save();

    return response()->json($user);
  }

  public function delete($id) {
    $user = User::find($id);

    $user->delete();

    return response()->json('User deleted sucessfully');
  }

  public function login(Request $request) {
    $user = User::where([
      'email' => $request->email, 
      'password' => $request->password
    ])->get()->first();

    return response()->json($user);
  }
}
