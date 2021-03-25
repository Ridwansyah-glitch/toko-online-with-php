<?php 
    $datakategori =[];
    $ambil = $koneksi->query("SELECT * FROM kategori");
    while($data = $ambil->fetch_assoc()) {
        $datakategori[] =$data;
    }

    // echo "<pre>";
    //     print_r($datakategori);
    // echo "</pre>"
?>
<h1>Tambah Produk</h1>

<form  method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="kategori">Kategori</label>
        <select name="id_kategori" id="id_kategori" class="form-control">
            <option value=""><-- Pilih Kategori --></option>
           <?php foreach($datakategori as $key => $value): ?>
                <option value="<?= $value['id_kategori']; ?>"><?= $value['nama_kategori']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="nama_produk">Nama</label>
        <input type="text" name="nama_produk" id="nama_produk" class="form-control">
    </div>
    <div class="form-group">
        <label for="harga_produk">Harga (Rp)</label>
        <input type="number" name="harga_produk" id="harga_produk" class="form-control">
    </div>
    <div class="form-group">
        <label for="berat">Berat (Gr)</label>
        <input type="number" name="berat" id="berat" class="form-control">
    </div>
    <div class="form-group">
        <label for="deskripsi_produk">Deskripsi</label>
        <textarea class="form-control" name="deskripsi_produk" id="deskripsi"  rows="10"></textarea>
    </div>
    <div class="form-group">
        <label for="foto">Foto Produk</label>
        <div class="letak-input " style="margin-bottom: 10px;">
            <input type="file" name="foto[]" id="foto" class="form-control">
        </div>
        <span class="btn btn-primary btn-tambah"><i class="fa fa-plus"></i></span>
    </div>
    <div class="form-group">
        <label for="stok">Stok </label>
        <input type="number" name="stok" id="stok" class="form-control">
    </div>
    <button class="btn btn-primary" name="save">Simpan</button>
</form>

<?php
    if(isset($_POST['save'])){ 
        $namaFoto =$_FILES['foto']['name'];
        $lokasiFoto = $_FILES['foto']['tmp_name'];
        move_uploaded_file($lokasiFoto[0], "../foto_produk/".$namaFoto[0]);
        $koneksi->query("INSERT INTO produk 
            (nama_produk,harga_produk,berat,foto_produk,deskripsi_produk,stok_produk,id_kategori)
             VALUES('$_POST[nama_produk]','$_POST[harga_produk]','$_POST[berat]','$namaFoto[0]','$_POST[deskripsi_produk]','$_POST[stok]',
             $_POST[id_kategori])");
        //mendapatkan id barusan 
        $id_produkBarusan = $koneksi->insert_id;

        foreach ($namaFoto as $key => $tiapNama) {
            $tiapLokasi = $lokasiFoto[$key];
            move_uploaded_file($tiapLokasi,"../foto_produk/".$tiapNama);

            //simpan ke mysql(tapi harus tau id produk yg berapa)
            $koneksi->query("INSERT INTO foto_produk(id_produk,nama_produk_foto)
            VALUES ('$id_produkBarusan','$tiapNama')");

        }
        echo "<div class='alert alert-info'>Data Tersimpan</div>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
        
        // echo "<pre>";
        // print_r($_FILES);
        // echo "</pre>";
    }
?>

<script>
    $(document).ready(function(){
        $(".btn-tambah").on("click",function(){
            $(".letak-input").append("<input type='file' name='foto[]' id='foto' class='form-control'>");
        });
    });
</script>
