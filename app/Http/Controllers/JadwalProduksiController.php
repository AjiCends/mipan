<?php

namespace App\Http\Controllers;
use App\Jadwal_produksi;
use Illuminate\Http\Request;

class JadwalProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $jadwal = \App\Jadwal_produksi::all();
      return view("jadwal", ['jadwal'=>$jadwal]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $tanggal = $request->tanggal;
      $frek = $request->frekwensi-1;
      $interval = $request->interval;

      if ($interval=="Minggu") {

        $jadwal = new Jadwal_produksi;
        $jadwal->produk = $request->produk;
        $jadwal->jumlahBahan = $request->jumlahBahan;
        $jadwal->tanggal = $tanggal;
        $jadwal->status = "waiting";
        $jadwal->save();

        for ($i=0; $i < $frek ; $i++) {
          $date=date_create($tanggal);
          date_add($date,date_interval_create_from_date_string("7 days"));
          $tanggal = date_format($date,"Y-m-d");

          $jadwal = new Jadwal_produksi;
          $jadwal->produk = $request->produk;
          $jadwal->jumlahBahan = $request->jumlahBahan;
          $jadwal->tanggal = $tanggal;
          $jadwal->status = "waiting";
          $jadwal->save();
        }
      }else {
        $jadwal = new Jadwal_produksi;
        $jadwal->produk = $request->produk;
        $jadwal->jumlahBahan = $request->jumlahBahan;
        $jadwal->tanggal = $tanggal;
        $jadwal->status = "waiting";
        $jadwal->save();

        for ($i=0; $i < $frek ; $i++) {
          $date=date_create($tanggal);
          date_add($date,date_interval_create_from_date_string("7 days"));
          $tanggal = date_format($date,"Y-m-d");

          $jadwal = new Jadwal_produksi;
          $jadwal->produk = $request->produk;
          $jadwal->jumlahBahan = $request->jumlahBahan;
          $jadwal->tanggal = $tanggal;
          $jadwal->status = "waiting";
          $jadwal->save();
        }
      }

      return redirect('jadwal');
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
      $jadwal = \App\Jadwal_produksi::find($request->jadwal_id);
      $jadwal->jumlahBahan = $request->jumlahBahan;
      $jadwal->status = $request->status;
      $jadwal->karyawan_id = $request->karyawan_id;
      $jadwal->save();

      return redirect('jadwal');
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
