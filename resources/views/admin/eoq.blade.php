@extends('tamplate.App')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    @section('content')
    <div class="row mt-3">
      <!-- eoq -->
      <div class="col-4">
        <h3 class="mb-4">Perhitungan EOQ</h3>
          <div class="form-group">
            <label for="demand">Jumlah Permintaan (pcs)</label>
            <input type="text" class="form-control" id="demand">
          </div>
          <div class="form-group">
            <label for="oc">Ordering Cost</label>
            <input type="text" class="form-control" id="oc">
          </div>
          <div class="form-group">
            <label for="cc">Carrying Cost</label>
            <input type="text" class="form-control" id="cc">
          </div>
          <button class="btn btn-primary" onclick="Eoq()">Hitung EOQ</button>
          <br>
          <br>
          <div class="form-group">
            <label for="hasil">Hasil</label>
            <input type="text" class="form-control" id="hasil">
          </div>
          <div class="form-group">
            <label for="hasil">Frekwensi Order</label>
            <input type="text" class="form-control" id="frekwensi">
          </div>

          <form class="" action="" method="post">
            <input type="hidden" name="" value="" id="hdemand">
            <input type="hidden" name="" value="" id="hoc">
            <input type="hidden" name="" value="" id="hcc">
            <input type="hidden" name="" value="" id="heoq">
            <input type="hidden" name="" value="" id="hfrek">
            <button class="btn btn-primary" type="submit" name="button">Simpan</button>
          </form>
      </div>
      <!-- Order Cost -->
      <div class="col-4">
        <h3 class="mb-5">Daftar Ordering Cost</h3>
        <div class="overflow-auto" style="max-height: 25rem;">
          <!-- card order cost -->
          <!-- looping json -->
            <!-- looping the keys -->
            @foreach ($oc as $data)
              <div class="card mb-3" style="max-width: 15rem;">
                <div class="card-header bg-info text-white">
                  {{$data['title']}}
                </div>
                <ul class="list-group list-group-flush">
                  <!-- looping isi -->
                  <?php $totaloc = 0 ?>
                  @foreach ($data['value'] as $isi)
                  <?php
                  $totaloc = $totaloc + (int)$isi['harga'];
                  ?>
                  @endforeach
                  <li class="list-group-item">Jumlah : {{$totaloc}}</li>
                  <li class="list-group-item">Interval : / {{$data['interval']}}</li>
                </ul>
                <button class="btn btn-primary" type="button" name="button" onclick="pilihoc({{$totaloc}})">Pilih</button>
              </div>
            @endforeach
        </div>
      </div>

      <!-- carrying cost -->
      <div class="col-4">
        <h3 class="mb-5">Daftar Carrying Cost</h3>
        <div class="overflow-auto" style="max-height: 25rem;">
          <!-- card order cost -->
          <!-- looping json -->
            <!-- looping the keys -->
            @foreach ($cc as $data)
              <div class="card mb-3" style="max-width: 15rem;">
                <div class="card-header bg-warning text-dark">
                  {{$data['title']}}
                </div>
                <ul class="list-group list-group-flush">
                  <!-- looping isi -->
                  <?php $totalcc = 0 ?>
                  @foreach ($data['value'] as $isi)
                  <?php
                  $totalcc = $totalcc + (int)$isi['harga'];
                  ?>
                  @endforeach
                  <li class="list-group-item">Jumlah : {{$totalcc}}</li>
                  <li class="list-group-item">Interval : / {{$data['interval']}}</li>
                </ul>
                <button class="btn btn-primary" type="button" name="button" onclick="pilihcc({{$totalcc}})">Pilih</button>
              </div>
            @endforeach
        </div>
      </div>
    </div>

    <hr class="my-5" style="border: 1px solid lightgrey;">
    <h2>Daftar EOQ</h2>

    @endsection

    @section('Eoq')
    <script type="text/javascript">
      function Eoq() {
        var demand = parseInt(document.getElementById('demand').value);
        var oc = parseInt(document.getElementById('oc').value);
        var cc = parseInt(document.getElementById('cc').value);

        var hasil = Math.sqrt(2*demand*oc/cc)
        var frekwensi = Math.sqrt(demand/hasil)
        var frekwensi = Math.round(frekwensi)

        document.getElementById('hasil').value = hasil;
        document.getElementById('frekwensi').value = frekwensi;
      }

      function pilihoc(oc){
        document.getElementById('oc').value = oc;
      }

      function pilihcc(cc){
        document.getElementById('cc').value = cc;
      }


    </script>
    @endsection
  </body>

</html>
