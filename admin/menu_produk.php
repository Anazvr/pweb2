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

  // membuat variabel untuk menampung data dari form
  $pemilik       = $_POST['pemilik'];
  $nama_produk   = $_POST['nama_produk'];
  $kategori      = $_POST['kategori'];
  $deskripsi     = $_POST['deskripsi'];
  $harga_sewa    = $_POST['harga_sewa'];
  $gambar_produk = $_FILES['gambar_produk']['name'];


//cek dulu jika ada gambar produk jalankan coding ini
if($gambar_produk != "") {
  $ekstensi_diperbolehkan = array('png','jpg'); //ekstensi file gambar yang bisa diupload 
  $x = explode('.', $gambar_produk); //memisahkan nama file dengan ekstensi yang diupload
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['gambar_produk']['tmp_name'];   
  $angka_acak     = rand(1,999);
  $nama_gambar_baru = $angka_acak.'-'.$gambar_produk; //menggabungkan angka acak dengan nama file sebenarnya
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {     
                move_uploaded_file($file_tmp, '../assets/produk/'.$nama_gambar_baru); //memindah file gambar ke folder gambar
                  // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
                  $query = "INSERT INTO produk (nama_produk, deskripsi, harga_sewa, gambar_produk, kategori, pemilik) VALUES ('$nama_produk', '$deskripsi', '$harga_sewa', '$nama_gambar_baru', '$kategori', '$pemilik')";
                  $result = mysqli_query($koneksi, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {
                    //tampil alert dan akan redirect ke halaman menu_produk.php
                    //silahkan ganti menu_produk.php sesuai halaman yang akan dituju
                    echo "<script>alert('Data berhasil ditambah.');window.location='menu_produk.php';</script>";
                  }

            } else {     
             //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_produk.php';</script>";
            }
} else {
   $query = "INSERT INTO produk (nama_produk, deskripsi, harga_sewa, gambar_produk, kategori, pemilik) VALUES ('$nama_produk', '$deskripsi', '$harga_sewa', null, '$kategori', '$pemilik')";
                  $result = mysqli_query($koneksi, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {
                    //tampil alert dan akan redirect ke halaman menu_produk.php
                    //silahkan ganti menu_produk.php sesuai halaman yang akan dituju
                    echo "<script>alert('Data berhasil ditambah.');window.location='menu_produk.php';</script>";
                  }
}

}
//EDIT FUNGSI
if(isset($_POST['edit'])){
  $id            = $_POST['id'];
  // membuat variabel untuk menampung data dari form
  $nama_produk   = $_POST['nama_produk'];
  $kategori      = $_POST['kategori'];
  $deskripsi     = $_POST['deskripsi'];
  $harga_sewa    = $_POST['harga_sewa'];
  $gambar_produk = $_FILES['gambar_produk']['name'];


//cek dulu jika ada gambar produk jalankan coding ini
if($gambar_produk != "") {
  $ekstensi_diperbolehkan = array('png','jpg'); //ekstensi file gambar yang bisa diupload 
  $x = explode('.', $gambar_produk); //memisahkan nama file dengan ekstensi yang diupload
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['gambar_produk']['tmp_name'];   
  $angka_acak     = rand(1,999);
  $nama_gambar_baru = $angka_acak.'-'.$gambar_produk; //menggabungkan angka acak dengan nama file sebenarnya
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
                $sql2="SELECT * FROM produk where id='$id'";
                //query data
                $hpsgbr=mysqli_query($koneksi,$sql2);
                //fetch data
                $jalankan=mysqli_fetch_array($hpsgbr);
                //unlink gambar
                unlink("../assets/produk/$jalankan[gambar_produk]"); 
                move_uploaded_file($file_tmp, '../assets/produk/'.$nama_gambar_baru); //memindah file gambar ke folder gambar
                  // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
                  $query = "UPDATE produk SET nama_produk='$nama_produk' , kategori='$kategori' , deskripsi='$deskripsi' , harga_sewa='$harga_sewa' , gambar_produk='$nama_gambar_baru' WHERE id='$id'";
                  $result = mysqli_query($koneksi, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {
                    //tampil alert dan akan redirect ke halaman menu_produk.php
                    //silahkan ganti menu_produk.php sesuai halaman yang akan dituju
                    echo "<script>alert('Data berhasil diubah.');window.location='menu_produk.php';</script>";
                  }

            } else {     
             //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_produk.php';</script>";
            }
} else {
   $query = "UPDATE produk SET nama_produk='$nama_produk' , kategori='$kategori' , deskripsi='$deskripsi' , harga_sewa='$harga_sewa' WHERE id='$id'";
                  $result = mysqli_query($koneksi, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {
                    //tampil alert dan akan redirect ke halaman menu_produk.php
                    //silahkan ganti menu_produk.php sesuai halaman yang akan dituju
                    echo "<script>alert('Data berhasil ubah.');window.location='menu_produk.php';</script>";
                  }
}

}

#Hapus
if ($_GET['act'] == 'hapus'){
  $id = $_GET['id'];

  $sql2="SELECT * FROM produk where id='$id'";
  //query data
  $hpsgbr=mysqli_query($koneksi,$sql2);
  //fetch data
  $jalankan=mysqli_fetch_array($hpsgbr);
  //unlink gambar
  unlink("../assets/produk/$jalankan[gambar_produk]"); 

  //query hapus
  $querydelete = mysqli_query($koneksi, "DELETE FROM produk WHERE id = '$id'");

  if ($querydelete) {
      # redirect ke index.php
      echo "<script>alert('Data berhasil dihapu.');window.location='menu_produk.php';</script>";
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
            <strong>Data Produk</strong>
          </h2>
        </div>
        <div class="card-body">
    <center><button type="button" class="btn btn-primary btn-sm" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#tambah">+ &nbsp; Tambah Produk</i></button><center>
      
    <br/>
    <div class="datatable">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th class="th-sm">No</th>
        <th class="th-sm">Produk</th>
        <th class="th-sm">Dekripsi</th>
        <th class="th-sm">Harga Sewa</th>
        <th class="th-sm">Gambar</th>
        <th class="th-sm">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // jalankan query untuk menampilkan semua data diurutkan 
      $query = "SELECT * FROM produk ORDER BY id DESC";
      $result = mysqli_query($koneksi, $query);
      //mengecek apakah ada error ketika menjalankan query
      if(!$result){
        die ("Query Error: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
      }


      $no = 1; //variabel untuk membuat nomor urut
      while($row = mysqli_fetch_assoc($result))
      {
      ?>
       <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $row['nama_produk']; ?></td>
          <td><?php echo substr($row['deskripsi'], 0, 20); ?>...</td>
          <td>Rp <?php echo number_format($row['harga_sewa'],0,',','.'); ?></td>
          <td style="text-align: center;"><img src="../assets/produk/<?php echo $row['gambar_produk']; ?>" style="height: 80px;"></td>
          <td>
              <button type="button" class="btn btn-success btn-sm" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#edit<?php echo $row['id']; ?>"><i class="fa-regular fa-pen-to-square"></i>
              <a href="?act=hapus&id=<?php echo $row['id']; ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')"><button type="button" class="btn btn-danger btn-sm" data-mdb-ripple-init><i class="fa-solid fa-trash"></i></button></a>
          </td>
      </tr>
<!--Modal Edit Produk-->
                  <div class="modal fade" id="edit<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
                                <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                              <form action="" method="POST" enctype="multipart/form-data" >
                              <section class="base">
                                  <input type="text" name="id" value="<?php echo $row['id']; ?>" hidden>
                                  <div class="form-outline mb-4">
                                    <input type="text" name="nama_produk" class="form-control" value="<?php echo $row['nama_produk']; ?>"/>
                                    <label class="form-label" >Nama Produk</label>
                                  </div>
                                  <div class="form-outline mb-4">
                                  <select class="form-control" name="kategori" >
                                    <option value="<?php echo $row['kategori']; ?>"><?php echo $row['kategori']; ?></option>
                                        <?php 	$kat = mysqli_query($koneksi,"select * from kategori");
                                                while($k = mysqli_fetch_array($kat)){?>
                                    <option value="<?php echo $k['kategori']; ?>"><?php echo $k['kategori']; ?></option>
                                        <?php } ?>
                                  </select>
                                  </div>
                                  <div class="form-outline mb-4">
                                    <input type="text" name="deskripsi" class="form-control" value="<?php echo $row['deskripsi']; ?>"/>
                                    <label class="form-label" >Deskripsi</label>
                                  </div>
                                  <div class="form-outline mb-4">
                                    <input type="text" name="harga_sewa" class="form-control" value="<?php echo $row['harga_sewa']; ?>"/>
                                    <label class="form-label" >Harga Sewa</label>
                                  </div>
                                  <div class="form-outline mb-4">
                                    <label class="form-label" >Gambar Produk</label>
                                    <img src="../assets/produk/<?php echo $row['gambar_produk']; ?>" style="height: 80px;">
                                    <input type="file" name="gambar_produk" class="form-control" />
                                  </div>
                                </section>
                              
                                <div class="modal-footer">
                                  <button type="button" class="btn sm btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">
                                    Close
                                  </button>
                                  <button type="submit" name="edit" class="btn sm btn-success">Edit Produk</button>
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
<!--Modal Tambah Produk-->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                                <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                              <form action="" method="POST" enctype="multipart/form-data" >
                                <section class="base">
                                  <input type="text" name="pemilik" value="<?php echo $_SESSION['username']?>"hidden>
                                  <div class="form-outline mb-4">
                                    <input type="text" name="nama_produk" class="form-control" />
                                    <label class="form-label" >Nama Produk</label>
                                  </div>
                                  <div class="form-outline mb-4">
                                  <select class="form-control" name="kategori" >
                                    <option value="">Pilih Kategori</option>
                                        <?php 	$kat = mysqli_query($koneksi,"select * from kategori");
                                                while($k = mysqli_fetch_array($kat)){?>
                                    <option value="<?php echo $k['kategori']; ?>"><?php echo $k['kategori']; ?></option>
                                        <?php } ?>
                                  </select>
                                  </div>
                                  <div class="form-outline mb-4">
                                    <input type="text" name="deskripsi" class="form-control" />
                                    <label class="form-label" >Deskripsi</label>
                                  </div>
                                  <div class="form-outline mb-4">
                                    <input type="text" name="harga_sewa" class="form-control" />
                                    <label class="form-label" >Harga Sewa</label>
                                  </div>
                                  <div class="form-outline mb-4">
                                    <label class="form-label" >Gambar Produk</label>
                                    <input type="file" name="gambar_produk" class="form-control" />
                                  </div>
                                </section>
                              
                                <div class="modal-footer">
                                  <button type="button" class="btn sm btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">
                                    Close
                                  </button>
                                  <button type="submit" name="tambah" class="btn sm btn-success">Simpan Produk</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>


<?php  include('inc/footer.php');?>