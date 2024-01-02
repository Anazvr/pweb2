<?php
session_start();

//cek apakah user sudah login
if(!isset($_SESSION['username']))
{
  header("location:/login.php?pesan=gagal");
}

//cek level user
if($_SESSION['level']!="user")
{
  header("location:/login.php?pesan=ta");
}
$pemilik =  $_SESSION['username'];
?>
<?php  include('inc/header.php');?>


<!--Main layout-->
<main style="margin-top: 58px">
  <div class="container pt-4">
        <!--Section: Sales Performance KPIs-->
    <section class="mb-4">
      <h1>Selamat Datang, <?php echo $pemilik?> di halaman User SEWAON</h1>
    </section>
  </div>
</main>
<!--Main layout-->
<?php  include('inc/footer.php');?>