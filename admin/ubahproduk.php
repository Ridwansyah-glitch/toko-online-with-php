<h1>Ubah Produk</h1>

<?php
    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
    $data =$ambil->fetch_assoc();

?>
<form  method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Nama</label>
        <input type="text" name="nama" id="" class="form-control" value="<?= $data['nama_produk']; ?>">
    </div>
    <div class="form-group">
        <label for="">Harga (Rp)</label>
        <input type="number" name="harga" id="" class="form-control" value="<?= $data['harga_produk']; ?>">
    </div>
    <div class="form-group">
        <label for="">Berat (Gr)</label>
        <input type="number" name="berat" id="" class="form-control" value="<?= $data['berat']; ?>">
    </div>
    
    <div class="form-group">
        <img src="../foto_produk/<?= $data['foto_produk']; ?>" width="100" alt="">
    </div>
    <div class="form-group">
        <label for="">Ganti Foto</label>
        <input type="file" name="foto" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Deskripsi</label>
        <textarea class="form-control" name="deskripsi"  rows="10">
        <?= $data['deskripsi_produk']; ?>
        </textarea>
    </div>
    <button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php 
    if(isset($_POST['ubah'])){
        $namaFoto =$_FILES['foto']['name'];
        $lokasi = $_FILES['foto']['tmp_name'];
        
        if(!empty($lokasi)){
            move_uploaded_file($lokasi, "../foto_produk/".$namaFoto);
        $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',
                                        harga_produk='$_POST[harga]',
                                        berat ='$_POST[berat]',
                                        foto_produk='$namaFoto',
                                        deskripsi_produk='$_POST[deskripsi]' 
                                        WHERE id_produk='$_GET[id]'");
        }else{
        $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',
        harga_produk='$_POST[harga]',
        berat ='$_POST[berat]',
        foto_produk='$namaFoto',
        deskripsi_produk='$_POST[deskripsi]' WHERE id_produk='$_GET[id]'");
    }
    echo "<script> alert('Data Telah Diubah') </script>";
    echo "<script> location='index.php?halaman=produk'; </script>";
}
?>