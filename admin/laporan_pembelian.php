<?php 
    $semuadata=[];
    $tglm= '-';
    $tgls= '-';
    if (isset($_POST['kirim'])) {
        
        
        $tglm = $_POST['tgl_mulai'];
        $tgls = $_POST['tgl_selesai'];
        
        $ambil = $koneksi->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl ON
        pm.id_pelanggan=pl.id_pelanggan WHERE tanggal_pembelian BETWEEN '$tglm' AND '$tgls'");
        while($data = $ambil->fetch_assoc()){
            $semuadata[]= $data;
        }

        // echo "<pre>";
        //     print_r($semuadata);
        // echo "</pre>";
        
    }

?>

<h2>Laporan Pembelian dari <?= $tglm; ?> sampai <?= $tgls; ?></h2>
<hr>

<form action="" method="POST">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="tgl_mulai">Tanggal Mulai</label>
                <input type="date" name="tgl_mulai" id="tgl_mulai"  class="form-control" value="<?= $tglm;?>">
            </div>
        </div>
        <div class="col-md-5">
        <div class="form-group">
                <label for="tgl_selesai">Tanggal Selesai</label>
                <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control" value="<?= $tglm;?>">
            </div>
        </div>
        <div class="col-md-2">
            <label for="">&nbsp;</label><br>
            <button class="btn btn-primary" name="kirim"><i class="fa fa-eye"></i> Lihat</button>
        </div>
    </div>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Tanggal Pembelian</th>
            <th>Status</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; ?>
        <?php foreach($semuadata as $key => $value) : ?>
        <?php $total+=$value['total_pembelian']; ?>
        <tr>
            <th><?= $key+1; ?></th>
            <td><?= $value['nama_pelanggan']; ?></td>
            <td><?= date("d F Y", strtotime($value['tanggal_pembelian'])); ?></td>
            <td><?= $value['status_pembelian']; ?></td>
            <td><?= number_format($value['total_pembelian']); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4">Total</th>
            <th>Rp. <?= number_format($total); ?></th>
        </tr>
    </tfoot>
</table>