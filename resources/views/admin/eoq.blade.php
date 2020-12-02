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
      <!-- form layout eoq -->
      <div class="col-4">
        <h3 class="mb-4">Perhitungan EOQ</h3>
          <div class="form-group">
            <label for="demand">Jumlah Permintaan (pcs)</label>
            <input type="text" class="form-control" id="demand">
          </div>
          <div class="form-group">
            <label for="tanggal">Tanggal Mulai Produksi</label>
            <input class="form-control" type="date" value="" id="tanggal">
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

          <!-- form input eoq -->
          <form class="" action="{{route('eoq/create')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" value="" id="hdemand" name="demand">
            <input type="hidden" value="" id="htanggal" name="tanggal">
            <input type="hidden" value="" id="hoc" name="oc">
            <input type="hidden" value="" id="hcc" name="cc">
            <input type="hidden" value="" id="heoq" name="eoq">
            <input type="hidden" value="" id="hfrek" name="frekwensi">
            <input class="btn btn-primary" type="submit" name="simpan" >
          </form>
      </div>
      <!-- Order Cost -->
      <div class="col-4">
        <h3 class="mb-5">Daftar Ordering Cost</h3>
        <div class="overflow-auto" style="max-height: 35rem;">
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
        <div class="overflow-auto" style="max-height: 35rem;">
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
    <?php //dd($dataeoq); ?>
    <div class="row row-cols-1 row-cols-md-3 mt-3">
      @foreach ($dataeoq as $data)
      <div class="col mb-4">
        <div class="card">
          <div class="card-header bg-warning text-dark">
            <h5 class="font-weight-bold float-left">Data Eoqi id-{{$data['id']}}</h5>
            <a href="{{route('eoq/destroy', $data['id'])}}" style="text-decoration:none">
              <i class="fas fa-trash float-right text-dark"></i>
            </a>
          </div>
          <ul class="list-group list-group-flush">
            <!-- looping isi -->
            <li class="list-group-item">Demand : {{$data['demand']}}</li>
            <li class="list-group-item">Tanggal Produksi : {{$data['tanggal']}}</li>
            <li class="list-group-item">Order Cost : {{$data['oc']}}</li>
            <li class="list-group-item">Carrying Cost : {{$data['cc']}}</li>
            <li class="list-group-item">Hasil EOQ : {{$data['eoq']}}</li>
            <li class="list-group-item">Frekwensi beli : {{$data['frekwensi']}}</li>
          </ul>
          <div class="row">
            <div class="col text-center my-3">
              <button type="button" name="button" class="btn btn-primary">
                <a href="#" style="text-decoration:none"></a>
                <i class="fas fa-plus-square"></i>
                Buat Jadwal Produksi
              </button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>


    @endsection

    @section('Eoq')
    <script type="text/javascript">
      function Eoq() {
        var demand = parseInt(document.getElementById('demand').value);
        var tanggal = document.getElementById('tanggal').value;
        var oc = parseInt(document.getElementById('oc').value);
        var cc = parseInt(document.getElementById('cc').value);

        var hasil = Math.sqrt(2*demand*oc/cc)
        var frekwensi = Math.round(demand/hasil)

        document.getElementById('hasil').value = hasil;
        document.getElementById('frekwensi').value = frekwensi;

        //memindah value ke hidden form
        document.getElementById('hdemand').value = demand;
        document.getElementById('htanggal').value = tanggal;
        document.getElementById('hoc').value = oc;
        document.getElementById('hcc').value = cc;
        document.getElementById('heoq').value = hasil;
        document.getElementById('hfrek').value = frekwensi;
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
