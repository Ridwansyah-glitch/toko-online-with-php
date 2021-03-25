<?php 
    session_start();
    include("koneksi.php");

    $id_pembelian = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembelian</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
    
    <!-- navbar -->
<?php include("menu.php"); ?>

    <section class="content">
        <div class="container">
        <h1>Nota Pembelian</h1>

            <?php $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
            ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$id_pembelian'");

            $detail = $ambil->fetch_assoc();

           
            ?>

            <!-- jika pelanggan yang beli tidak sama dengan yg login ,maka lair ke riiwayat -->
            <?php 
                //mendapatkan id_pelanggan yg beli
                $idYgBeli = $detail['id_pelanggan'];

                //id pelanggan yang login
                $idYgLogin = $_SESSION['pelanggan']['id_pelanggan'];

                if ($idYgBeli !== $idYgLogin) {
                    echo "<script>alert('Anda tidak bisa akses halaman ini');</script>";
                    echo "<script>location='riwayat.php';</script>";
                    exit();
                }
            ?>


            <div class="row">
                <div class="col-md-4">
                    <h3>Pembelian</h3>
                    <strong>No. Pembelian : <?= $detail['id_pembelian']; ?></strong><br>
                    Tanggal : <?= $detail['tanggal_pembelian']; ?> <br>
                    Total : <?= $detail['total_pembelian']; ?>
                </div>
                <div class="col-md-4">
                    <h3>Pelanggan</h3>
                    <strong><?= $detail['nama_pelanggan']; ?></strong>
                    <p>
                        <?= $detail['telepon_pelanggan']; ?><br>
                        <?= $detail['email_pelanggan']; ?>
                    </p>
                </div>
                <div class="col-md-4">
                    <h3>Pengiriman</h3>
                    <strong><?= $detail['tipe']; ?> <?= $detail['distrik']; ?> - <?= $detail['provinsi']; ?></strong><br>
                    Ongkos Kirim : Rp. <?= number_format($detail['ongkir']); ?> <br>
                    Ekspedisi : <?= $detail['ekspedisi']; ?> <?= $detail['paket']; ?> <?= $detail['estimasi']; ?> <br>
                    Alamat : <?= $detail['alamat_pengiriman']; ?>

                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Berat</th>
                        <th>Jumlah</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
                    <?php $nomor =1; ?>
                    <?php while($data = $ambil->fetch_assoc()){?>
                    <tr>
                        <td><?= $nomor; ?></td>
                        <td><?= $data['nama']; ?></td>
                        <td>Rp. <?= number_format($data['harga']); ?></td>
                        <td><?= $data['berat']; ?>.gr</td>
                        <td><?= $data['jumlah']; ?></td>
                        <td>Rp. <?= number_format($data['subharga']); ?></td>
                    </tr>
                    <?php $nomor++ ?>
                    <?php } ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-7">
                    <div class="alert alert-info">
                        <p>Silahkan melakukan pembayaran Rp. <?= number_format($detail['total_pembelian']); ?> Ke <br>
                            <strong>BANK BCA 123-1234-50 AN. Ridwan</strong>
                         </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>