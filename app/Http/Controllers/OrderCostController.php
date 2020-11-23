<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //mengambil data dari json
      $json = Storage::get('public/order_cost.json');
      $data = json_decode($json, true);
      //diurutkan dari yang terbaru
      rsort($data);

      return view('admin.order_cost', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      //mengambil seua data file json
      $json = Storage::get('public/order_cost.json');
      $data = json_decode($json, true);

      //mengambil array id terakhir
      $end = count($data)-1;
      $endid = $data[$end]['id'];
      $idlist = $endid+1;

      //menangkap inputan dari request
      $namaoc = $request['namaoc'];
      $kegiatan = $request['kegiatan'];
      $ongkos = $request['ongkos'];
      $count = 0;
      $arcount = count($ongkos);

      //merubah inputan ke bentuk array
      $push['id']=$idlist;
      $push['title']=$namaoc;
      for ($i=0; $i < $arcount; $i++){
      $push['value'][]= array(
            'kegiatan'=>$kegiatan[$i],
            'harga'=>intval($ongkos[$i])
        );
      };

      //menambahkan $push ke json
      $data[]=$push;

      //push json
      $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
      $file = Storage::put("public/order_cost.json", $jsonfile, LOCK_EX);

      //kembali ke view oc
      return redirect(route('order_cost'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
      $json = Storage::get('public/order_cost.json');
      $data = json_decode($json, true);
      unset($data[$id-1]);

      $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
      $file = Storage::put("public/order_cost.json", $jsonfile);

      //kembali ke view oc
      return redirect(route('order_cost'));
    }
}
