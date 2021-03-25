<?php 
    session_start();

    include("koneksi.php");

    $id_pembelian = $_GET['id'];

    $ambil = $koneksi->query("SELECT * FROM pembayaran 
     LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian 
    WHERE pembelian.id_pembelian='$id_pembelian'");
    $data = $ambil->fetch_assoc();

    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";

    if (empty($data)) {
        echo "<script>alert('belum ada data pembayaran');</script>";
        echo "<script>location='riwayat.php'</script>";
        exit();
    }

    if ($_SESSION['pelanggan']['id_pelanggan'] !== $data['id_pelanggan']) {
        echo "<script>alert('tidak bisa di akses');</script>";
        echo "<script>location='riwayat.php'</script>";
        exit();
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
    <?php include 'menu.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <td><?= $data['nama']; ?></td>
                    </tr>
                    <tr>
                        <th>Bank</th>
                        <td><?= $data['bank']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td><?= $data['tanggal']; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>Rp.  <?= number_format($data['jumlah']); ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <img src="bukti-pembayaran/<?= $data['bukti'];?> " alt="" class="img-responsive">
            </div>
        </div>
    </div>
</body>
</html>