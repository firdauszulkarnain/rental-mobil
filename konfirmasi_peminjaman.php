<?php
// Mulai Session
session_start();

// Cek session apakah sudah login
if (!isset($_SESSION["user"])) {
    // kalo belum, login dulu
    $url = 'login.php';
    header("Location: $url");
    exit;
}

require 'functions/functions.php';

if (isset($_SESSION["user"])) {
    $id_user = $_SESSION['user'];
    $result = mysqli_query($db, "SELECT * FROM user WHERE id_user = $id_user");
    $user = mysqli_fetch_assoc($result);
}

$id = $_GET['id'];
$query = "SELECT * FROM mobil WHERE id_mobil = $id";
$row = mysqli_query($db, $query);
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
                            <div class="card-body primary-btn py-4" style="background-color: black;">
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
                            <input type="hidden" name="harga" id="harga" value="<?= $row['harga'] ?>">
                            <input type="hidden" name="user_id" value="<?= $_SESSION["user"] ?>">
                            <div class="form-group">
                                <label for="nama_peminjam">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" autocomplete="off" value="<?= $user['nama_lengkap'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="no_hp">Nomor Telepon</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp" autocomplete="off" value="<?= $user['notelp'] ?>" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="unit">Jumlah Pinjam</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control number" id="unit" name="unit" autocomplete="off" value="1" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">Unit</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for="lama_pinjam">Lama Pinjam</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control number" id="lama_pinjam" name="lama_pinjam" autocomplete="off" required value="1">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">Hari</span>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-lg-5">
                                    <div class="form-group">
                                        <label for="waktu_pinjam">Tanggal Pinjam</label>
                                        <input type="date" class="form-control" id="waktu_pinjam" name="waktu_pinjam" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="checkout__order mt-3">
                                <h4>Detail Order</h4>
                                <div class="checkout__order__products">Detail Mobil <span>Harga</span></div>
                                <ul>
                                    <li class="text-capitalize"><?= $row['nama_mobil'] ?> <span> Rp. <?= number_format($row['harga'], 0, ',', '.') ?>/Unit-Hari</span></li>
                                </ul>
                                <div class="checkout__order__total">Total <span id="total"> Rp. <?= number_format($row['harga'], 0, ',', '.') ?></span></div>
                                <button type="submit" class="site-btn tombol-bayar" name="sewa" style="background-color: black;">Proses Sewa Mobil</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>
</div>

<?php require "_template/_footer.php"; ?>


<script>
    $(document).ready(function() {
        $('#lama_pinjam').on('input', function(e) {
            var durasi = $(this).val();
            var unit = $('#unit').val()
            var harga = $('#harga').val();
            if (durasi != '') {
                durasi = parseInt(durasi);
                unit = parseInt(unit)
                var total = unit * durasi * parseInt(harga);

                var totalBayar = parseInt(total);
                var number_string = totalBayar.toString(),
                    sisa = number_string.length % 3,
                    rupiah = number_string.substr(0, sisa),
                    ribuan = number_string.substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                $("#total").html("Rp. " + rupiah);
            }

        });

        $('#unit').on('input', function(e) {
            var unit = $(this).val();
            var durasi = $('#lama_pinjam').val()
            var harga = $('#harga').val();
            if (unit != '') {
                unit = parseInt(unit);
                durasi = parseInt(durasi)
                var total = unit * durasi * parseInt(harga);
                var totalBayar = parseInt(total);

                var number_string = totalBayar.toString(),
                    sisa = number_string.length % 3,
                    rupiah = number_string.substr(0, sisa),
                    ribuan = number_string.substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                $("#total").html("Rp. " + rupiah);
            }
        });
    });
</script>

<?php


if (isset($_POST['sewa'])) {

    if (sewa($_POST) > 0) {

        echo    "<script>
            Swal.fire('SUCCESS','Berhasil Sewa Mobil','success').then(function() {
                window.location = 'index.php';
            });;
        </script>";
    } else {

        echo mysqli_error($db);
    }
}
?>