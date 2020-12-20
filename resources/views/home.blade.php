@extends('tamplate.App')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    @section('content')
    <div class="row my-5">
      <div class="col-6">
        <h1 class="bold my-4">Selamat datang di MIPAN</h1>
        <p>Mipan adalah Sistem Informasi penyediaan bahan baku.
          Sistem ini dapat membantu anda untuk mengelola persediaan bahan baku sehingga sesuai dengan jumlah permintaan.</p>
        <p>Mipan juga membantu anda untuk menjadwalkan kapan harus produksi sehingga bahan baku tidak menumpuk dan memakan biaya perawatan lebih banyak.</p>
      </div>
      <div class="col-6 d-flex justify-content-center">
        <img class="w-75 .justify-content-center" src="{{asset('gambar/dashboard.jpg')}}" alt="">
      </div>
    </div>
    <div class="row mb-4">
      <h1 class="bold">Basic Alur Pengggunaan MIPAN</h1>
    </div>
    <div class="row text-white">
        <div class="col-2 mx-2 bg-primary p-4 rounded">
          <p class="font-weight-bold">
            Membuat Order Cost (OC)
          </p>
          <p>Order Cost adalah biaya biaya yang dikeluarkan ketika proses beli bahan baku</p>
        </div>
        <div class="col text-dark text-center align-middle">
          <i class="fas fa-arrow-right btn-lg"></i>
        </div>
        <div class="col-2 mx-2 bg-primary p-4 rounded">
          <p class="font-weight-bold">
            Membuat Carrying Cost (CC)
          </p>
          <p>Carrying Cost merupakan biaya yang dikeluarkan ketika masa penyimpanan bahan baku</p>
        </div>
        <div class="col text-dark text-center align-middle">
          <i class="fas fa-arrow-right btn-lg"></i>
        </div>
        <div class="col-2 mx-2 bg-primary p-4 rounded">
          <p class="font-weight-bold">
            Membuat EOQ
          </p>
          <p>EOQ adalah Economic Quantitiy Order, yaitu banyaknya pemesanan bahan baku paling ekonomis</p>
        </div>
        <div class="col text-dark text-center align-middle">
          <i class="fas fa-arrow-right btn-lg"></i>
        </div>
        <div class="col-2 mx-2 bg-primary p-4 rounded">
          <p class="font-weight-bold">
            Membuat Jadwal Produksi
          </p>
          <p>Membuat jadwal produksi dari jumlah EOQ dan frekwensi yang diketahui</p>
        </div>
    </div>
    @endsection
  </body>
</html>
