<h1>Ini Data Pembelian</h1>
<br>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>NO</th>
            <th>Nama Pelanggan</th>
            <th>Tanggal Pembelian</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan"); ?>
        <?php while($data = $ambil ->fetch_assoc()): ?>
            <tr>
            
                <td><?= $nomor; ?></td>
                <td><?= $data['nama_pelanggan']; ?></td>
                <td><?= date(" d F Y",strtotime($data['tanggal_pembelian'])); ?></td>
                <td><?= $data['status_pembelian']; ?></td>
                <td>Rp. <?= number_format($data['total_pembelian']); ?></td>
                <td>
                    <a href="index.php?halaman=detail&id=<?= $data['id_pembelian']; ?>" class="btn btn-primary">detail</a>
                
                    <?php if($data['status_pembelian'] !== "pending"): ?>
                    <a href="index.php?halaman=pembayaran&id=<?= $data['id_pembelian']; ?>" class="btn btn-success">Pembayaran</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php $nomor++; ?>
        <?php endwhile; ?>
    </tbody>
</table>