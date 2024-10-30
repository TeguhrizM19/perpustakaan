<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index()
  {
    $users = User::all();
    return view('users.tampil', compact('users'));
  }

  public function destroy($id)
  {
    $user = User::find($id);
    $user->delete();
    return back()->with('success', 'Data Berhasil Dihapus');
  }
}
