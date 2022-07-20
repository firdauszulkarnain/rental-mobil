<?php
// hubungkan dengan file functions 
require 'functions/functions.php';

// ambil data dan urutkan secara descending
$mobil = mysqli_query($db, "SELECT * FROM mobil ORDER BY id_mobil DESC");
?>

<?php require "_template/_header.php" ?>

<div class="content-wrapper">
    <!-- TAMBAHAN -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero__item set-bg" data-setbg="assets/img/banner.jpg">
                        <div class="hero__text text-light">
                            <h2 class="text-light">RENTAL MOBIL</h2>
                            <p class="text-light">Cepat, Murah, Terpercaya!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="featured spad">
        <div class="container mb-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>KATALOG</h2>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                <?php foreach ($mobil as $item) : ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="assets/img/mobil.png">
                                <ul class="featured__item__pic__hover">
                                    <li>
                                        <a href="konfirmasi_peminjaman.php?id=<?= $item["id_mobil"]; ?>">
                                            <i class="fas fa-shopping-bag"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6 class="text-capitalize"><a href="#"><?= $item['nama_mobil'] ?></a></h6>
                                <h5>Rp. <?= number_format($item['harga'], 0, ',', '.') ?>/Day</h5>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- ENDTAMABAHN -->
</div>

<?php require "_template/_footer.php"; ?>