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
if(isset($_POST['tambah'])){

  // filter data yang diinputkan
  $kategori   = $_POST['kategori'];

  $query = "INSERT INTO kategori (kategori) VALUES ('$kategori')";
  $result = mysqli_query($koneksi, $query);
  // periska query apakah ada error
  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
  } else {
    echo "<script>alert('Berhasil menambah kategori !.');window.location='menu_kategori.php';</script>";
  }
}

if(isset($_POST['edit'])){

  // filter data yang diinputkan
  $id_kat     = $_POST['id_kat'];
  $kategori   = $_POST['kategori'];

  $query = "UPDATE kategori SET kategori='$kategori' WHERE id_kat='$id_kat'";
  $result = mysqli_query($koneksi, $query);
  // periska query apakah ada error
  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
  } else {
    echo "<script>alert('Berhasil edit kategori !.');window.location='menu_kategori.php';</script>";
  }
}

#Hapus
if ($_GET['act'] == 'hapus'){
  $id_kat = $_GET['id_kat'];

  //query hapus
  $querydelete = mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kat = '$id_kat'");

  if ($querydelete) {
      # redirect ke index.php
      echo "<script>alert('Data berhasil dihapu.');window.location='menu_kategori.php';</script>";
  }
  else{
      echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
  }

  mysqli_close($koneksi);
}

?>


<!--Main layout-->
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
    <center><button type="button" class="btn btn-primary btn-sm" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#tambah">+ &nbsp; Tambah Kategori</i></button><center>
      
    <br/>
    <div class="datatable">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th class="th-sm">No</th>
        <th class="th-sm">Kategori</th>
        <th class="th-sm">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
      $query = "SELECT * FROM kategori ORDER BY id_kat DESC";
      $result = mysqli_query($koneksi, $query);
      //mengecek apakah ada error ketika menjalankan query
      if(!$result){
        die ("Query Error: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
      }

      //buat perulangan untuk element tabel dari data mahasiswa
      $no = 1; //variabel untuk membuat nomor urut
      // hasil query akan disimpan dalam variabel $data dalam bentuk array
      // kemudian dicetak dengan perulangan while
      while($row = mysqli_fetch_assoc($result))
      {
      ?>
       <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $row['kategori']; ?></td>
          <td>
              <button type="button" class="btn btn-success btn-sm" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#edit<?php echo $row['id_kat']; ?>"><i class="fa-regular fa-pen-to-square"></i></button>
              <a href="?act=hapus&id_kat=<?php echo $row['id_kat']; ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')"><button type="button" class="btn btn-danger btn-sm" data-mdb-ripple-init><i class="fa-solid fa-trash"></i></button></a>
          </td>
      </tr>
<!--Modal Edit Kategori-->
<div class="modal fade" id="edit<?php echo $row['id_kat']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                                <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                              <form action="" method="POST" enctype="multipart/form-data" >
                              <input type="text" name="id_kat" value="<?php echo $row['id_kat']; ?>" hidden>
                                <section class="base">
                                  <div class="form-outline mb-4">
                                    <input type="text" name="kategori" class="form-control" value="<?php echo $row['kategori']; ?>"/>
                                    <label class="form-label" >Nama Kategori</label>
                                  </div>
                                </section>
                              
                                <div class="modal-footer">
                                  <button type="button" class="btn sm btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">
                                    Close
                                  </button>
                                  <button type="submit" name="edit" class="btn sm btn-success">Edit Kategori</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
         
      <?php
        $no++; //untuk nomor urut terus bertambah 1
      }
      ?>
    </tbody>
  </table>
</div>
        </div>
      </div>
    </section>
  </div>
</main>
<!--Modal Tambah Kategori-->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                                <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                              <form action="" method="POST" enctype="multipart/form-data" >
                                <section class="base">
                                  <div class="form-outline mb-4">
                                    <input type="text" name="kategori" class="form-control" />
                                    <label class="form-label" >Nama Kategori</label>
                                  </div>
                                </section>
                              
                                <div class="modal-footer">
                                  <button type="button" class="btn sm btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">
                                    Close
                                  </button>
                                  <button type="submit" name="tambah" class="btn sm btn-success">Simpan Kategori</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
<?php  include('inc/footer.php');?>