
<?php 
    session_start();

    include("koneksi.php");

    //jika tidak ada session pelangga
    if (!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])) {
        echo "<script>alert('silahkan login dulu');</script>";
        echo "<script>location='login.php';</script>";
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
    <?php include("menu.php"); ?>
   
    <section class="riwayat">
        <div class="container">
            <h3>Riwayat Belanja <?= $_SESSION['pelanggan']['nama_pelanggan']; ?></h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $nomor=1; ?>
                <?php 
                    //mendapatkan id pelanggan
                    $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];

                    $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
                    while($data = $ambil->fetch_assoc()){

                ?>
                    <tr>
                        <td><?= $nomor; ?></td>
                        <td><?= $data['tanggal_pembelian']; ?></td>
                        <td>
                            <?= $data['status_pembelian']; ?><br>
                            <?php if(!empty($data['resi'])) :?>
                                Resi : <?= $data['resi']; ?>
                            <?php endif; ?>
                        </td>
                        <td>Rp. <?= number_format($data['total_pembelian']); ?></td>
                        <td>
                            <a href="nota.php?id=<?= $data['id_pembelian'] ;?>" class="btn btn-info">Nota</a>
                        <?php if($data["status_pembelian"] == "pending") : ?>
                            <a href="pembayaran.php?id=<?= $data['id_pembelian']; ?>" class="btn btn-success">Input Pembayaran</a>
                        <?php else: ?>
                        <a href="lihat_pembayaran.php?id=<?= $data['id_pembelian']; ?>" class="btn btn-warning">Lihat Pembayaran</a>
                        <?php endif; ?>
                        
                        </td>
                    </tr>
                    <?php $nomor++; ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>