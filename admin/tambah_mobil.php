<?php

// hubungkan dengan file functions 
require '../functions/functions.php';


?>

<?php include('_header.php') ?>
<?php include('_sidebar.php') ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                </li>


                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                        <img class="img-profile rounded-circle" src="../assets/img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-6">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Tambah Data Mobil</h1>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-9">
                    <div class="card mb-5 px-5 py-4">
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="nama_mobil">Nama Mobil</label>
                                    <input type="text" class="form-control" id="nama_mobil" name="nama_mobil" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label for="merek_mobil">Merek Mobil</label>
                                    <input type="text" class="form-control" id="merek_mobil" name="merek_mobil" autocomplete="off" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="harga">Harga Mobil</label>
                                        <input type="text" class="form-control" id="harga" name="harga" autocomplete="off" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="jumlah">Jumlah Mobil</label>
                                        <input type="number" class="form-control" id="jumlah" name="jumlah" autocomplete="off" required>
                                    </div>
                                </div>
                                <button class="btn btn-primary float-right mt-3" type="submit" name="tambah">Simpan Data Mobil</button>
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

    // jika tombol dengan name tambah ditekan
    if (isset($_POST['tambah'])) {
        // kirimkan data ke fungsi tambah dan cek apakah nilai yang dikembalikan lebih dari 1
        if (tambah($_POST) > 0) {
            // jika iya tampilkan alert
            echo    "<script>
                Swal.fire('SUCCESS','Berhasil Tambah Data','success').then(function() {
                    window.location = 'mobil.php';
                });;
            </script>";
        } else {
            // digunakan untuk menampilkan informasi error database
            echo mysqli_error($db);
        }
    }
    ?>