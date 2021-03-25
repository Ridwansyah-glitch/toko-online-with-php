<?php
session_start();

include("koneksi.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Wanshop</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
</head>
<body>
    <!-- navbar -->
    <?php include("menu.php"); ?>

    <!-- content -->
    <section class="content">
        <div class="container">
            <h1>Produk Terbaru</h1>

            <div class="row">

                <?php $ambil = $koneksi->query("SELECT * FROM produk ");?>
                <?php while($data = $ambil->fetch_assoc()): ?>
                <div class="col-md-3">
                    <div class="thumbnail">
                        <img src="foto_produk/<?= $data['foto_produk']; ?>" alt="" width="300" >
                        <div class="caption">
                            <h3><?= $data['nama_produk']; ?></h3>
                            <h5><?= number_format($data['harga_produk']); ?></h5>
                            <a href="beli.php?id= <?= $data['id_produk']; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-shopping-cart"></i></a>
                            <a href="detail.php?id=<?= $data['id_produk'] ;?>" class="btn btn-default"><i class="fa fa-eye "></i></a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
</body>
</html>