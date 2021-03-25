<?php 
    $id_produk = $_GET['id'];

    $ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori
     WHERE id_produk='$id_produk'");
    $data = $ambil->fetch_assoc();

    $fotoproduk = [];
    $ambilFoto = $koneksi->query("SELECT * FROM foto_produk WHERE id_produk='$id_produk'");
    while($fotos = $ambilFoto->fetch_assoc()) {
        $fotoproduk[] = $fotos;
    }
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";

    // echo "<pre>";
    // print_r($fotoproduk);
    // echo "</pre>";
?>
<h3>Detail Produk</h3>
<br>
<table class="table">
    <tr>
        <th>Kategori</th>
        <td><?= $data['nama_kategori']; ?></td>
    </tr>
    <tr>
        <th>Produk</th>
        <td><?= $data['nama_produk']; ?></td>
    </tr>
    <tr>
        <th>Harga</th>
        <td>Rp. <?= number_format($data['harga_produk']); ?></td>
    </tr>
    <tr>
        <th>Berat</th>
        <td><?= $data['berat']; ?></td>
    </tr>
    <tr>
        <th>Deskripsi</th>
        <td><?= $data['deskripsi_produk']; ?></td>
    </tr>
    <trm> 
        <th>Stok</th>
        <td><?= $data['stok_produk']; ?></td>
    </trm>
</table>
<div class="row">
    <?php foreach($fotoproduk as $key =>$value): ?>
    <div class="col-md-3">
        <img src="../foto_produk/<?= $value['nama_produk_foto'];?>" alt="" class="img-responsive">
        <a href="index.php?halaman=hapusfotoproduk&idfoto=<?= $value['id_foto_produk'] ;?>&idproduk=<?= $id_produk;?>" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
    </div>
    <?php endforeach; ?>
</div><br>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="" >File Foto</label>
        <input type="file" name="produk_foto">
        <button class="btn btn-primary" name="simpan">Simpan</button>
    </div>
</form>

<?php 
    if (isset($_POST['simpan'])) {
        $lokasiFoto = $_FILES['produk_foto']['tmp_name'];
        $namaFoto = $_FILES['produk_foto']['name'];

        $namaFoto = date("YmdHis").$namaFoto;

        //upload
        move_uploaded_file($lokasiFoto,"../foto_produk/".$namaFoto);
        $koneksi->query("INSERT INTO foto_produk (id_produk,nama_produk_foto) VALUES('$id_produk','$namaFoto')");
            
        echo "<script>alert('foto produk sudah ditambah');</script>";
        echo "<script>location='index.php?halaman=detailproduk&id=$id_produk';</script>";
    }
?>