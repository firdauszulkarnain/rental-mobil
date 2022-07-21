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
$row = mysqli_query($db, "SELECT * FROM mobil WHERE id_mobil = $id");
$row = mysqli_fetch_assoc($row);

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
                    <h1 class="h3 mb-4 text-gray-800">Edit Data Mobil</h1>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-9">
                    <div class="card mb-5 px-5 py-4">
                        <div class="card-body">
                            <form action="" method="POST">
                                <input type="hidden" name="id" value="<?= $row['id_mobil']; ?>">
                                <div class="form-group">
                                    <label for="nama_mobil">Nama Mobil</label>
                                    <input type="text" class="form-control" id="nama_mobil" name="nama_mobil" autocomplete="off" value="<?= $row['nama_mobil'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="merek_mobil">Merek Mobil</label>
                                    <input type="text" class="form-control" id="merek_mobil" name="merek_mobil" value="<?= $row['merek_mobil'] ?>" autocomplete="off" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="harga">Harga Mobil</label>
                                        <input type="text" class="form-control" id="harga" name="harga" autocomplete="off" value="<?= $row['harga'] ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="jumlah">Jumlah Mobil</label>
                                        <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $row['jumlah'] ?>" autocomplete="off" required>
                                    </div>
                                </div>
                                <button class="btn btn-primary float-right mt-3" type="submit" name="ubah">Simpan Data Mobil</button>
                            </form>
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

    if (isset($_POST['ubah'])) {

        if (ubah($_POST) > 0) {
            echo    "<script>
                Swal.fire('SUCCESS','Berhasil Ubah Data','success').then(function() {
                window.location = 'mobil.php';
                });;
                </script>";
        } else {
            // digunakan untuk menampilkan informasi error database
            echo mysqli_error($db);
        }
    }


    ?>