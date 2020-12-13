@extends('tamplate.App')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    @section('content')
    <div class="row">
      <div class="col-4 btn">
        <div class="d-flex flex-row justify-content-center">
          <i class="fas fa-pause-circle btn-lg text-primary"></i>
        </div>
        <div class="d-flex flex-row justify-content-center">
          Waiting
        </div>
      </div>

      <div class="col-4 btn">
        <div class="d-flex flex-row justify-content-center">
          <i class="fas fa-pause-circle btn-lg text-warning"></i>
        </div>
        <div class="d-flex flex-row justify-content-center">
          Proses
        </div>
      </div>

      <div class="col-4 btn">
        <div class="d-flex flex-row justify-content-center">
          <i class="fas fa-play-circle btn-lg text-danger"></i>
        </div>
        <div class="d-flex flex-row justify-content-center">
          Done
        </div>
      </div>
    </div>
      <div class="">
        @if(auth()->user()->role == 'karyawan')
        @foreach($jadwal as $jadwal)
        <div class="card my-5">
          <div class="card-body">
            <h5 class="card-title">Tanggal Produksi: {{$jadwal['tanggal']}}</h5>
            <p class="card-text">Produksi: {{$jadwal['produk']}}</p>
            <p class="card-text">Target Produksi: {{$jadwal['jumlahBahan']}}</p>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-status="{{$jadwal->status}}" data-id="{{$jadwal->id}}" data-tanggal="{{$jadwal->tanggal}}" data-produk="{{$jadwal->produk}}" data-produksi="{{$jadwal->jumlahBahan}}" data-target="#modaleditstatus">
              {{$jadwal['status']}}
            </a>
          </div>
        </div>
        @endforeach
        @endif

        @if(auth()->user()->role == 'admin')
        @foreach($jadwal as $jadwal)
        <div class="card my-5">
          <div class="card-body">
            <h5 class="card-title">Tanggal Produksi: {{$jadwal['tanggal']}}</h5>
            <p class="card-text">Target Produksi: {{$jadwal['jumlahBahan']}}</p>
            <a href="#" class="btn btn-primary">{{$jadwal['status']}}</a>
          </div>
        </div>
        @endforeach
        @endif
      </div>

      <!-- Modal edit status -->
      <div class="modal fade" id="modaleditstatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Ubah Status Jadwal</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{route('jadwal/update')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <h5 class="card-title" id="utanggal"></h5>
                <p class="card-text" id="uproduk"></p>
                <p class="card-text" id="uproduksi"></p>
                <p class="card-text" id="ustatus"></p>
                <input type="hidden" name="jadwal_id" id="uid" value="">
                <?php
                $karyawan_id = auth()->user()->id;
                ?>
                <input type="hidden" name="karyawan_id" value="{{$karyawan_id}}">
                <input type="hidden" name="status" id="ustat" value="">
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
$('#modaleditstatus').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id = button.data('id')
  var tanggal = button.data('tanggal')
  var produk = button.data('produk')
  var produksi = button.data('produksi')
  var status = button.data('status')
  var modal = $(this)

  if (status == "waiting") {
    var status = "proses"
  }else {
    var status = "done"
  }

  document.getElementById("utanggal").innerHTML ="Tanggal: " + tanggal;
  document.getElementById("uproduk").innerHTML ="Produk: " + produk;
  document.getElementById("uproduksi").innerHTML ="Produksi: " + produksi;
  document.getElementById("ustatus").innerHTML ="Apakah status jadwal akan diganti ke: " + status + " ?";
  modal.find('.modal-body #uid').val(id);
  modal.find('.modal-body #ustat').val(status);
})
</script>
@endsection
