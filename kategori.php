<?php include 'inc/header.php' ?>
<div class="mb-8"></div>

    <!--Main layout-->
    <main class="my-5">
      <div class="container">
          <center><h1>Kategori</h1></center>
        <!--Section: Products-->
        <section class="text-center">
          <div class="row">
                    <?php
                        $page = (isset($_GET['page']))? $_GET['page'] : 1;
                        $limit = 8; 
                        $limit_start = ($page - 1) * $limit;
                        $no = $limit_start + 1;

                        $query = "SELECT * FROM kategori ORDER BY id_kat DESC LIMIT $limit_start, $limit";
                        $dewan1 = $koneksi->prepare($query);
                        $dewan1->execute();
                        $res1 = $dewan1->get_result();
                        while ($p = $res1->fetch_assoc()) {
                    ?>
					            <div class="col-lg-3 col-md-12 mb-4">
                        <div class="card justify-content-center">
                            <div class="card-body">
                            <h5 class="card-title mb-3"><?php echo $p['kategori']; ?></h5>
                            <a href="produk.php?kat=<?php echo $p['kategori']; ?>"><button type="button" class="btn btn-primary">Lihat Produk</i></button></a>
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
  $query_jumlah = "SELECT count(*) AS jumlah FROM kategori";
  $dewan1 = $koneksi->prepare($query_jumlah);
  $dewan1->execute();
  $res1 = $dewan1->get_result();
  $row = $res1->fetch_assoc();
  $total_records = $row['jumlah'];
?>
<p>Total kategori : <?php echo $total_records; ?></p>
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