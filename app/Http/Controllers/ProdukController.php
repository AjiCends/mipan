<?php

namespace App\Http\Controllers;
use App\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $produk = \App\Produk::all();
      return view('admin.produk', ['produk' => $produk]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      // validasi request
      $this->validate($request,[
        'namaproduk' => 'required|max:50',
        'harga' => 'required|max:11',
        'foto' => 'required|mimes:jpg,png,jpeg'
      ],[
        'namaproduk.required' => 'Nama tidak boleh kosong',
        'namaproduk.max' => 'Nama tidak boleh lebih dari 50 karakter',
        'harga.required' => 'harga tidak boleh kosong',
        'harga.max' => 'harga tidak boleh lebih dari 11 digit',
        'foto.mimes' => 'format foto harus: jpg, jpeg atau png'
      ]);

      //mengecek apakah di request terdapat file foto
      if ($request->hasFile('foto')) {
        //memindahkan foto ke storage\images
        $request->file('foto')->move('images/',$request->file('foto')->getClientOriginalName());
      }
      try {
        //mendefinisikan kolom produk
        $produk = new Produk;
        $produk->namaproduk = $request->namaproduk;
        $produk->harga = $request->harga;
        $produk->foto = $request->file('foto')->getClientOriginalName();
        //mengirim data produk
        $produk->save();

        //redirect ke halaman produk
        return redirect(route('produk'))->with('sukses','Data Produk berhasil di simpan');

      } catch (\Exception $e) {
        //redirect ke halaman produk
        return redirect(route('produk'))->with('gagal', 'gagal input');
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
      //validasi request
      $this->validate($request,[
        'namaproduk' => 'required|max:50',
        'harga' => 'required|max:11',
        'foto' => 'mimes:jpg,png,jpeg'
      ],[
        'namaproduk.required' => 'Nama tidak boleh kosong',
        'namaproduk.max' => 'Nama tidak boleh lebih dari 50 karakter',
        'harga.required' => 'harga tidak boleh kosong',
        'harga.max' => 'harga tidak boleh lebih dari 11 digit',
        'foto.mimes' => 'format foto harus: jpg, jpeg atau png'
      ]);

      //mencari produk sesuai id
      $produk = \App\Produk::find($request->prodid);
      if ($request->hasFile('foto')) {
        //memindah file foto ke directory storage\images
        $request->file('foto')->move('images/',$request->file('foto')->getClientOriginalName());
        try {
          //mendefiniskan kolom produk
          $produk->namaproduk = $request->namaproduk;
          $produk->harga = $request->harga;
          $produk->foto = $request->file('foto')->getClientOriginalName();
          //menyimpan data produk
          $produk->save();
          //redirect ke halman produk
          return redirect(route('produk'))->with('ubah','Data Produk berhasil di ubah');

        } catch (\Exception $e) {
          //redirect ke halman produk
          return redirect(route('produk'))->with('gagal','Gagal Update Produk');
        }

      }
      else{
        try {
          //mendefinisakan kolomm produk
          $produk->namaproduk = $request->namaproduk;
          $produk->harga = $request->harga;
          //menyimpan data produk
          $produk->save();
          //redirect ke halman produk
          return redirect(route('produk'));

        } catch (\Exception $e) {
          //redirect ke halman produk
          return redirect(route('produk'))->with('Gagal Update Produk');
        }
      }
      //redirect ke halman produk
      return redirect(route('produk'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //mengambil data produk sesuai id
      $produk = \App\Produk::find($id);
      try {
        //menghapus data produk sesuai id
        $produk->delete();
        //redirect ke halaman produk
        return redirect(route('produk'))->with('sukses','Produk berhasil dihapus');
      } catch (\Exception $e) {
        $produk->delete();
        //redirect ke halaman produk
        return redirect(route('produk'))->with('gagal','Produk gagal dihapus');
      }

    }
}
