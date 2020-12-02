@extends('tamplate.App')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    @section('content')
    @foreach($karyawan as $data)
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Profile Karyawan</h5>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Nama: {{$data['nama']}}</li>
        <li class="list-group-item">Gender:
          <?php
          if ($data['gender']=="L") {
            echo "Laki-Laki";
          } else {
            echo "Perempuan";
          }
          ?>
        </li>
        <li class="list-group-item">
          Alamat:
          <textarea name="name" rows="5" cols="32">{{$data['alamat']}}</textarea>
        </li>
      </ul>
      <div class="card-body">
        <a href="#" class="btn btn-warning""><i class="fas fa-edit text-dark"></i></a>
        <a href="#" class="btn btn-danger"><i class="fas fa-trash text-white"></i></a>
      </div>
    </div>
    @endforeach
    @endsection
  </body>
</html>
