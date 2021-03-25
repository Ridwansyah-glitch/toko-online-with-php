<?php 
    session_start();
    include("koneksi.php");

    //mendapatkan id_produk
    $id_produk = $_GET['id'];

    //query
    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk ='$id_produk'");
    $data = $ambil->fetch_assoc();
    
?>
    <!-- <pre>
        <?php 
        // print_r($data);
        
        ?>
    </pre> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
    
    <!-- navbar -->
    <?php include("menu.php"); ?>
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="foto_produk/<?= $data['foto_produk'];?>" alt="" class="img-responsive">
            </div>
            <div class="col-md-6">
                <h2><?= $data['nama_produk']; ?></h2>
                <h4>Rp. <?= number_format($data['harga_produk']); ?></h4>
                <h5>Stok : <?= $data['stok_produk']; ?></h5>
                <form action="" method="POST">
                    <div class="form-group">
                        <div class="input-group">
                        <input type="number" min="1" name="jumlah" id="" class="form-control" max="<?= $data['stok_produk'];?>">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" name="beli">Beli</button>
                        </div>
                        </div>
                    </div>
                </form>

                <?php 
                    if (isset($_POST['beli'])) {
                        //mendapatkan jumlah 
                        $jumlah = $_POST['jumlah'];
                        //masukan ke keranjang
                        $_SESSION['keranjang'][$id_produk] = $jumlah; 
                       
                        echo "<script>alert('produk telah masuk ke keranjang belanja');</script>";
                        echo "<script>location='keranjang.php';</script>";
                    }
                ?>
                <p><?= $data['deskripsi_produk']; ?></p>
            </div>
        </div>
    </div>
</section>
</body>
</html>