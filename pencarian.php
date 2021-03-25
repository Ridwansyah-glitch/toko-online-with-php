<?php include("koneksi.php");

$keyword = $_GET['keyword'];

$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' 
OR deskripsi_produk LIKE '%$keyword%'");

while($data = $ambil->fetch_assoc()){
    $semuadata[] =$data;
}

// echo "<pre>";
//     print_r($semuadata);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php include('menu.php') ?>
    <div class="container">
        <h3>Hasil Pencarian : <?= $keyword; ?></h3>
        <?php if(empty($semuadata)): ?>
            <div class="alert alert-danger"><?= $keyword; ?> tidak ditemukan</div> 
            <?php exit(); ?>
        <?php endif;?>
        <?php foreach($semuadata as $key => $value): ?>
            <div class="col-md-3">
                    <div class="thumbnail">
                        <img src="foto_produk/<?= $value['foto_produk']; ?>" alt="" width="300" >
                        <div class="caption">
                            <h3><?= $value['nama_produk']; ?></h3>
                            <h5><?= number_format($value['harga_produk']); ?></h5>
                            <a href="beli.php?id= <?= $value['id_produk']; ?>" class="btn btn-primary">Beli</a>
                            <a href="detail.php?id=<?= $value['id_produk'] ;?>" class="btn btn-default">detail</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>