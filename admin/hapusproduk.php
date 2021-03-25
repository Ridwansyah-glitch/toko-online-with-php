<?php

    $ambil = $koneksi ->query("SELECT * FROM produk WHERE id_produk= '$_GET[id]'");
    $data = $ambil->fetch_assoc();
    $fotoproduk = $data['foto_produk'];
    if(file_exists("../foto_produk/$fotoproduk")){
        unlink("../foto_produk/$fotoproduk");
    }

    $koneksi->query("DELETE FROM produk WHERE id_produk = '$_GET[id]'");

    echo "<script>alert('produk sudah terhapus');</script>";
    echo "<script>location='index.php?halaman=produk'</script>";