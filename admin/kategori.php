<?php 
    $semuadata = [];
    $ambil = $koneksi->query("SELECT * FROM kategori");
    while($data = $ambil->fetch_assoc()) {
        $semuadata[] = $data;
    }

    // echo "<pre>";
    //     print_r($semuadata);
    // echo "</pre>";
?>
<h3>Data Kategori</h3><br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($semuadata as $key => $value): ?>
        <tr>
            <td><?= $key+1; ?></td>
            <td><?= $value['nama_kategori']; ?></td>
            <td>
                <a href="" class="btn btn-warning btn-sm"  onclick="return confirm('Yakin Hapus')"><i class="fa fa-edit"></i> </a>
                <a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="" class="btn btn-success">Tambah Data</a>