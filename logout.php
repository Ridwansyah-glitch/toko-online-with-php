<?php
    session_start();

    //menghancurkn session destroy
    session_destroy();
    echo "<script>alert('anda telah logout');</script>";
    echo "<script>location='index.php';</script>";
?>