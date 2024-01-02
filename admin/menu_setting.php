<?php
session_start();

//cek apakah user sudah login
if(!isset($_SESSION['username']))
{
  header("location:/login.php?pesan=gagal");
}

//cek level user
if($_SESSION['level']!="admin")
{
  header("location:/login.php?pesan=ta");
}
?>
<?php  include('inc/header.php');
#Edit
if(isset($_POST['edit'])){

  // filter data yang diinputkan
  $namaweb      = $_POST['namaweb'];
  $deskripsi    = $_POST['deskripsi'];
  $tentang      = $_POST['tentang'];
  $map          = $_POST['map'];
  $alamat       = $_POST['alamat'];
  $telpon       = $_POST['telpon'];
  $ig           = $_POST['ig'];
  $buka         = $_POST['buka'];
  

  $query = "UPDATE web SET namaweb='$namaweb',deskripsi='$deskripsi',tentang='$tentang',map='$map',alamat='$alamat',telpon='$telpon',ig='$ig',buka='$buka' WHERE id='1'";
  $result = mysqli_query($koneksi, $query);
  // periska query apakah ada error
  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
  } else {
    echo "<script>alert('Berhasil edit web!.');window.location='menu_setting.php';</script>";
  }
}

?>
<main style="margin-top: 58px">
  <div class="container pt-4">
        <!--Section: Sales Performance KPIs-->
    <section class="mb-4">
      <div class="card">
        <div class="card-header text-center py-3">
          <h2 class="mb-0 text-center">
            <strong>Kategori</strong>
          </h2>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data" >
                              <input type="text" name="id_kat" value="<?php echo $row['id_kat']; ?>" hidden>
                                <section class="base">
                                  <div class="form-outline mb-4">
                                    <label>Nama Web</label>
                                    <input type="text" name="namaweb" class="form-control" value="<?php echo $web['namaweb']; ?>"/>
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" ><?php echo $web['deskripsi']; ?></textarea>
                                    <label>Tentang</label>
                                    <input type="text" name="tentang" class="form-control" value="<?php echo $web['tentang']; ?>"/>
                                    <label>Map</label>
                                    <textarea name="map" class="form-control" ><?php echo $web['map']; ?></textarea>
                                    <label>Alamat</label>
                                    <input type="text" name="alamat" class="form-control" value="<?php echo $web['alamat']; ?>"/>
                                    <label>Telpon</label>
                                    <input type="text" name="telpon" class="form-control" value="<?php echo $web['telpon']; ?>"/>
                                    <label>Instagram</label>
                                    <input type="text" name="ig" class="form-control" value="<?php echo $web['ig']; ?>"/>
                                    <label>Jam Buka</label>
                                    <input type="text" name="buka" class="form-control" value="<?php echo $web['buka']; ?>"/>
                                  </div>
                                </section>
                                  <button type="submit" name="edit" class="btn sm btn-success">Edit Web</button>
                              </form>
        </div>
    </section>
</div>
</main>

<?php  include('inc/footer.php');?>
