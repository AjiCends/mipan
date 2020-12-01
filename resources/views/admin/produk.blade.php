@extends('tamplate.App')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
  @section('content')
  <!-- Button trigger Tambah Produk -->
  <div class="d-flex">
    <div class="mr-auto p-2">
      <h3 class="float-left mt-3">Daftar Produk</h3>
    </div>

    <div class="p-2">
      <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#modaltambahproduk">
        Tambah Produk
      </button>
    </div>
  </div>

<!-- Card Produk -->
  <div class="card-group">
    @foreach($produk as $produk)
    <div class="card mx-3">
      <img class="card-img-top img-responsive" src="{{asset('images/'.$produk->foto)}}" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">{{$produk['namaproduk']}}</h5>
        <p class="card-text">Rp.{{$produk['harga']}}</p>
      </div>
      <div class="row">
        <div class="col text-right">
          <button type="button" name="button" class="btn btn-warning" data-namaproduk="{{$produk->namaproduk}}" data-harga="{{$produk->harga}}" data-prodid="{{$produk->id}}" data-toggle="modal" data-target="#modaleditproduk">
            <i class="fas fa-edit text-dark" ></i>
          </button>
          <a href="{{route('produk/destroy', $produk['id'])}}" class="btn btn-danger" style="text-decoration:none">
            <i class="fas fa-trash text-white"></i>
          </a>
        </div>
      </div>
    </div>
    @endforeach
  </div>



















  <!-- Modal Tambah Produk -->
  <div class="modal fade" id="modaltambahproduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Produk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('produk/create')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
              <label for="namaproduk">Nama Produk</label>
              <input type="text" class="form-control"  name="namaproduk">
            </div>
            <div class="form-group">
              <label for="harga">Harga</label>
              <input type="text" class="form-control"  name="harga">
            </div>
            <div class="form-group">
              <label for="foto">Foto Produk</label>
              <input type="file" class="form-control-file" name="foto">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
          </form>
      </div>
    </div>
  </div>

  <!-- Modal Edit -->
  <div class="modal fade" id="modaleditproduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Produk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('produk/update')}}" method="post" enctype="multipart/form-data" id="editform">
            {{csrf_field()}}
            {{method_field('patch')}}
            <div class="form-group">
              <label for="namaproduk">Nama Produk</label>
              <input type="text" class="form-control" id="namaproduk" name="namaproduk" value="">
            </div>
            <div class="form-group">
              <label for="harga">Harga</label>
              <input type="text" class="form-control" id="harga" name="harga" value="">
            </div>
            <div class="form-group">
            <label for="foto">Foto Produk</label>
              <input type="file" class="form-control-file" id="foto" name="foto" value="">
            </div>
            <input type="hidden" name="prodid" id="prodid" value="">
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
$('#modaleditproduk').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var namaproduk = button.data('namaproduk')
  var harga = button.data('harga')
  var prodid = button.data('prodid')
  var modal = $(this)
  modal.find('.modal-body #namaproduk').val(namaproduk);
  modal.find('.modal-body #harga').val(harga);
  modal.find('.modal-body #prodid').val(prodid);
})
</script>
@endsection
