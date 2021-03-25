<?php 
    session_start();

    include("koneksi.php");

    //jika tidak ada  session pelanggan
    if (!isset($_SESSION['pelanggan'])) {
        echo "<script>alert('silahkan login');</script>";
        echo "<script>location='login.php';</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Wanshop</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
    <?php include("menu.php"); ?>
    <section class="content">
        
        <div class="container">
            <h1>Keranjang Belanja</h1>
            <hr>
    
            <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor=1; ?>
                <?php $total_berat = 0; ?>
                <?php $totalBelanja = 0; ?>
                <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) :?>
                    <?php   
                        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
                        $data = $ambil->fetch_assoc(); 
                        $subharga = $data['harga_produk'] * $jumlah;
                        
                        //sub berat diperoleh dari berat produk kali jumlah
                        $subberat = $data['berat'] *  $jumlah;
                        //total berat
                        $total_berat += $subberat;
                        // echo "<pre>";
                        // print_r($data);
                        // echo "</pre>";
                    ?>
                    <tr>
                        <td><?= $nomor; ?></td>
                        <td><?= $data['nama_produk']; ?></td>
                        <td>Rp. <?= number_format($data['harga_produk']); ?></td>
                        <td><?= $jumlah ?></td>
                        <td>Rp. <?= number_format($subharga); ?></td>
                    </tr>
                <?php $nomor++; ?>
                <?php $totalBelanja += $subharga; ?>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total Belanja</th>
                    <th>Rp. <?= number_format($totalBelanja); ?> </th>
                </tr>
            </tfoot>
            </table>
            <form action="" method="POST">
               
                <div class="row">
                    <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" readonly value="<?= $_SESSION['pelanggan']['nama_pelanggan'];  ?> ">
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                    <input type="text" class="form-control" readonly value="<?= $_SESSION['pelanggan']['telepon_pelanggan'];  ?> ">
                </div>
                    </div>
               
                </div>
                <div class="form-group">
                    <label for="">Alamat Lengkap Pengiriman</label>
                    <textarea class="form-control" name="alamat_pengiriman" id="" cols="20" ></textarea>
                </div>
                <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                    <label for="">Provinsi</label>
                    <select name="nama_provinsi" id="" class="form-control">
                       
                    </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label for="">Distrik</label>
                    <select name="nama_distrik" class="form-control">
                        
                    </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Ekspedisi</label>
                        <select name="nama_ekspedisi" class="form-control">

                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Paket</label>
                        <select class="form-control" name="nama_paket" id="">
                        
                        </select>
                    </div>
                </div>
            </div>
                <input type="text" name="total_berat" value="<?= $total_berat; ?>">
                <input type="text" name="provinsi">
                <input type="text" name="distrik">
                <input type="text" name="tipe">
                <input type="text" name="kodepos">
                <input type="text" name="ekspedisi">
                <input type="text" name="paket">
                <input type="text" name="ongkir">
                <input type="text" name="estimasi">
                    <button class="btn btn-primary" name="checkout">
                    <i class="glyphicon glyphicon-export"> Checkout</i>
                    </button>

            </form>

            <?php 
            // echo "<pre>";
            //         print_r($_SESSION["pelanggan"]);
            // echo "</pre>";
                if (isset($_POST["checkout"])) {

                    $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
                    $tanggalpembelian = date("Y-m-d");
                    $total_pembelian = $totalBelanja + $ongkir;
                    $alamat = $_POST['alamat_pengiriman'];
                    $total_berat = $_POST["total_berat"];
                    $provinsi = $_POST["provinsi"];
                    $distrik = $_POST["distrik"];
                    $tipe = $_POST["tipe"];
                    $kodepos= $_POST["kodepos"];
                    $ekspedisi = $_POST["ekspedisi"];
                    $paket = $_POST["paket"];
                    $ongkir = $_POST["ongkir"];
                    $estimasi = $_POST["estimasi"];
                    

                    //menyimpan data ke tabel pembelian
                    $koneksi->query("INSERT INTO pembelian(id_pelanggan,tanggal_pembelian,total_pembelian,alamat_pengiriman,resi,totalberat,provinsi,distrik,tipe,kodepos,ekspedisi,paket,ongkir,estimasi) 
                    VALUES ('$id_pelanggan','$tanggalpembelian','$total_pembelian','$alamat','0','$total_berat','$provinsi','$distrik','$tipe','$kodepos','$ekspedisi','$paket','$ongkir','$estimasi')");

                    //mendapatkan id pembelian barusan
                    $idPembelianBarusan = $koneksi->insert_id;
                    

                    foreach($_SESSION["keranjang"] as $id_produk => $jumlah) {
                        //mendapatkan data produk berdasarkan id_produk
                        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                        $data = $ambil->fetch_assoc();

                        $nama = $data['nama_produk'];
                        $harga = $data['harga_produk'];
                        $berat = $data['berat']; 

                        $subberat = $data['berat'] * $jumlah;
                        $subharga = $data['harga_produk'] * $jumlah;

                        
                        $koneksi->query("INSERT INTO pembelian_produk(id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah)
                        VALUES ('$idPembelianBarusan','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah')");
                    
                
                        //update stok produk
                        $koneksi->query("UPDATE produk SET stok_produk=stok_produk -$jumlah WHERE id_produk='$id_produk'");
                }
                    //mengkosongkan keranjang belanja
                    unset($_SESSION["keranjang"]);

                    //tampilan dialihkan ke halaman nota
                    echo "<script>alert('pembelian sukses');</script>";
                    echo "<script>location='nota.php?id=$idPembelianBarusan';</script>";
                }

            ?>
            
        </div>
        </section>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>
</html>
<script>
        $(document).ready(function(){

            $.ajax({
                type :'post',
                url: 'dataprovinsi.php',
                success:function(hasil_provinsi)
                {
                    $("select[name=nama_provinsi]").html(hasil_provinsi);
                    // console.log(hasil_provinsi);
                }
            });

            $("select[name=nama_provinsi]").on("change",function(){
                //ambil id_provinsi yang dipilih
                var id_provinsi_terpilih = $("option:selected",this).attr("id_provinsi");
                // alert(id_provinsi_terpilih);
                $.ajax({
                type :'post',
                url: 'datadistrik.php',
                data:'id_provinsi='+id_provinsi_terpilih,
                success:function(hasil_distrik)
                    {
                        $("select[name=nama_distrik]").html(hasil_distrik);
                        // console.log(hasil_distrik);

                    }
                });

            });

            $.ajax({
                type :'post',
                url: 'dataekspedisi.php',
                success:function(hasil_ekspedisi){
                    $("select[name=nama_ekspedisi]").html(hasil_ekspedisi);
                }
            });

            $("select[name=nama_ekspedisi]").on("change",function(){
                //mendapatkan ongkos kirim

                //mendapatkan ekspedisi yg dipilih
                var ekspedisi_terpilih = $("select[name=nama_ekspedisi]").val();
                

                //mendapatkan id distrik
                var distrik_terpilih = $("option:selected","select[name=nama_distrik]").attr("id_distrik");
               

                //mendapatkan total berat dari inputan
                var total_berat = $("input[name=total_berat]").val();
                
                
                $.ajax({
                    type:'post',
                    url:'datapaket.php',
                    data:'ekspedisi='+ ekspedisi_terpilih+'&distrik='+distrik_terpilih+'&berat='+total_berat,
                    success:function(hasil_paket){
                        // console.log(hasil_paket);
                        $("select[name=nama_paket]").html(hasil_paket);
                        
                        //letakan nama ekspedisi terpilih 
                        $("input[name=ekspedisi]").val(ekspedisi_terpilih);
                    }
                });
            });

            $("select[name=nama_distrik]").on("change",function(){
                var prov = $("option:selected",this).attr("nama_provinsi");
                var dist= $("option:selected",this).attr("nama_distrik");
                var tipe = $("option:selected",this).attr("tipe_distrik");
                var kodepos = $("option:selected",this).attr("kodepos");
                // var ongkir = $("option:selected",this).attr("ongkir");

                $("input[name=provinsi]").val(prov);
                $("input[name=distrik]").val(dist);
                $("input[name=tipe]").val(tipe);
                $("input[name=kodepos]").val(kodepos);

              
            });

            $("select[name=nama_paket]").on("change",function(){
                var paket = $("option:selected",this).attr("paket");
                var ongkir = $("option:selected",this).attr("ongkir");
                var etd = $("option:selected",this).attr("etd");

                $("input[name=paket]").val(paket);
                $("input[name=ongkir]").val(ongkir);
                $("input[name=estimasi]").val(etd)
            });




        });
    </script>
  