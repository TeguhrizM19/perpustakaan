<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('members.tampil', [
      'members' => Member::all()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('members.tambah');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'nama' => 'required|min:2',
      'alamat' => 'required|min:2',
      'no_telpon' => 'required|min:2',
      'email' => 'required|email:dns'
    ]);

    $member = new Member;
    $member->nama = $request->input('nama');
    $member->alamat = $request->input('alamat');
    $member->no_telpon = $request->input('no_telpon');
    $member->email = $request->input('email');

    $member->save();
    return redirect('/members');
  }

  /**
   * Display the specified resource.
   */
  public function show(Member $member)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
  {
    return view('members.edit', [
      'member' => Member::find($id)
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {
    $request->validate([
      'nama' => 'required|min:2',
      'alamat' => 'required|min:2',
      'no_telpon' => 'required|min:2',
      'email' => 'required|email:dns'
    ]);

    $member = Member::find($id);

    $member->nama = $request->input('nama');
    $member->alamat = $request->input('alamat');
    $member->no_telpon = $request->input('no_telpon');
    $member->email = $request->input('email');

    $member->save();
    return redirect('/members');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Member $member)
  {
    //
  }
}
