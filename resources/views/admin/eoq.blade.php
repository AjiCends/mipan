@extends('tamplate.App')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    @section('content')
        <h2>Perhitungan EOQ</h2>
          <div class="form-group">
            <label for="demand">Jumlah Permintaan</label>
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
          <button class="btn btn-primary" onclick="Eoq()">Hitung</button>
          <br>
          <br>
          <div class="form-group">
            <label for="hasil">Hasil</label>
            <input type="text" class="form-control" id="hasil">
          </div>
    @endsection
    @section('Eoq')
    <script type="text/javascript">
      function Eoq() {
        var demand = parseInt(document.getElementById('demand').value);
        var oc = parseInt(document.getElementById('oc').value);
        var cc = parseInt(document.getElementById('cc').value);

        var hasil = Math.sqrt(2*demand*oc/cc)

        document.getElementById('hasil').value = hasil;
      }


    </script>
    @endsection
  </body>

</html>
