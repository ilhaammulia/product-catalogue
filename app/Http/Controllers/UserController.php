<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function index()
  {
    $userQuery = new User();
    $total_users = $userQuery->count();

    $users = $userQuery->orderBy('created_at', 'desc')->get()->map(function ($user) {
      return [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'created_at' => Carbon::parse($user->created_at)->format('d-m-Y')
      ];
    });
    return Inertia::render('Admin/User', [
      'meta' => [
        'total_users' => $total_users,
      ],
      'users' => $users
    ]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'email' => 'required|email|unique:users,email',
      'password' => 'required',
    ]);

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password)
    ]);

    if (!$user) {
      return redirect()->to(route('admin.users'));
    }

    return redirect()->to(route('admin.users'));
  }

  public function update(Request $request, $id)
  {
    $user = User::find($id);
    if (!$user) {
      return redirect()->to(route('admin.users'));
    }
    $data = array_filter($request->toArray(), function ($value) {
      return $value !== null;
    });
    if (array_key_exists('password', $data)) {
      $data['password'] = Hash::make($data['password']);
    }

    $user->update($data);

    return array_key_exists('password', $data) ? redirect()->to(route('login')) : redirect()->to(route('admin.users'));
  }

  public function destroy($id)
  {
    $user = User::find($id);
    if ($user) {
      $user->delete();
    }

    return redirect()->to(route('admin.users'));
  }
}
