<?php 
    session_start();

    include("koneksi.php");

    //jika tidak ada session pelangga
    if (!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])) {
        echo "<script>alert('silahkan login dulu');</script>";
        echo "<script>location='login.php';</script>";
        exit();
    }

    //mendapatkan id pembayaran dari url
    $id_pembelian = $_GET['id'];
    $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$id_pembelian'");
    $data = $ambil->fetch_assoc();

    //mendapatkan id_pelanggan yg sudah beli
    $id_pelangganBeli = $data['id_pelanggan'];

    //mendapatkan id yang login
    $id_ygLogin = $_SESSION['pelanggan']['id_pelanggan'];

    if ($id_ygLogin !== $id_pelangganBeli) {
        echo "<script>alert('kamu tidak bisa akses');</script>";
        echo "<script>location='riwayat.php';</script>";
    }else{

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pebayaran</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
    <?php include("menu.php"); ?>

    <div class="container">
        <h2>Konfirmasi pembayaran</h2>
        <p>Kirim bukti pembayaran anda disini</p>
        <div class="alert alert-info">Total Tagihan Anda <strong>Rp. <?= number_format($data['total_pembelian']); ?></strong></div>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Nama Pembayar</label>
                <input type="text" class="form-control" name="nama">
            </div>
            <div class="form-group">
                <label for="">Bank</label>
                <input type="text" class="form-control" name="bank">
            </div>
            <div class="form-group">
                <label for="">Jumlah</label>
                <input type="number" class="form-control" name="jumlah" min="1">
            </div>
            <div class="form-group">
                <label for="">Foto Bukti</label>
                <input type="file" class="form-control" name="bukti">
                <p class="text-danger">Foto bukti harus JPG max 2MB</p>
            </div>
            <button class="btn btn-primary" name="kirim">Kirim</button>
        </form>
    </div>

    <?php 
        //jika ada tombol kirim ditekan
        if (isset($_POST['kirim'])) {
            
            //upload file
            $namaBukti = $_FILES["bukti"]["name"];
            $lokasiBukti = $_FILES["bukti"]["tmp_name"];
            $namaFix = date("YmdHis").$namaBukti;
            move_uploaded_file($lokasiBukti,"bukti-pembayaran/$namaFix");
            
            $nama = $_POST['nama'];
            $bank = $_POST['bank'];
            $jumlah = $_POST['jumlah'];
            $tanggal = date("Y-m-d");

            //simpn pembayaran
            $koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti)
            VALUES ('$id_pembelian','$nama','$bank','$jumlah','$tanggal','$namaFix')");
        
            //update data pembelian dari pending jadi sudah kirim pembayaran
            $koneksi->query("UPDATE pembelian SET status_pembelian='sudah kirim pembayaran' WHERE id_pembelian='$id_pembelian'");

            echo "<script>alert('terimakasih sudah mengirim pembayaran');</script>";
        echo "<script>location='riwayat.php';</script>";
    }
    ?>
</body>
</html>