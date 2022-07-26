<?php
// hubungkan dengan file koneksi sama validasi
require "koneksidb.php";


function tambah($data)
{
    // ambil variabel yang menghubungkan database
    global $db;

    // simpan data yang diinputkan user
    $nama_mobil = htmlspecialchars($data['nama_mobil']);
    $merek_mobil = htmlspecialchars($data['merek_mobil']);
    $harga = htmlspecialchars($data['harga']);
    $jumlah = htmlspecialchars($data['jumlah']);

    // query insert
    $query = "INSERT INTO mobil VALUES ('','$nama_mobil','$merek_mobil',$harga, $jumlah)";
    mysqli_query($db, $query);

    // kembalikan berapa jumlah baris yang berubah
    return mysqli_affected_rows($db);
}

function hapus($id)
{
    global $db;

    // query delete
    $query = "DELETE FROM mobil WHERE id_mobil  = $id";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function ubah($data)
{
    global $db;
    $id = $data['id'];
    $nama_mobil = htmlspecialchars($data['nama_mobil']);
    $merek_mobil = htmlspecialchars($data['merek_mobil']);
    $harga = htmlspecialchars($data['harga']);
    $jumlah = htmlspecialchars($data['jumlah']);

    // query update
    $query = "UPDATE mobil SET nama_mobil = '$nama_mobil',merek_mobil = '$merek_mobil', harga = $harga, jumlah = $jumlah WHERE id_mobil = $id ";
    mysqli_query($db, $query);
    // jika tidak terjadi perubahan data, data tetap disimpan
    if (mysqli_affected_rows($db) == 0) {
        echo    "<script>
                Swal.fire('Berhasil Simpan Data','Tidak Terjadi Perubahan Data','success').then(function() {
                window.location = 'index.php';
                });
                </script>";
    } else {
        return mysqli_affected_rows($db);
    }
}

function sewa($data)
{
    // ambil variabel yang menghubungkan database
    global $db;

    // simpan data yang diinputkan user
    $mobil_id = htmlspecialchars($data['mobil_id']);
    $nama_peminjam = htmlspecialchars($data['nama_peminjam']);
    $no_hp = htmlspecialchars($data['no_hp']);
    $jumlah_sewa = (int) $data['unit'];
    $harga = (int) $data['harga'];
    $lama_pinjam = (int) $data['lama_pinjam'];
    $subtotal = ($harga * $jumlah_sewa) * $lama_pinjam;
    $waktu_pinjam = date("Y-m-d", strtotime($data['waktu_pinjam']));
    $status = 'menunggu';
    $user_id = htmlspecialchars($data['user_id']);

    // query insert
    $query = "INSERT INTO sewa VALUES ('','$mobil_id','$nama_peminjam','$no_hp', $jumlah_sewa, $subtotal, $lama_pinjam, '$waktu_pinjam', '$status', '$user_id')";
    mysqli_query($db, $query);

    // kembalikan berapa jumlah baris yang berubah
    return mysqli_affected_rows($db);
    // return 1;
}

function update_status($data)
{
    global $db;
    $id_sewa = htmlspecialchars($data['id_sewa']);
    $status = $data['pinjam'];

    // query update
    $query = "UPDATE sewa SET status_pinjam = '$status' WHERE id_sewa = $id_sewa";
    mysqli_query($db, $query);

    if ($status == 'selesai') {
        $date = date('Y-m-d');
        $insert = "INSERT INTO laporan VALUES ('','$id_sewa','$date')";
        mysqli_query($db, $insert);
    }

    if (mysqli_affected_rows($db) == 0) {
        echo    "<script>
                 Swal.fire('SUCCESS','Berhasil Update Status Peminjaman Mobil','success').then(function() {
                window.location = 'rental.php';
                });
                </script>";
    } else {
        return mysqli_affected_rows($db);
    }
}

function registrasi($data)
{
    global $db;
    $nama_lengkap = htmlspecialchars($data['nama_lengkap']);
    $notelp = htmlspecialchars($data['notelp']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password1']);
    $password2 = htmlspecialchars($data['password2']);


    //Cek Username apakah di database ada atau tidak
    $result = mysqli_query($db,  "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        Swal.fire('Erorr','Username Telah Digunakan','error');
        </script>";
        return false;
    }

    //Cek Konfirmasi Password sama atau tidak
    if ($password !== $password2) {
        echo "<script>
        Swal.fire('Erorr','Konfimarsi Password Salah','warning');
        </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    //Tambah User Ke Database
    $query = "INSERT INTO user VALUES('','$nama_lengkap', '$notelp','$username','$password')";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
