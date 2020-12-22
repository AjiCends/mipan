<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
use App\User;
class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_karyawan = \App\Karyawan::all();
        return view('admin.karyawan',['data_karyawan' => $data_karyawan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      //Cek validasi Registrasi
      $this->validate($request,[
        'nama' => 'required',
        'alamat' => 'required',
        'email' => 'required|unique:users',
        'password' => 'required'
      ],[
        //pesan validasi
        'nama.required' => 'Nama wajib diisi',
        'alamat.required' => 'Alamat wajib diisi',
        'email.required' => 'Email wajib diisi',
        'email.unique' => 'Email sudah digunakan, coba yang lain',
        'password.required' => 'Password wajib diisi'
      ]);

      //insert ke tabel user
      $user = new \App\User;
      $user->role = 'karyawan';
      $user->name = $request->nama;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->remember_token = str_random(60);
      $user->save();

      //insert tabel karyawan
      $request->request->add(['user_id' => $user->id]);
      $karyawan = \App\Karyawan::create($request->all());

      return redirect('/')->with('sukses','Berhasil membuat akun karyawan baru');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $karyawam = \App\Karyawan::find($request->id);
      $karyawam->nama = $request->nama;
      $karyawam->gender = $request->gender;
      $karyawam->alamat = $request->alamat;
      $karyawam->save();
      return redirect(route('karyawan'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //mengambil data karyawan
      $karyawan = \App\Karyawan::find($id);
      //mengambil nama karyawan
      $nama_karyawan = $karyawan->nama;

      $iduser = $karyawan->user_id;
      $user = \App\User::find($iduser);
      $karyawan->delete();
      $user->delete();
      return redirect(route('karyawan'))->with('sukses',"Karyawan $nama_karyawan berhasil dihapus");
    }
}
