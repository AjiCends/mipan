@extends('tamplate.App')
<?php
$data = $data[$id];
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
  @section('content')
  <div class="container">
    <h3 class="my-4">Edit Carrying Cost</h3>
    <!-- looping the keys -->
    <div class="table-responsive">
      <form class="" action="{{route('carrying_cost/update')}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
          <label for="id">id Carrying Cost</label>
          <input type="text" class="form-control" name="id" id="id" value="{{$data['id']}}" readonly>
        </div>

        <div class="form-group">
          <label for="title">Nama Carrying Cost</label>
          <!-- mencocokan nama cc -->
          <?php
            $selected = $data['title'];
          ?>
          <select class="form-control" id="namacc" name="namacc">
            @foreach($produk as $produk)
            <option <?php if ($selected == $produk['namaproduk']){echo"selected";}?> > {{$produk['namaproduk']}} </option>
            @endforeach
          </select>
        </div>

        <!-- mencocokan interval cc -->
        <?php
          $interval = $data['interval'];
        ?>

        <div class="form-group">
          <label for="interval">Interval per:</label>
          <select class="form-control" id="interval" name="interval">
            <option<?php if ($selected == "Minggu"){echo"selected";}?>>Minggu</option>
            <option<?php if ($selected == "Bulan"){echo"selected";}?>>Bulan</option>
            <option<?php if ($selected == "Tahun"){echo"selected";}?>>Tahun</option>
          </select>
        </div>

        <table class="table table-bordered table-striped" id="user_table">
          <thead>
           <tr>
             <th width="35%">Kegiatan</th>
             <th width="35%">Ongkos</th>
           </tr>
          </thead>
          <tbody>
            <!-- looping isi -->
            <?php $hitung = 0; ?>
            @foreach ($data['value'] as $isi)
            <?php $hitung = $hitung + 1; ?>
            <tr>
            <td><div class="form-group">
              <input type="text" class="form-control" name="kegiatan[]" id="kegiatan" value="{{$isi['kegiatan']}}">
            </div></td>
            <td><div class="form-group">
              <input type="text" class="form-control" name="ongkos[]" id="harga" value="{{$isi['harga']}}">
            </div></td>
            </tr>
            @endforeach
          </tbody>
       </table>

       <input type="hidden" name="count" value="{{$id}}">
       <button type="submit" class="btn btn-primary float-right text-white mx-3" name="button">Save Changes</button>
       <a href="{{route('carrying_cost')}}" type="button" class="btn btn-danger float-right" name="button">Cancel</a>
      </form>
  @endsection
  </body>
</html>
