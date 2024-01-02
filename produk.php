<?php include 'inc/header.php' ?>
<div class="mb-8"></div>
        <?php
       if (isset($_GET['kat'])) {

        $kat = ($_GET["kat"]);
        $query = "SELECT * FROM produk WHERE kategori='$kat' ORDER BY id ASC";
        $result = mysqli_query($koneksi, $query);
        //mengecek apakah ada error ketika menjalankan query
        if(!$result){
            die ("Query Error: ".mysqli_errno($koneksi).
            " - ".mysqli_error($koneksi));
        }
    } else {
        $kat = "";
        $query = "SELECT * FROM produk ORDER BY id ASC";
        $result = mysqli_query($koneksi, $query);
        //mengecek apakah ada error ketika menjalankan query
        if(!$result){
            die ("Query Error: ".mysqli_errno($koneksi).
            " - ".mysqli_error($koneksi));
        }
      } 
      echo "    <center><h1>Produk $kat</h1><center>"
      ?>


    <!--Main layout-->
    <main class="my-5">
      <div class="container">
        <!-- Additional navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-5 mb-5">
          <!-- Container wrapper -->
          <div class="container-fluid">
            <!-- Navbar brand -->
            <strong class="text-dark mr-2">
              Kategori :
            </strong>

            <!-- Toggle button -->
            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <!-- Left links -->
              <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link text-dark active" aria-current="page" href="produk.php">Semua</a>
                </li>
                <?php 				
				$kat = mysqli_query($koneksi,"select * from kategori");
				while($k = mysqli_fetch_array($kat)){
					?>
					<li class="nav-item">
                  <a class="nav-link text-dark" href="produk.php?kat=<?php echo $k['kategori']; ?>"><?php echo $k['kategori']; ?></a>
                </li>
					<?php
				}
				?>
              </ul>
              <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->
          </div>
          <!-- Container wrapper -->
        </nav>
        <!-- Additional navigation -->

        <!--Section: Products-->
        <section class="text-center">
          <div class="row">
                    <?php
                      if (isset($_GET['kat'])) {

                        $kat = ($_GET["kat"]);
                        $page = (isset($_GET['page']))? $_GET['page'] : 1;
                        $limit = 8; 
                        $limit_start = ($page - 1) * $limit;
                        $no = $limit_start + 1;

                        $query = "SELECT * FROM produk WHERE kategori='$kat' ORDER BY id  ASC LIMIT $limit_start, $limit";
                        $dewan1 = $koneksi->prepare($query);
                        $dewan1->execute();
                        $res1 = $dewan1->get_result();
                      }else{
                        $page = (isset($_GET['page']))? $_GET['page'] : 1;
                        $limit = 8; 
                        $limit_start = ($page - 1) * $limit;
                        $no = $limit_start + 1;

                        $query = "SELECT * FROM produk ORDER BY id  ASC LIMIT $limit_start, $limit";
                        $dewan1 = $koneksi->prepare($query);
                        $dewan1->execute();
                        $res1 = $dewan1->get_result();
                      }
                        while ($p = $res1->fetch_assoc()) {
                    ?>
					            <div class="col-lg-3 col-md-12 mb-4">
                        <div class="card justify-content-center">
                            <img
                            src="assets/produk/<?php echo $p['gambar_produk']; ?>"
                            style="height: 230px;width: 300px;object-fit: contain;object-position: center;"
                            class="card-img-top justify-content-center"
                            alt="..."
                            />
                            <div class="card-body">
                            <h5 class="card-title mb-3"><?php echo $no++; ?>. <?php echo $p['nama_produk']; ?></h5>
                            <h6 class="mb-3">Rp <?php echo number_format($p['harga_sewa'],0,',','.'); ?></h6>
                            <p class="card-text"><?php echo substr($p['deskripsi'], 0, 20); ?>...
                            </p>
                            <a href="detail.php?id=<?php echo $p['id']; ?>"><button type="button" class="btn btn-primary">Detail</i></button></a>
                            </div>
                        </div>
                    </div>
					<?php
				}
				?>
            </div>
        </section>
        <!--Section: Products-->

         <!-- Pagination -->
         <?php
          if (isset($_GET['kat'])) {
          $query_jumlah = "SELECT count(*) AS jumlah FROM produk WHERE kategori='$kat' ";
          $dewan1 = $koneksi->prepare($query_jumlah);
          $dewan1->execute();
          $res1 = $dewan1->get_result();
          $row = $res1->fetch_assoc();
          $total_records = $row['jumlah'];}
          else{
          $query_jumlah = "SELECT count(*) AS jumlah FROM produk";
          $dewan1 = $koneksi->prepare($query_jumlah);
          $dewan1->execute();
          $res1 = $dewan1->get_result();
          $row = $res1->fetch_assoc();
          $total_records = $row['jumlah'];
          }
          
        ?>
<p>Total produk : <?php echo $total_records; ?></p>
<nav class="mb-5">
  <ul class="pagination pagination-sm justify-content-center">
    <?php
      $jumlah_page = ceil($total_records / $limit);
      $jumlah_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
      $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
      $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page;
      
      if($page == 1){
        echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
        echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
      } else {
        $link_prev = ($page > 1)? $page - 1 : 1;
        echo '<li class="page-item"><a class="page-link" href="?page=1">First</a></li>';
        echo '<li class="page-item"><a class="page-link" href="?page='.$link_prev.'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
      }

      for($i = $start_number; $i <= $end_number; $i++){
        $link_active = ($page == $i)? ' active' : '';
        echo '<li class="page-item '.$link_active.'"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
      }

      if($page == $jumlah_page){
        echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
        echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
      } else {
        $link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
        echo '<li class="page-item"><a class="page-link" href="?page='.$link_next.'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
        echo '<li class="page-item"><a class="page-link" href="?page='.$jumlah_page.'">Last</a></li>';
      }
    ?>
  </ul>
</nav>
      </div>
    </main>
    <!--Main layout-->

    <?php include 'inc/footer.php' ?>