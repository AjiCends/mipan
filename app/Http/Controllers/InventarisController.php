<?php

namespace App\Http\Controllers;
use App\Inventaris;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $inventaris = \App\Inventaris::all();
      // if ($inventaris->foto == null) {
      //   $inventaris->foto = 'default.jpeg';
      // }
      return view('inventaris', ['inventaris' => $inventaris]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      if ($request->hasFile('foto')) {
        $request->file('foto')->move('images/',$request->file('foto')->getClientOriginalName());
      }

      // $namaproduk =  $request['namaproduk'];
      // $harga =  $request['harga'];
      // $foto =
      // \App\Produk::create($request->all());

      $inventaris = new Inventaris;
      $inventaris->id_Karyawan = $request->id_Karyawan;
      $inventaris->nama_alat = $request->nama_alat;
      $inventaris->jumlah = $request->jumlah;
      $inventaris->foto = $request->file('foto')->getClientOriginalName();
      $inventaris->save();

      return redirect(route('inventaris'));
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
      $inventaris = \App\Inventaris::find($request->prodid);
      if ($request->hasFile('foto')) {
        $request->file('foto')->move('images/',$request->file('foto')->getClientOriginalName());
        $inventaris->nama_alat = $request->nama_alat;
        $inventaris->jumlah = $request->jumlah;
        $inventaris->foto = $request->file('foto')->getClientOriginalName();
        $inventaris->save();
      }
      else{
        $inventaris->nama_alat = $request->nama_alat;
        $inventaris->jumlah = $request->jumlah;
        $inventaris->save();
      }
      return redirect(route('inventaris'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $inventaris = \App\Inventaris::find($id);
      $inventaris->delete();
      return redirect(route('inventaris'))->with('sukses','Produk berhasil dihapus');
    }
}
