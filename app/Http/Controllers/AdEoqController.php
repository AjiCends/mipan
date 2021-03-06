<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdEoqController extends Controller
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
      $oc = json_decode($json, true);
      //diurutkan dari yang terbaru
      rsort($oc);

      //mengambil data dari json
      $json = Storage::get('public/carrying_cost.json');
      $cc = json_decode($json, true);
      //diurutkan dari yang terbaru
      rsort($cc);

      //mengambil data produk
      $produk = \App\Produk::all();

      //mengambil data EOQ
      $dataeoq = \App\Eoq::all();
      $dataeoq = $dataeoq->reverse();

      return view('admin\eoq',compact('oc','cc','produk'),['dataeoq' => $dataeoq]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      try {
        //mengambil data eoq menurut id
        \App\Eoq::create($request->all());
        //redirect
        return redirect(route('eoq'))->with('sukses','Data EOQ berhasil di simpan');
      } catch (\Exception $e) {
        //redirect
        return redirect(route('eoq'))->with('gagal','Data EOQ gagal di simpan');
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
      $eoq = \App\Eoq::find($id);
      $eoq->delete();
      return redirect(route('eoq'))->with('sukses','Produk berhasil dihapus');
    }
}
