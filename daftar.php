<?php 
    include("koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">       
</head>
<body>
<!-- navbar -->
<?php include("menu.php"); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Daftar Pelanggan</h3>
                    </div>
                    <div class="panel-body">
                        <form action="" method="POST" class="form-horizontal">
                            <div class="form-group">
                                <label for="nama" class="control-label col-md-3">Nama</label>
                                <div class="col-md-7">
                                    <input type="text" name="nama" id="nama" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label col-md-3">Email</label>
                                <div class="col-md-7">
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label col-md-3">Password</label>
                                <div class="col-md-7">
                                    <input type="password" name="password" id="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="control-label col-md-3">Alamat</label>
                                <div class="col-md-7">
                                    <textarea name="alamat" id="" cols="30"  class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="telepon" class="control-label col-md-3">Telp/Hp</label>
                                <div class="col-md-7">
                                    <input type="text" name="telepon" id="telepon" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-3">
                                    <button class="btn btn-primary" name="daftar">Daftar</button>
                                </div>
                            </div>
                        </form>

                        <?php 
                            //jika ada tombol daftar di tekan
                            if (isset($_POST['daftar'])) {
                                //mengambil data dari form input
                                $nama = $_POST['nama'];
                                $email = $_POST['email'];
                                $password = $_POST['password'];
                                $alamat = $_POST['alamat'];
                                $telepon = $_POST['telepon'];

                                //validasi email sudah digunakan?
                                $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
                                $yangCocok = mysqli_num_rows($ambil);

                                if ($yangCocok === 1) {
                                    echo "<script>alert('Pendaftaran gagal , email sudah digunakan');</script>";
                                    echo "<script>location='daftar.php';</script>";
                                }else{
                                    //query insert tabel pelanggan
                                    $koneksi->query("INSERT INTO pelanggan (email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan,alamat_pelanggan)
                                    VALUES ('$email','$password','$nama','$telepon','$alamat')");

                                    echo "<script>alert('Pendaftaran berhasil disimpan,silahkan login');</script>";
                                    echo "<script>location='login.php';</script>";

                                }
                                
                            }


                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>