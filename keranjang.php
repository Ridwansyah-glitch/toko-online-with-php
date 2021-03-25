<?php
    session_start();

    include("koneksi.php");


    if (empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])){
        echo "<script>alert('keranjang kosong,silahkan berbelanja');</script>";
        echo "<script>location='index.php';</script>";
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Wanshop</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
    <!-- navbar -->
    <?php include("menu.php"); ?>
    <section class="content">
        
    <div class="container">
        <h1>Keranjang Belanja</h1>
        <hr>

        <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Photo Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor=1; ?>
            <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) :?>
                <?php   
                    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
                    $data = $ambil->fetch_assoc(); 
                    $subharga = $data['harga_produk'] * $jumlah;
                ?>
                <tr>
                    <td><?= $nomor; ?></td>
                    <td><img src="foto_produk/<?= $data['foto_produk']; ?>" alt="" width="100px" ></td>
                    <td><?= $data['nama_produk']; ?></td>
                    <td>Rp. <?= number_format($data['harga_produk']); ?></td>
                    <td><?= $jumlah ?></td>
                    <td>Rp. <?= number_format($subharga); ?></td>
                    <td>
                        <a href="hapuskeranjang.php?id=<?=$id_produk; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin hapus')">hapus</a>
                    </td>
                </tr>
            <?php $nomor++; ?>
            <?php endforeach; ?>
        </tbody>
        </table>
        <a href="index.php" class="btn btn-default">Lanjutkan Belanja</a>
        <a href="checkout.php" class="btn btn-primary">Checkout</a>
    </div>
    </section>