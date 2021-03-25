
<h1>Ini Adalah Halaman Data Produk</h1>

<a href="index.php?halaman=tambahproduk" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data</a>
<br><br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>NO</th>
            <th>Kategori</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Berat Produk</th>
            <th>Foto</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori"); ?>
        <?php while($data = $ambil ->fetch_assoc()){ ?>
        <tr>
           
            <td><?= $nomor; ?></td>
            <td><?= $data['nama_kategori']; ?></td>
            <td><?= $data['nama_produk']; ?></td>
            <td><?= $data['harga_produk']; ?></td>
            <td><?= $data['berat']; ?></td>
            <td><img src="../foto_produk/<?= $data['foto_produk']; ?>" width="100" alt=""></td>
            <td><?= $data['stok_produk']; ?></td>
            <td>
                <a href="index.php?halaman=hapusproduk&id=<?= $data['id_produk']; ?>" class="btn btn-danger" onclick="return confirm('Yakin Hapus')"><i class="fa fa-trash-o" aria-hidden="true"></i>
</a>
                <a href="index.php?halaman=ubahproduk&id=<?= $data['id_produk']; ?>" class="btn btn-info"><i class="fa fa-edit "></i></a>
                <a href="index.php?halaman=detailproduk&id=<?= $data['id_produk']; ?>" class="btn btn-success"><i class="fa fa-eye "></i></a>
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>