<!doctype html>
<html lang="en">
  <head>

    <title></title>
  </head>
  <body>
    @if(auth()->user()->role == 'karyawan')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">MIPAN</a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Produksi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Inventaris</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Jadwal</a>
          </li>
        </ul>
        <span class="navbar-text">
        <li class="dropdown float-right">
              <i class="fas fa-ellipsis-v dropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white"></i>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item text-dark" href="#">Profil</a>
                <a class="dropdown-item text-dark" href="{{route('logout')}}">Logout</a>
              </div>
        </li>
        </span>

      </div>
    </nav>
    @endif

    @if(auth()->user()->role == 'admin')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="/home">MIPAN</a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Produk <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('eoq')}}">EOQ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('order_cost')}}">OC</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">CC</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Inventaris</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Jadwal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('karyawan')}}">Karyawan</a>
          </li>
        </ul>
        <li class="dropdown float-right">
              <i class="fas fa-ellipsis-v dropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white"></i>
              <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item text-dark" href="#">Profil</a>
                <a class="dropdown-item text-dark" href="{{route('logout')}}">Logout</a>
              </div>
        </li>

      </div>
    </nav>
    @endif



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script> -->

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>
