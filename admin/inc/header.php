<!DOCTYPE html>
<html lang="en">
<?php include '../inc/koneksi.php';
$sweb="SELECT * FROM web where id='1'";
//query data
$qweb=mysqli_query($koneksi,$sweb);
//fetch data
$web=mysqli_fetch_array($qweb);
?>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Admin <?php echo $web['namaweb']?></title>
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="../assets/fas/css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="../assets/css/mdb.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
  </head>
  <body>

    <!----------------------------------------------------------------------- 
      
    This template was created with MDB 5 UI KIT (Material Design for Bootstrap 5).

    MDB is a free (MIT license) library, that provides extra features and significantly extends Bootstrap's capabilities.

    Visit our website to learn more: https://mdbootstrap.com/docs/standard/ 
  
    --------------------------------------------------------------------------->

    <!--Main Navigation-->
    <header>
<!-- Navbar -->
<nav data-mdb-navbar-init class="navbar fixed-top navbar-expand-lg navbar-light bg-body-tertiary">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
      data-mdb-collapse-init
      class="navbar-toggler"
      type="button"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0" href="#">
        <img
          src="../assets/<?php echo $web['logo']?>"
          height="50"
          alt="<?php echo $web['namaweb']?>"
          loading="lazy"
        />
      </a>
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menu_produk.php">Data Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menu_kategori.php">Kategori</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menu_user.php">Pengguna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menu_setting.php">Pengaturan Web</a>
        </li>
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->

    <!-- Right elements -->
    <div class="d-flex align-items-center">
      <!-- Icon -->
      <a class="text-reset me-3" href="../logout.php">
      <button type="button" class="btn btn-danger" data-mdb-ripple-init><i class="fa-solid fa-arrow-right-to-bracket"></i></button>
      </a>
    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->
</header>