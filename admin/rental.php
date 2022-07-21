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
$sewa = mysqli_query($db, "SELECT * FROM sewa sw JOIN mobil mb ON sw.mobil_id = mb.id_mobil ORDER BY id_sewa DESC");
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
                    <h1 class="h3 mb-4 text-gray-800">Data Sewa Mobil</h1>
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
                                        <th>Mobil</th>
                                        <th>Unit Pinjam</th>
                                        <th>Subtotal</th>
                                        <th>Durasi</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($sewa as $row) : ?>
                                        <tr class="text-center">
                                            <td></td>
                                            <td><?= $row["nama_mobil"]; ?></td>
                                            <td><?= $row['jumlah_sewa'] ?> Unit</td>
                                            <td>Rp. <?= number_format($row['subtotal'], 0, ',', '.') ?> </td>
                                            <td><?= $row['lama_pinjam']; ?> Hari</td>
                                            <td><?= $row['waktu_pinjam']; ?></td>
                                            <td>
                                                <a href="#" data-id="<?= $row['id_sewa'] ?>" data-toggle="modal" data-target="#updateModal" class="btn btn-sm btn-primary text-light modal_update">Update Status</i></a>
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

    <!-- Update = Modal -->
    <div class="modal fade mt-5" id="updateModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Status Peminjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id_sewa" id="id_sewa" value="">
                        <div class="form-group">
                            <label for="status">Status Peminjaman</label>
                            <select class="form-control" id="status" name="pinjam">
                                <option value="" disabled selected>===PILIH STATUS====</option>
                                <option value="proses">Proses</option>
                                <option value="pinjam">Dipinjam</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-sm btn px-4 py-2" name="update">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include('_footer.php') ?>

    <script>
        $(document).on("click", ".modal_update", function() {
            var id = $(this).data('id');
            $(".modal-body #id_sewa").val(id);
        });
    </script>

    <?php
    if (isset($_POST['update'])) {
        if (update_status($_POST) > 0) {

            echo    "<script>
            Swal.fire('SUCCESS','Berhasil Update Status Peminjaman Mobil','success').then(function() {
                window.location = 'rental.php';
            });;
        </script>";
        } else {
            echo mysqli_error($db);
        }
    }

    if (isset($_GET["hapus"])) {
        // ambil id pelangan
        $id = $_GET["hapus"];
        // kirimkan data ke fungsi hapus dan cek apakah nilai yang dikembalikan lebih dari 1
        if (hapus($id) > 0) {
            echo "<script>
        Swal.fire('SUCCESS', 'Berhasil Hapus Data', 'success').then(function() {
            window.location = 'mobil.php';
        });;
    </script>";
        } else {
            // digunakan untuk menampilkan informasi error database
            echo mysqli_error($db);
        }
    }
    ?>