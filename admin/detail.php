<h1>Detail Pembelian</h1>

<?php $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");

$detail = $ambil->fetch_assoc();
?>
<div class="row">
    <div class="col-md-4">
        <h3>Pembelian</h3>
       <p>
       Tanggal : <?= date("d F Y", strtotime($detail['tanggal_pembelian'])); ?><br>
        Total : Rp. <?= number_format($detail['total_pembelian']); ?> <br>
        Status : <?= $detail['status_pembelian']; ?>
       </p>
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
            <th>Jumlah</th>
            <th>Sub Total</th>
        </tr>
    </thead>
    <tbody>
        <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk 
        ON pembelian_produk.id_produk=produk.id_produk 
        WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
        <?php $nomor =1; ?>
        <?php while($data = $ambil->fetch_assoc()):?>
        <tr>
            <td><?= $nomor; ?></td>
            <td><?= $data['nama_produk']; ?></td>
            <td><?= number_format($data['harga_produk']); ?></td>
            <td><?= $data['jumlah']; ?></td>
            <td>
            <?= number_format($data['harga_produk']*$data['jumlah']); ?>
            </td>
        </tr>
        <?php $nomor++ ?>
        <?php endwhile; ?>
    </tbody>
</table>