<?php 

session_start();

//mendapatkan id produk dari url
$id_produk = $_GET['id'];

//jika sudah ada produk ini dikeranjang , maka produk di jumlah +1
if(isset($_SESSION['keranjang'][$id_produk])){

    $_SESSION['keranjang'][$id_produk]+=1;
}else{
    //selain itu belum ada di keranjang
    $_SESSION['keranjang'][$id_produk] =1;
}

    echo "<script>alert('produk telah masuk ke keranjang belanja');</script>";
    echo "<script>location='keranjang.php';</script>";
  
?>