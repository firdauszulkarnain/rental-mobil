<?php

// Mulai Session
session_start();

// Cek session apakah sudah login
if (!isset($_SESSION["admin"])) {
    // kalo belum, login dulu
    $url = 'login.php';
    header("Location: $url");
    exit;
}


// hubungkan dengan file functions 
require '../functions/functions.php';
$id = $_GET['id'];

$sewa = mysqli_query($db, "SELECT * FROM sewa sw JOIN mobil mb ON sw.mobil_id = mb.id_mobil JOIN user us ON sw.user_id = us.id_user WHERE id_sewa = $id");
$sewa = mysqli_fetch_assoc($sewa);
?>
<?php include('_header.php') ?>

<?php include('_sidebar.php') ?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php include('_topbar.php') ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-6">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Detail Sewa Mobil</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header bg-primary text-light font-weight-bolder">
                            INFORMASI PENYEWA
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama_peminjam">Nama Penyewa</label>
                                <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" autocomplete="off" value="<?= $sewa['nama_peminjam'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="notelp">Nomor Telepon</label>
                                <input type="text" class="form-control" id="notelp" name="notelp" autocomplete="off" value="<?= $sewa['no_hp'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header bg-primary text-light font-weight-bolder">
                            INFORMASI PINJAMAN
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="tanggal_pinjam" class="col-sm-4 col-form-label">Tanggal Pinjam</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="tanggal_pinjam" value="<?= $sewa['waktu_pinjam'] ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="unit">Unit</label>
                                            <input type="text" class="form-control" id="unit" value="<?= $sewa['jumlah_sewa'] ?> Unit" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="durasi">Durasi Pinjam</label>
                                            <input type="text" class="form-control" id="durasi" value="<?= $sewa['lama_pinjam'] ?> Hari" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mobil" class="col-sm-4 col-form-label">Nama Mobil</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mobil" value="<?= $sewa['nama_mobil'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="total" class="col-sm-4 col-form-label">TOTAL</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="total" value="Rp. <?= number_format($sewa['subtotal'], 0, ',', '.') ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->



    <?php include('_footer.php') ?>