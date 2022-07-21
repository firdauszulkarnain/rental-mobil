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

// ambil data dan urutkan secara descending
$query = "SELECT * FROM laporan lp JOIN sewa sw ON lp.sewa_id = sw.id_sewa JOIN mobil mb ON sw.mobil_id = mb.id_mobil ORDER BY id_laporan DESC";
$laporan = mysqli_query($db, $query);
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
                    <h1 class="h3 mb-4 text-gray-800">Laporan Rental Mobil</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-5">
                        <div class="card-body">
                            <table class="table table-striped table-bordered dt-responsive nowrap" id="mytabel" width="100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama Mobil</th>
                                        <th>Unit Pinjam</th>
                                        <th>Subtotal</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($laporan as $row) : ?>
                                        <tr class="text-center">
                                            <td></td>
                                            <th><?= $row["nama_mobil"]; ?></th>
                                            <th><?= $row['jumlah_sewa'] ?> Unit</th>
                                            <td>Rp. <?= number_format($row['subtotal'], 0, ',', '.') ?></td>
                                            <td><?= $row['waktu_pinjam']; ?></td>
                                            <td><?= $row['tanggal_selesai']; ?></td>
                                            <td></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->



    <?php include('_footer.php') ?>