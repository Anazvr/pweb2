

<?php include 'inc/header.php' ?>
<?php
include 'inc/koneksi.php';
if(isset($_POST['register'])){

    // filter data yang diinputkan
    $nama   = $_POST['nama'];
    $username     = $_POST['username'];
    $password    = $_POST['password'];
    $level    = $_POST['level'];

    $query = "INSERT INTO user (nama, username, password, level) VALUES ('$nama', '$username', '$password', '$level')";
    $result = mysqli_query($koneksi, $query);
    // periska query apakah ada error
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
             " - ".mysqli_error($koneksi));
    } else {
      //tampil alert dan akan redirect ke halaman index.php
      //silahkan ganti index.php sesuai halaman yang akan dituju
      echo "<script>alert('Berhasil membuat akun, silahkan login!.');window.location='login.php';</script>";
    }
}

?>
<div class="container">
    <div class="mb-8"></div>
          <div class="row justify-content-center">
            <div class="col-xl-5 col-md-8">
                <form action="" method="POST" class="bg-white rounded shadow-5-strong p-5">
                    <div class="form-outline mb-4">
                    <input type="text" name="nama" class="form-control" />
                    <label class="form-label" >Nama</label>
                    </div>

                    <div class="form-outline mb-4">
                    <input type="text" name="username" class="form-control" />
                    <label class="form-label" >Username</label>
                    </div>

                    <div class="form-outline mb-4">
                    <input type="password" name="password" class="form-control" />
                    <label class="form-label" >Password</label>
                    </div>

                    <div class="form-outline mb-4">
                    <select class="form-control" name="level" >
						<option value="">Pilih Level</option>
						<option value="user">User</option>
					    <option value="admin">Admin</option>
					</select>
                    </div>
                    <input type="submit" class="btn btn-success btn-block" name="register" value="Daftar" />
                </form>
            </div>
            <div class="mb-4"></div>
</div>
                  </div>
    <?php include 'inc/footer.php' ?>