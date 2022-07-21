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

$id = $_SESSION["user"];
$sewa = mysqli_query($db, "SELECT * FROM sewa sw JOIN mobil mb ON sw.mobil_id = mb.id_mobil JOIN user us ON sw.user_id = us.id_user WHERE id_user = $id");
$row = mysqli_fetch_assoc($sewa);
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
                                <h2>PEMINJAMAN MOBIL</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shoping-cart spad mt-n4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
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
                                        <th>Status</th>
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
                                                <?php if ($row['status_pinjam'] == 'menunggu') : ?>
                                                    <span class="badge badge-danger">MENUNGGU</span>
                                                <?php elseif ($row['status_pinjam'] == 'proses') : ?>
                                                    <span class="badge badge-warning text-dark">PROSES</span>
                                                <?php elseif ($row['status_pinjam'] == 'pinjam') : ?>
                                                    <span class="badge badge-primary">DIPINJAM</span>
                                                <?php else : ?>
                                                    <span class="badge badge-success">SELESAI</span>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require "_template/_footer.php"; ?>