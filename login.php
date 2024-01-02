<?php include 'inc/header.php' ?>
<div class="container">
    <div class="mb-8"></div>
          <div class="row justify-content-center">
            <div class="col-xl-5 col-md-8">
                    <?php 
                    if(isset($_GET['pesan'])){
                    if($_GET['pesan']=="gagal"){
                    echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
                    }
                    if($_GET['pesan']=="ta"){
                        echo "<div class='alert'>Tidak Punya Akses !</div>";
                        }
                    }
                    ?>
              <form action="cek_login.php" method="post" class="bg-white rounded shadow-5-strong p-5">
                <div class="form-outline mb-4">
                  <input type="text" name="username" class="form-control" />
                  <label class="form-label" >Username</label>
                </div>
                <div class="form-outline mb-4">
                  <input type="password" name="password" class="form-control" />
                  <label class="form-label" >Password</label>
                </div>
                <div class="row mb-4">

                  <div class="col text-center">
                    Belum Punya Akun? <a href="daftar.php">Daftar</a>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Masuk</button>
              </form>
            </div>
            <div class="mb-4"></div>
</div>
                  </div>
    <?php include 'inc/footer.php' ?>