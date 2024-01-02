<?php include 'inc/header.php' ?>
<div class="mb-8"></div>
<main class="mt-4 mb-5">
    <div class="container">
          <!--Section: Post data-mdb-->
          <section class="border-bottom mb-4">
            <center><h2>Tentang <?php echo $web['namaweb'];?></h2></center>
            <center><h4><?php echo $web['deskripsi'];?></h4></center>
          </section>
          <section class="border-bottom mb-4">
              <?php echo $web['tentang'];?>
          </section>
     <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class="col-md-6 mb-4">
            <?php echo $web['map'];?>
        </div>
        <!--Grid column-->
        <div class="col-md-6 mb-4">
            <h2 id="0" class="contact__title">Sewaon</h2> 
            <ul class="listing--icon">
                <li><i class="lnr lnr-map-marker"></i><?php echo $web['alamat'];?></li> 
                <li><i class="lnr lnr-earth"></i><?php echo $web['ig'];?></li> 
                <li><i class="lnr lnr-phone-handset"></i><?php echo $web['telpon'];?></li> 
                <li><i class="lnr lnr-clock"></i><?php echo $web['buka'];?></li>
            </ul>
        </div>
        </div>
      </div>
          
</main>
<?php include 'inc/footer.php' ?>