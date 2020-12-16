@extends('tamplate.App')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
  @section('content')
  <div class="d-flex flex-row-reverse my-3">
    <div class="btn btn-primary">
      <a href="{{route('produksi')}}" class="text-white" style="text-decoration:none;">
        Kembali
      </a>
    </div>
  </div>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Tanggal</th>
        <th scope="col">Penginput</th>
        <th scope="col">Nama Produk</th>
        <th scope="col">Jumlah</th>
      </tr>
    </thead>
    <tbody>
      @foreach($produk as $produk)
        @foreach($produk->produksi as $produksi)
          <tr>
            <th scope="row">{{$produksi['created_at']}}</th>
            <td>{{$produksi->karyawan['nama']}}</td>
            <td>{{$produk['namaproduk']}}</td>
            <td>{{$produksi['kuantitas']}}</td>
          </tr>
        @endforeach
      @endforeach
    </tbody>
  </table>
  @endsection
  </body>
</html>
