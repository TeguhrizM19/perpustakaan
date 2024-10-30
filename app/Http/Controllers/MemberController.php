<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
      'email' => 'required|email:dns',
      'foto' => 'required|mimes:jpg,jpeg,png|max:2048'
    ]);

    // <!-- mengubah naman file jadi unique -->
    $newNameImage = time() . '.' . $request->foto->extension();
    // <!-- tempat penyimpanan image -->
    $request->foto->move(public_path('foto'), $newNameImage);

    $member = new Member;
    $member->nama = $request->input('nama');
    $member->alamat = $request->input('alamat');
    $member->no_telpon = $request->input('no_telpon');
    $member->email = $request->input('email');
    $member->image = $newNameImage;

    $member->save();
    return redirect('/members')->with('success', 'Data Berhasil Disimpan');
  }

  /**
   * Display the specified resource.
   */
  public function show($id)
  {
    return view('members.detail', [
      'member' => Member::find($id)
    ]);
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
      'email' => 'required|email:dns',
      'foto' => 'mimes:jpg,jpeg,png|max:2048'
    ]);

    $member = Member::find($id);

    if ($request->has('foto')) {
      // Hapus file lama
      File::delete('foto/' . $member->image);
      // mengubah nama file jadi unique
      $newNameImage = time() . '.' . $request->foto->extension();
      // tempat penyimpanan image
      $request->foto->move(public_path('foto'), $newNameImage);
      $member->image = $newNameImage;
    }

    $member->nama = $request->input('nama');
    $member->alamat = $request->input('alamat');
    $member->no_telpon = $request->input('no_telpon');
    $member->email = $request->input('email');

    $member->save();
    return redirect('/members')->with('success', 'Data Berhasil Diubah');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    $member = Member::find($id);
    // jika ada foto hapus
    if ($member->image) {
      File::delete('foto/' . $member->image);
    }

    $member->delete();
    return back()->with('success', 'Data Berhasil Dihapus');
  }

  public function cetak($id)
  {
    return view('members.cetak', [
      'member' => Member::find($id)
    ]);
  }
}
