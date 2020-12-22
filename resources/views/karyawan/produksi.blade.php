@extends('tamplate.App')
<?php
$userid = auth()->user()->id;
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
  @if(session('sukses'))
<script>alert('{{session('sukses')}}');</script>
  @endif
  @if(session('gagal'))
      <script>alert('{{session('gagal')}}');</script>
  @endif
  @if($errors->has('kuantitas'))
  <script>alert('Data gagal di input');</script>
  @endif
  @section('content')
  <!-- Card Produk -->
    <div class="row d-flex flex-row-reverse my-3">
      <div class="btn btn-primary">
        <a href="{{route('produksi/show')}}" class="text-white" style="text-decoration:none;">
          Daftar Produksi
        </a>
      </div>

    </div>
    <div class="card-group row">
      @foreach($produk as $produk)
      <div class="card mx-3">
        <img class="card-img-top img-responsive" src="{{asset('images/'.$produk->foto)}}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">{{$produk['namaproduk']}}</h5>
          <!-- menghitung total produksi -->
          <?php
          $id_produk = $produk['id'];
          $sum = \App\Produksi::where('id_Produk', $id_produk)->sum('kuantitas');
           ?>
          <p class="card-text">Jumlah: {{$sum}}</p>
        </div>
        <div class="row">
          <div class="col text-center my-3">
            <button type="button" name="button" class="btn btn-warning"  data-namaproduk="{{$produk->namaproduk}}" data-idproduk="{{$produk->id}}" data-iduser="{{$userid}}"   data-toggle="modal" data-target="#modaltambahproduksi">
              <i class="fas fa-plus-square"></i>
              Input Hasil Produksi
            </button>
          </div>
        </div>
      </div>
      @endforeach
    </div>


    <!-- Modal Tambah Produksi -->
    <div class="modal fade" id="modaltambahproduksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="titleproduksi"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('produksi/create')}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              {{method_field('patch')}}
              <div class="form-group {{$errors->has('kuantitas')? '' : ''}}">
                <label for="kuantitas">Kuantitas Produksi</label>
                <input type="text" class="form-control"  name="kuantitas">
                @if($errors->has('kuantitas'))
                  <span class="help-block font-weight-bold text-danger">{{$errors->first('kuantitas')}}</span>
                @endif
              </div>
              <input type="hidden" class="form-control" id="idproduk"  name="idproduk" value="">
              <input type="hidden" class="form-control" id="iduser"  name="iduser" value="">

          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
            </form>
        </div>
      </div>
    </div>
  @endsection
  </body>
</html>
@section('script')
<script type="text/javascript">
$('#modaltambahproduksi').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var namaproduk = button.data('namaproduk')
  var idproduk = button.data('idproduk')
  var iduser = button.data('iduser')
  var modal = $(this)
  modal.find('.modal-body #idproduk').val(idproduk);
  modal.find('.modal-body #iduser').val(iduser);
  document.getElementById("titleproduksi").innerHTML = "Input Produksi: "+namaproduk;
})
</script>
@endsection
