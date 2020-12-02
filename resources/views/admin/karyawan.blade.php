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
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data_karyawan as $karyawan)
          <tr>
            <th scope="row">{{$karyawan->id}}</th>
            <td>{{$karyawan->nama}}</td>
            <td>{{$karyawan->gender}}</td>
            <td>{{$karyawan->alamat}}</td>
            <td>
              <a href="#" class="btn btn-warning" data-id="{{$karyawan->id}}" data-nama="{{$karyawan->nama}}" data-gender="{{$karyawan->gender}}" data-alamat="{{$karyawan->alamat}}" data-toggle="modal" data-target="#modaleditkaryawan"><i class="fas fa-edit text-dark"></i></a>
              <a href="{{route('karyawan/destroy',$karyawan->id)}}" class="btn btn-danger"><i class="fas fa-trash text-white"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modaleditkaryawan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Karyawan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('karyawan/update')}}" method="post" enctype="multipart/form-data" id="editform">
              {{csrf_field()}}
              {{method_field('patch')}}
              <div class="form-group">
                <label for="namaproduk">ID</label>
                <input type="text" class="form-control" id="id" name="id" value="" readonly>
              </div>
              <div class="form-group">
                <label for="nama">Nama Karyawan</label>
                <input type="text" class="form-control" id="nama" name="nama" value="">
              </div>
              <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control form-control" id="gender" name="gender" name="gender" style="border-radius: 25rem;" required>
                  <option value="L">Laki-Laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" rows="8" cols="63"></textarea>
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

    @endsection
</body>
</html>
@section('script')
<script type="text/javascript">
$('#modaleditkaryawan').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id = button.data('id')
  var nama = button.data('nama')
  var gender = button.data('gender')
  var alamat = button.data('alamat')
  var modal = $(this)
  modal.find('.modal-body #id').val(id);
  modal.find('.modal-body #nama').val(nama);
  modal.find('.modal-body #gender').val(gender);
  modal.find('.modal-body #alamat').val(alamat);
})
</script>
@endsection
