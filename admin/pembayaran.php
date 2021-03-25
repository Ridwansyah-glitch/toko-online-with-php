<h1>Halaman Pembayaran</h1>

<?php 
    //id pembelian
    $id_pembelian = $_GET['id'];

    //mengambil data pembayaran berdasarkan id pembelian
    $ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
    $data = $ambil->fetch_assoc();

    // echo "<pre>";
    //     print_r($data);
    // echo "</pre>";
?>

<div class="row">
    <div class="col-md-6">
        <table class="table">
                <tr>
                    <th>Nama</th>
                    <td>: <?= $data['nama']; ?></td>
                </tr>
                <tr>
                    <th>Bank</th>
                    <td>: <?= $data['bank']; ?></td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td>: Rp. <?= number_format($data['jumlah']); ?></td>
                </tr>
                <tr>
                    <th>Tangal</th>
                    <td>: <?= $data['tanggal']; ?></td>
                </tr>
        </table>
    </div>
    <div class="col-md-6">
        <img src="../bukti-pembayaran/<?= $data['bukti'];?>" alt="" class="img-responsive">
    </div>
</div>

<form action="" method="POST">
    <div class="form-group">
        <label for="resi">Resi</label>
        <input type="text" name="resi" id="resi" class="form-control">
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="" class="form-control">
            <option value=""><-- Pilih Status --></option>
            <option value="lunas">Lunas</option>
            <option value="barang dikirim">Barang Dikirim</option>
            <option value="batal">Batal</option>
        </select>
    </div>
    <button class="btn btn-primary" name="proses">Proses</button>
</form>

<?php 
    if (isset($_POST['proses'])) {

        $resi = $_POST['resi'];
        $status = $_POST['status'];
        $koneksi->query("UPDATE pembelian SET resi='$resi',status_pembelian='$status' WHERE id_pembelian='$id_pembelian'");
    
        echo " <script>alert('data pembelian terupdate');</script>";
        echo " <script>location='index.php?halaman=pembelian';</script>";
    }
?>