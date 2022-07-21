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
?>
<?php include('_header.php'); ?>
<?php include('_sidebar.php'); ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php include('_topbar.php') ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Selamat Datang Admin</h1>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <?php include('_footer.php') ?>