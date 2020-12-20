@extends('jadwal')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
  @section('jadwal')
    @if(auth()->user()->role == 'karyawan')
      @foreach($jadwal as $jadwal)
      <div class="card my-5">
        <div class="card-body">
          <h5 class="card-title">Tanggal Produksi: {{$jadwal['tanggal']}}</h5>
          <p class="card-text">Produksi: {{$jadwal['produk']}}</p>
          <p class="card-text">Target Produksi: {{$jadwal['jumlahBahan']}}</p>
          <a href="#" class="btn btn-primary" data-toggle="modal" data-status="{{$jadwal->status}}" data-id="{{$jadwal->id}}" data-tanggal="{{$jadwal->tanggal}}" data-produk="{{$jadwal->produk}}" data-produksi="{{$jadwal->jumlahBahan}}" data-target="#modaleditstatus">
            {{$jadwal['status']}}
          </a>
        </div>
      </div>
      @endforeach
    @endif

    @if(auth()->user()->role == 'admin')
    @foreach($jadwal as $jadwal)
    <div class="card my-5">
      <div class="card-body">
        <h5 class="card-title">Tanggal Produksi: {{$jadwal['tanggal']}}</h5>
        <p class="card-text">Produksi: {{$jadwal['produk']}}</p>
        <p class="card-text">Target Produksi: {{$jadwal['jumlahBahan']}}</p>
        <a href="#" class="btn btn-primary" style="cursor: default;">{{$jadwal['status']}}</a>
      </div>
    </div>
    @endforeach
    @endif
  @endsection
  </body>
</html>
