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
$mobil = mysqli_query($db, "SELECT * FROM mobil ORDER BY id_mobil DESC");
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
                    <h1 class="h3 mb-4 text-gray-800">Data Mobil</h1>
                </div>
                <div class="col-lg-6">
                    <a href="tambah_mobil.php" class="btn btn-primary float-right">Tambah Data Mobil</a>
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
                                        <th>Merek Mobil</th>
                                        <th>Harga Mobil</th>
                                        <th>Jumlah Mobil</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($mobil as $row) : ?>
                                        <tr class="text-center">
                                            <td></td>
                                            <td><?= $row["nama_mobil"]; ?></td>
                                            <td><?= $row['merek_mobil']; ?></td>
                                            <td>Rp. <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                            <td><?= $row['jumlah']; ?> Unit</td>
                                            <td>
                                                <a href="edit_mobil.php?id=<?= $row["id_mobil"]; ?>" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-edit"></i></a>
                                                <a href="mobil.php?hapus=<?= $row["id_mobil"]; ?>" class="btn btn-danger btn-sm" onclick=" return confirm ('Yakin Hapus Data?');"><i class="fas fa-fw fa-trash"></i></a>
                                            </td>
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


    <?php

    if (isset($_GET["hapus"])) {
        // ambil id pelangan
        $id = $_GET["hapus"];
        // kirimkan data ke fungsi hapus dan cek apakah nilai yang dikembalikan lebih dari 1
        if (hapus($id) > 0) {
            echo    "<script>
                Swal.fire('SUCCESS','Berhasil Hapus Data','success').then(function() {
                    window.location = 'mobil.php';
                });;
            </script>";
        } else {
            // digunakan untuk menampilkan informasi error database
            echo mysqli_error($db);
        }
    }
    ?>