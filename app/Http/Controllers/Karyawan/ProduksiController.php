<?php

namespace App\Http\Controllers\Karyawan;
use App\Produk;
use App\Produksi;
use App\Karyawan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $produk = \App\Produk::all();
      return view('Karyawan.produksi', ['produk' => $produk]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      //mengecek request
      $this->validate($request,[
        'kuantitas'  => 'required|max:11'
      ],[
        'kuantitas.required' => 'Data tidak boleh kosong',
        'kuantitas.max' => 'Data masksimal 11 digit'
      ]);

      try {
        //menangkap id user
        $userid = $request->iduser;
        //menangkap id karyawan
        $karyawan = \App\Karyawan::where('user_id',$userid)->get();
        foreach ($karyawan as $key) {
          $idkaryawan = $key->id;
        }
        //mendefiniksan kolom tabel produksi
        $produksi = new Produksi;
        $produksi->id_Produk = $request->idproduk;
        $produksi->id_Karyawan = $idkaryawan;
        $produksi->kuantitas = $request->kuantitas;
        $produksi->save();
        //redirest ke halaman produksi
        return redirect(route('produksi'))->with('sukses','Data produksi berhasil di input');

      } catch (\Exception $e) {
        //redirest ke halaman produksi
        return redirect(route('produksi'))->with('Gagal','Data produksi gagal di input');
      }


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
    public function show()
    {
      $produk = \App\Produk::all()->sortByDesc('created_at');
      return view('Karyawan.daftar_produksi', ['produk' => $produk]);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
