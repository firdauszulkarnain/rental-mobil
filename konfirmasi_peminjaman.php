<?php
// hubungkan dengan file functions 
require 'functions/functions.php';

$id = $_GET['id'];
$row = mysqli_query($db, "SELECT * FROM mobil WHERE id_mobil = $id");
$row = mysqli_fetch_assoc($row);
?>

<?php require "_template/_header.php" ?>

<div class="content-wrapper">
    <!-- TAMBAHAN -->
    <section class="breadcrumb-section set-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <div class="card">
                            <div class="card-body primary-btn py-4">
                                <h2>Konfirmasi Sewa Mobil</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <div class="row bayar-judul">
                    <div class="col-lg-9">
                        <h4>Konfirmasi Sewa Mobil</h4>
                    </div>
                </div>
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-lg-7 col-md-6">
                            <input type="hidden" name="mobil_id" value="<?= $row['id_mobil'] ?>">
                            <div class="checkout__input">
                                <p>Nama Lengkap<span>*</span></p>
                                <input type="text" id="nama_peminjam" name="nama_peminjam" autocomplete="off" required>
                            </div>
                            <div class="checkout__input">
                                <p>Nomor Handphone<span>*</span></p>
                                <input type="text" id="no_hp" name="no_hp" autocomplete="off" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Lama Pinjam<span>*</span></p>
                                        <input type="text" id="lama_pinjam" name="lama_pinjam" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class=" col-lg-6">
                                    <div class="checkout__input">
                                        <p>Waktu Pinjam<span>*</span></p>
                                        <input type="date" id="waktu_pinjam" name="waktu_pinjam" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="checkout__order mt-3">
                                <h4>Detail Order</h4>
                                <div class="checkout__order__products">Produk <span>Total</span></div>
                                <ul>
                                    <li class="text-capitalize"><?= $row['nama_mobil'] ?> <span> Rp. <?= number_format($row['harga'], 0, ',', '.') ?>/Day</span></li>
                                </ul>
                                <div class="checkout__order__total">Total <span id="total">Rp. <?= number_format($row['harga'], 0, ',', '.'); ?></span></div>
                                <button type="submit" class="site-btn tombol-bayar" name="sewa">Proses Sewa Mobil</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>
</div>

<?php require "_template/_footer.php"; ?>

<?php

// jika tombol dengan name tambah ditekan
if (isset($_POST['sewa'])) {
    // kirimkan data ke fungsi tambah dan cek apakah nilai yang dikembalikan lebih dari 1
    if (sewa($_POST) > 0) {
        // jika iya tampilkan alert
        echo    "<script>
            Swal.fire('SUCCESS','Berhasil Sewa Mobil','success').then(function() {
                window.location = 'index.php';
            });;
        </script>";
    } else {
        // digunakan untuk menampilkan informasi error database
        echo mysqli_error($db);
    }
}
?>