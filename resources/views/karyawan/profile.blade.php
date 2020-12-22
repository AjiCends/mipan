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
    <div class="d-flex justify-content-center  align-items-center " style="height: 90vh">
    <div class="card justify-content-center" style="width: 80%;">
      <div class="card-body">
        <h5 class="card-title">Profile Karyawan</h5>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <div class="form-group">
            <label for="namaproduk">Nama:</label>
            <input type="text" class="form-control" id="id" name="id" value="{{$data['nama']}}" readonly>
          </div>
        </li>
        <li class="list-group-item">
          <div class="form-group">
            <?php
            if ($data['gender']=="L") {
              $gender = "Laki-Laki";
            } else {
              $gender = "Perempuan";
            }
            ?>
            <label for="gender">Gender:</label>
            <input type="text" class="form-control" id="gender" name="gender" value="{{$gender}}" readonly>
          </div>
        </li>
        <li class="list-group-item">
          <div class="form-group">
            <label for="alamat">Alamat:</label>
            <textarea name="name p-2" rows="5" style="width:100%" readonly>{{$data['alamat']}}</textarea>
          </div>
        </li>
      </ul>
      <div class="card-body">
        <a href="#" class="btn btn-warning" data-id="{{$data->id}}" data-nama="{{$data->nama}}" data-gender="{{$data->gender}}" data-alamat="{{$data->alamat}}" data-toggle="modal" data-target="#modaleditkaryawan"><i class="fas fa-edit text-dark"></i></a>
      </div>
    </div>
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
            <form action="{{route('profile/update')}}" method="post" enctype="multipart/form-data" id="editform">
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
    @endforeach
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
