

<h1>Ini Data Pelanggan</h1>
<br>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>NO</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pelanggan"); ?>
        <?php while($data = $ambil ->fetch_assoc()): ?>
        <tr>
           
            <td><?= $nomor; ?></td>
            <td><?= $data['nama_pelanggan']; ?></td>
            <td><?= $data['email_pelanggan']; ?></td>
            <td><?= $data['telepon_pelanggan']; ?></td>
            <td>
                <a href="" class="btn btn-danger"  onclick="return confirm('Yakin Hapus')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                <a href="" class="btn btn-warning"><i class="fa fa-edit"></i></a>
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php endwhile; ?>
    </tbody>
</table>