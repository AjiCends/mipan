@extends('tamplate.App')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @section('content')
    <div class="row">
      <h3 class="mt-2">Daftar Karyawan</h3>
      <table class="table mt-3">
        <thead class="thead-light">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nama</th>
            <th scope="col">Gender</th>
            <th scope="col">Alamat</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data_karyawan as $karyawan)
          <tr>
            <th scope="row">{{$karyawan->id}}</th>
            <td>{{$karyawan->nama}}</td>
            <td>{{$karyawan->gender}}</td>
            <td>{{$karyawan->alamat}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    @endsection
</body>
</html>
