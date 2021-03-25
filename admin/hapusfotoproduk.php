<?php
    $id_foto = $_GET['idfoto'];
    $id_produk = $_GET['idproduk'];

    //ambil datanya
    $ambil = $koneksi ->query("SELECT * FROM foto_produk WHERE id_foto_produk= '$id_foto'");
    $data = $ambil->fetch_assoc(); 

    $fotoproduk = $data['nama_produk_foto'];
        //hapus
        unlink("../foto_produk/".$fotoproduk);
    

    $koneksi->query("DELETE FROM foto_produk WHERE id_foto_produk = '$id_foto'");

    echo "<script>alert('foto produk sudah terhapus');</script>";
    echo "<script>location='index.php?halaman=detailproduk&id=$id_produk';</script>";

    echo "<pre>";
    print_r($fotoproduk);
    echo "</pre>";