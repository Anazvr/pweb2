
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
#tambah
if(isset($_POST['tambah'])){

  // filter data yang diinputkan
  $nama       = $_POST['nama'];
  $username   = $_POST['username'];
  $password   = $_POST['password'];

  $query = "INSERT INTO user (nama,username,password) VALUES ('$nama','$username','$password')";
  $result = mysqli_query($koneksi, $query);
  // periska query apakah ada error
  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
  } else {
    echo "<script>alert('Berhasil menambah user !.');window.location='menu_user.php';</script>";
  }
}
#ubah
if(isset($_POST['edit'])){

  // filter data yang diinputkan
  $id_user    = $_POST['id_user'];
  $nama       = $_POST['nama'];
  $username   = $_POST['username'];
  $password   = $_POST['password'];

  $query = "UPDATE user SET nama='$nama', username='$username',password='$password' WHERE id_user='$id_user'";
  $result = mysqli_query($koneksi, $query);
  // periska query apakah ada error
  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
  } else {
    echo "<script>alert('Berhasil edit user !.');window.location='menu_user.php';</script>";
  }
}

#Hapus
if ($_GET['act'] == 'hapus'){
  $id_user = $_GET['id_user'];

  //query hapus
  $querydelete = mysqli_query($koneksi, "DELETE FROM user WHERE id_user = '$id_user'");

  if ($querydelete) {
      # redirect ke index.php
      echo "<script>alert('Data berhasil dihapu.');window.location='menu_user.php';</script>";
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
            <strong>Daftar Pengguna</strong>
          </h2>
        </div>
        <div class="card-body">
        <center><button type="button" class="btn btn-primary btn-sm" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#tambah">+ &nbsp; Tambah User</i></button><center>
    <br/>
    <div class="datatable">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th class="th-sm">No</th>
        <th class="th-sm">Nama</th>
        <th class="th-sm">Username</th>
        <th class="th-sm">Password</th>
        <th class="th-sm">Level</th>
        <th class="th-sm">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
      $query = "SELECT * FROM user ORDER BY id_user DESC";
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
          <td><?php echo $row['nama']; ?></td>
          <td><?php echo $row['username']; ?></td>
          <td><?php echo $row['password']; ?></td>
          <td><?php echo $row['level']; ?></td>
          <td>
              <button type="button" class="btn btn-success btn-sm" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#edit<?php echo $row['id_user']; ?>"><i class="fa-regular fa-pen-to-square"></i></button>
              <a href="?act=hapus&id_user=<?php echo $row['id_user']; ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')"><button type="button" class="btn btn-danger btn-sm" data-mdb-ripple-init><i class="fa-solid fa-trash"></i></button></a>
          </td>
      </tr>
<!--Modal Edit user-->
<div class="modal fade" id="edit<?php echo $row['id_user']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit user</h5>
                                <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                              <form action="" method="POST" enctype="multipart/form-data" >
                              <input type="text" name="id_user" value="<?php echo $row['id_user']; ?>" hidden>
                                <section class="base">
                                  <div class="form-outline mb-4">
                                    <input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>"/>
                                    <label class="form-label" >Nama</label>
                                  </div>
                                  <div class="form-outline mb-4">
                                    <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>"/>
                                    <label class="form-label" >Username</label>
                                  </div>
                                  <div class="form-outline mb-4">
                                    <input type="text" name="password" class="form-control" value="<?php echo $row['password']; ?>"/>
                                    <label class="form-label" >Password</label>
                                  </div>
                                </section>
                              
                                <div class="modal-footer">
                                  <button type="button" class="btn sm btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">
                                    Close
                                  </button>
                                  <button type="submit" name="edit" class="btn sm btn-success">Edit user</button>
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
<!--Main layout-->
<!--Modal Tambah User-->
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
                                    <input type="text" name="nama" class="form-control"/>
                                    <label class="form-label" >Nama</label>
                                  </div>
                                  <div class="form-outline mb-4">
                                    <input type="text" name="username" class="form-control"/>
                                    <label class="form-label" >Username</label>
                                  </div>
                                  <div class="form-outline mb-4">
                                    <input type="text" name="password" class="form-control"/>
                                    <label class="form-label" >Password</label>
                                  </div>
                                </section>
                                <div class="modal-footer">
                                  <button type="button" class="btn sm btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">
                                    Close
                                  </button>
                                  <button type="submit" name="tambah" class="btn sm btn-success">Tambah User</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
    </div>
<?php  include('inc/footer.php');?>