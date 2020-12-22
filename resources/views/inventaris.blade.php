@extends('tamplate.App')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
  <!-- pop up alert -->
  @section('content')

  @if(session('sukses'))
      <script>alert('{{session('sukses')}}');</script>
  @endif
  @if(session('gagal'))
      <script>alert('{{session('gagal')}}');</script>
  @endif
  @if($errors->has('nama_alat','jumlah','foto'))
      <script>alert('Data inventaris gagal di input');</script>
  @endif


  <!-- Button trigger Tambah Inventaris -->
  <div class="d-flex">
    <div class="mr-auto p-2">
      <h3 class="float-left mt-3">Daftar Inventaris</h3>
    </div>

    @if(auth()->user()->role == 'karyawan')
    <div class="p-2">
      <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#modaltambahinventaris">
        Tambah Inventaris
      </button>
    </div>
    @endif
  </div>

<!-- Card Inventaris -->
  <div class="row">
    @foreach($inventaris as $inventaris)
    <div class="col-sm-3 mx-3">
    <div class="card">
      <img class="card-img-top img-thumbnail" src="{{asset('images/'.$inventaris->foto)}}" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">Nama : {{$inventaris['nama_alat']}}</h5>
        <p class="card-text">Jumlah :  {{$inventaris['jumlah']}}</p>
      </div>

      @if(auth()->user()->role == 'karyawan')
      <div class="row">
        <div class="col text-right">
          <button type="button" name="button" class="btn btn-warning" data-nama_alat="{{$inventaris->nama_alat}}" data-jumlah="{{$inventaris->jumlah}}" data-prodid="{{$inventaris->id}}" data-toggle="modal" data-target="#modaleditinventaris">
            <i class="fas fa-edit text-dark" ></i>
          </button>
          <a href="{{route('inventaris/destroy', $inventaris['id'])}}" class="btn btn-danger" style="text-decoration:none">
            <i class="fas fa-trash text-white"></i>
          </a>
        </div>
      </div>
      @endif
    </div>
    </div>
    @endforeach
  </div>

  <!-- Modal Tambah Inventaris -->
  <div class="modal fade" id="modaltambahinventaris" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Inventaris</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('inventaris/create')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group {{$errors->has('nama_alat')? '' : ''}}">
              <label for="nama_alat">Nama Alat</label>
              <input type="text" class="form-control"  name="nama_alat" value="{{old('nama_alat')}}">
              @if($errors->has('nama_alat'))
                <span class="help-block font-weight-bold text-danger">{{$errors->first('nama_alat')}}</span>
              @endif
            </div>
            <div class="form-group {{$errors->has('jumlah')? '' : ''}}">
              <label for="jumlah">Jumlah</label>
              <input type="text" class="form-control"  name="jumlah" value="{{old('jumlah')}}">
              @if($errors->has('jumlah'))
                <span class="help-block font-weight-bold text-danger">{{$errors->first('jumlah')}}</span>
              @endif
            </div>
            <div class="form-group  {{$errors->has('foto')? '' : ''}}">
              <label for="foto">Foto Alat</label>
              <input type="file" class="form-control-file" name="foto">
              @if($errors->has('foto'))
                <span class="help-block font-weight-bold text-danger">{{$errors->first('foto')}}</span>
              @endif
            </div>

            <!-- menentukan iduser -->
            <?php
              $id = auth()->user()->id;
            ?>
            <input type="hidden" name="id_Karyawan" value="{{$id}}">
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
  <div class="modal fade" id="modaleditinventaris" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Inventaris</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('inventaris/update')}}" method="post" enctype="multipart/form-data" id="editform">
            {{csrf_field()}}
            {{method_field('patch')}}
            <div class="form-group {{$errors->has('nama_alat')? '' : ''}}">
              <label for="nama_alat">Nama Alat</label>
              <input type="text" class="form-control" id="nama_alat"  name="nama_alat" value="{{old('nama_alat')}}">
              @if($errors->has('nama_alat'))
                <span class="help-block font-weight-bold text-danger">{{$errors->first('nama_alat')}}</span>
              @endif
            </div>
            <div class="form-group {{$errors->has('jumlah')? '' : ''}}">
              <label for="jumlah">Jumlah</label>
              <input type="text" class="form-control" id="jumlah"  name="jumlah" value="{{old('jumlah')}}">
              @if($errors->has('jumlah'))
                <span class="help-block font-weight-bold text-danger">{{$errors->first('jumlah')}}</span>
              @endif
            </div>
            <div class="form-group  {{$errors->has('foto')? '' : ''}}">
              <label for="foto">Foto Alat</label>
              <input type="file" class="form-control-file" name="foto">
              @if($errors->has('foto'))
                <span class="help-block font-weight-bold text-danger">{{$errors->first('foto')}}</span>
              @endif
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
$('#modaleditinventaris').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var nama_alat = button.data('nama_alat')
  var jumlah = button.data('jumlah')
  var prodid = button.data('prodid')
  var modal = $(this)
  modal.find('.modal-body #nama_alat').val(nama_alat);
  modal.find('.modal-body #jumlah').val(jumlah);
  modal.find('.modal-body #prodid').val(prodid);
})
</script>
@endsection
