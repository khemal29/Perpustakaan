<?php
include'koneksi.php';
$tgl=date('Y-m-d');
session_start();
if(isset($_SESSION['sesi'])){
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="assets/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/admin.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Perpustakaan Umum</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">SELAMAT DATANG</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="index.php?p=home"><i class="fas fa-home"></i>Home</a>
              </li>

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-database"></i>Data Master
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                    <li><a class="dropdown-item" href="index.php?p=anggota"><i class="fas fa-user"></i>Anggota</a></li>
                    <li><a class="dropdown-item" href="index.php?p=buku"><i class="fas fa-book-open"></i>Buku</a></li>
                  </ul>
                </li>

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-exchange-alt"></i>Data Transaksi
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                    <li><a class="dropdown-item" href="index.php?p=transaksi-peminjaman">Peminjaman</a></li>
                    <li><a class="dropdown-item" href="index.php?p=pengembalian">Pengembalian</a></li>
                  </ul>
                </li>
            </ul>
          </div>
        </div>
      </nav>
  
    <!-- Page Content Holder -->
    
          <div>
            <div class="container-fluid">
              </div>
            </div>
            <div class="mt-3">
             <?php
                $pages_dir='pages';
                if(!empty($_GET['p'])){
                  $pages=scandir($pages_dir,0);
                  unset($pages[0],$pages[1]);
                  $p=$_GET['p'];
                  if(in_array($p.'.php',$pages)){
                    include($pages_dir.'/'.$p.'.php');
                  }else{
                    echo'Halaman Tidak Ditemukan';
                  }
                }else{
                  include($pages_dir.'/home.php');
                }
              ?>


          </div>
          
        </div>
      </div>
    </div>
  </div>
    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
     
  


  </body>
</html>

<?php
}
else {
  echo "<script>
    alert('Anda Harus Login Dahulu!');
  </script>";
  header('location:login.php');
}
?>