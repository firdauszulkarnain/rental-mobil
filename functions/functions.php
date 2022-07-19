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
