<?php include 'inc/header.php' ?>
<main class="my-5">
<div class="mb-8"></div>
<?php
if(isset($_POST['ulas'])){

    // filter data yang diinputkan
    $id_brg = $_POST['id_brg'];
    $nama   = $_POST['nama'];
    $isi   = $_POST['isi'];
  
    $query = "INSERT INTO komentar (id_brg,nama,isi) VALUES ('$id_brg','$nama','$isi')";
    $result = mysqli_query($koneksi, $query);
    // periska query apakah ada error
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
             " - ".mysqli_error($koneksi));
    } else {
      echo "<script>alert('Berhasil menambah ulasan !.');</script>";
    }
  }

if (isset($_GET['id'])) {

    $id = ($_GET["id"]);
  
    $sql1="SELECT * FROM produk where id='$id'";
    //query data
    $det=mysqli_query($koneksi,$sql1);
    //fetch data
    $detail=mysqli_fetch_array($det);
}?>

<main class="mt-4 mb-5">
    <div class="container">
      <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class="col-md-8 mb-4">
          <!--Section: Post data-mdb-->
          <section class="border-bottom mb-4">
            <center><h2><?php echo $detail['nama_produk'];?></h2></center>
            <img src="assets/produk/<?php echo $detail['gambar_produk'];?>"
              class="img-fluid shadow-2-strong rounded mb-4" alt="" />

            <div class="row align-items-center mb-4">
              <div class="col-lg-6 text-center text-lg-start mb-3 m-lg-0">
                <span> Pemilik : </span>
                <a href="" class="text-dark"><?php echo $detail['pemilik'];?></a>
              </div>
              <div class="col-lg-6 text-center text-lg-end">
                <button type="button" class="btn btn-success px-3 me-1" data-mdb-ripple-init>
                Rp <?php echo number_format($detail['harga_sewa'],0,',','.'); ?>
                </button>
                <button type="button" class="btn btn-primary px-3 me-1" data-mdb-ripple-init>
                Sewa
                </button>
              </div>
            </div>
          </section>
          <!--Section: Post data-mdb-->

          <!--Section: Text-->
          <section>
            <p>
            <?php echo $detail['deskripsi'];?>
            </p>
          </section>
          <!--Section: Text-->
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-4 mb-4">
          
          <!--Section: Comments-->
          <section class="border-bottom mb-3">
            <p class="text-center"><strong>Ulasan</strong></p>
            <?php
                $query = "SELECT * FROM komentar WHERE id_brg='$id' ORDER BY id DESC";
                $result = mysqli_query($koneksi, $query);
                if(!$result){
                    die ("Query Error: ".mysqli_errno($koneksi).
                    " - ".mysqli_error($koneksi));
                }
                while($ulasan = mysqli_fetch_assoc($result))
                {
                ?>
            <!-- Comment -->
            <div class="row mb-4">
              <div class="col-10">
                <p class="mb-2"><strong> <?php echo $ulasan['nama'];?></strong></p>
                <p>
                <?php echo $ulasan['isi'];?>
                </p>
              </div>
            </div>
          </section>
          <!--Section: Comments-->
          <?php
            }
            ?>
          <!--Section: Reply-->
          <section>
            <p class="text-center"><strong>Beri Ulasan</strong></p>

            <form action="" method="POST" enctype="multipart/form-data" >
                <input type="text" name="id_brg" value="<?php echo $detail['id'];?>"hidden>
              <!-- Name input -->
              <div class="form-outline mb-4" data-mdb-input-init>
                <input type="text" id="form4Example1" class="form-control" name="nama"/>
                <label class="form-label" for="form4Example1">Name</label>
              </div>

              <!-- Message input -->
              <div class="form-outline mb-4" data-mdb-input-init>
                <textarea class="form-control" id="form4Example3" rows="4" name="isi"></textarea>
                <label class="form-label" for="form4Example3">Ulasan</label>
              </div>

              <!-- Submit button -->
              <button type="submit" name="ulas" class="btn btn-primary btn-block mb-4" data-mdb-ripple-init>
                Ulas
              </button>
            </form>
          </section>
          <!--Section: Reply-->
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </div>
  </main>
  <!--Main layout-->
<?php include 'inc/footer.php' ?>