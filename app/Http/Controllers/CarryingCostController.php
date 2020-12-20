<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarryingCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //mengambil data dari json
      $json = Storage::get('public/carrying_cost.json');
      $data = json_decode($json, true);

      //mengambil data produk
      $produk = \App\Produk::all();

      return view('admin.carrying_cost', compact('data','produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      //mengambil semua data file json
      $json = Storage::get('public/carrying_cost.json');
      $data = json_decode($json, true);

      //cek json kosong
      $hitung = count($data);

      if ($hitung == 0) {
        //menangkap inputan dari request
        $namacc = $request['namacc'];
        $interval = $request['interval'];
        $kegiatan = $request['kegiatan'];
        $ongkos = $request['ongkos'];
        $count = 0;
        $arcount = count($ongkos);

        //merubah inputan ke bentuk array
        $push['id']=1;
        $push['title']=$namacc;
        $push['interval']=$interval;
        for ($i=0; $i < $arcount; $i++){
        $push['value'][]= array(
              'kegiatan'=>$kegiatan[$i],
              'harga'=>intval($ongkos[$i])
          );
        };
      }
      else {
        //mengambil array id terakhir
        $end = count($data)-1;
        $endid = $data[$end]['id'];
        $idlist = $endid+1;

        //menangkap inputan dari request
        $namacc = $request['namacc'];
        $interval = $request['interval'];
        $kegiatan = $request['kegiatan'];
        $ongkos = $request['ongkos'];
        $count = 0;
        $arcount = count($ongkos);

        //merubah inputan ke bentuk array
        $push['id']=$idlist;
        $push['title']=$namacc;
        $push['interval']=$interval;
        for ($i=0; $i < $arcount; $i++){
        $push['value'][]= array(
              'kegiatan'=>$kegiatan[$i],
              'harga'=>intval($ongkos[$i])
          );
        };
      }

      //menambahkan $push ke json
      $data[]=$push;

      //push json
      $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
      $file = Storage::put("public/carrying_cost.json", $jsonfile, LOCK_EX);

      //kembali ke view oc
      return redirect(route('carrying_cost'));
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
      //mengambil data dari json
      $json = Storage::get('public/carrying_cost.json');
      $data = json_decode($json, true);
      $id = $id-1;

      //mengambil data produk
      $produk = \App\Produk::all();

      return view('admin.edit_cc', compact('data','id','produk'));
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
      //mengambil semua data file json
      $json = Storage::get('public/carrying_cost.json');
      $data = json_decode($json, true);

      //mengambil index array
      $count = $request['count'];

      //menangkap inputan dari request
      $idlist = $request['id'];
      $namacc = $request['namacc'];
      $interval = $request['interval'];
      $kegiatan = $request['kegiatan'];
      $ongkos = $request['ongkos'];
      $arcount = count($ongkos);

      //merubah inputan ke bentuk array
      $push['id']=$idlist;
      $push['title']=$namacc;
      $push['interval']=$interval;
      for ($i=0; $i < $arcount; $i++){
      $push['value'][]= array(
            'kegiatan'=>$kegiatan[$i],
            'harga'=>intval($ongkos[$i])
        );
      };

      //menambahkan $push ke index yang akan di update.
      $data[$count]=$push;

      //push json
      $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
      $file = Storage::put("public/carrying_cost.json", $jsonfile, LOCK_EX);

      //kembali ke view cc
      return redirect(route('carrying_cost'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $count)
    {
      $json = Storage::get('public/carrying_cost.json');
      $data = json_decode($json, true);
      $count = $count - 1;

      unset($data[$count]);

      $rdata = array_values($data);

      $jsonfile = json_encode($rdata, JSON_PRETTY_PRINT);
      $file = Storage::put("public/carrying_cost.json", $jsonfile);

      //kembali ke view oc
      return redirect(route('carrying_cost'));
    }
}
