@extends('tamplate.App')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    @section('content')
    <?php //dd($data); ?>
    <!-- Cretae OC Form -->
    <div class="container">
      <br />
      <h3>Carrying Cost</h3>
      <br />
      <div class="table-responsive">
      <form action="{{route('carrying_cost/create')}}" method="post" id="dynamic_form">
        @csrf
        <!-- input nama order cost -->
        <div class="form-group">
          <label for="namacc">Nama Order Cost</label>
          <select class="form-control" id="namacc" name="namacc">
            @foreach($produk as $produk)
            <option>{{$produk['namaproduk']}}</option>
            @endforeach
          </select>
        </div>
        <!-- input interval -->
        <div class="form-group">
          <label for="interval">Interval per:</label>
          <select class="form-control" id="interval" name="interval">
            <option>Minggu</option>
            <option>Bulan</option>
            <option>Tahun</option>
          </select>
        </div>
        <!-- dynamic filed form -->
       <span id="result"></span>
       <table class="table table-bordered table-striped" id="user_table">
         <thead>
          <tr>
            <th width="35%">Kegiatan</th>
            <th width="35%">Ongkos</th>
            <th width="30%">Aksi</th>
          </tr>
         </thead>
         <tbody>

         </tbody>
         <tfoot>
          <tr>
            <td colspan="2" align="right">&nbsp;</td>
            <td>
              <input type="submit" name="save" id="save" class="btn btn-primary"/>
            </td>
          </tr>
        </tfoot>
      </table>
      </form>
    </div>
    </div>

    <!-- Daftar Carrying Cost-->
    <h3 class="mt-5">Daftar Carrying Cost</h3>

    <!-- card Carrying cost -->
    <!-- looping json -->
    <div class="row row-cols-1 row-cols-md-3 mt-3">
      <!-- looping the keys -->
      <?php $hitung = 0 ?>
      @foreach ($data as $data)
      <?php $hitung = $hitung+1 ?>
      <div class="col mb-4">
        <div class="card">
          <div class="card-header bg-warning text-dark">
            {{$data['title']}}
            <a href="{{route('carrying_cost/destroy', ['id'=>$data['id'], 'count' => $hitung])}}" style="text-decoration:none">
              <i class="fas fa-trash float-right text-dark"></i>
            </a>
          </div>
          <ul class="list-group list-group-flush">
            <!-- looping isi -->
            @foreach ($data['value'] as $isi)
            <li class="list-group-item">{{$isi['kegiatan']}} : {{$isi['harga']}}</li>
            @endforeach
            <li class="list-group-item">Interval : / {{$data['interval']}}</li>
          </ul>
          <div class="row">
            <div class="col">
              <a href="#" class="" style="text-decoration:none">
                <button type="button" class="btn btn-warning float-right">
                  <i class="fas fa-edit"></i>
                  edit
                </button>
              </a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @endsection
  </body>
</html>

@section('script')
<script type="text/javascript">
$(document).ready(function(){

 var count = 1;

 dynamic_field(count);

 function dynamic_field(number)
 {
  html = '<tr>';
        html += '<td><input type="text" name="kegiatan[]" class="form-control" /></td>';
        html += '<td><input type="text" name="ongkos[]" class="form-control" /></td>';
        if(number > 1)
        {
            html += '<td><button type="button" name="remove" id="remove" class="btn btn-danger remove">Remove</button></td></tr>';
            $('tbody').append(html);
        }
        else
        {
            html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
            $('tbody').html(html);
        }
 }

 $(document).on('click', '#add', function(){
  count++;
  dynamic_field(count);
 });

 $(document).on('click', '.remove', function(){
  count--;
  $(this).closest("tr").remove();
 });
});
</script>
@endsection
