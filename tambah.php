<?php
session_start();

if (!isset($_SESSION["submit"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

//mengecek tombol submit
if( isset($_POST["submit"]) ) {

        if (tambah($_POST) > 0 ) {
            echo "<script>
                    alert('data berhasil ditambahkan!');
                    document.location.href = 'index.php';
            </script>";
        }else {
            echo "<script>
                    alert('data gagal ditambahkan!');
                    document.location.href = 'index.php';
            </script>";
        }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tambah data Karyawan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
</head>
<body>
    <h1>Tambah data Karyawan</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="Gambar">Gambar :</label>
                <input type="file" name="gambar" id="Gambar" required> 
            </li>
                
            <li>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama" required> 
            </li>

            <li>
                <label for="umur">Umur :</label>
                <input type="text" name="umur" id="umur" required> 
            </li>

            <li>
                <label for="Devisi">Devisi :</label>
                <input type="text" name="devisi" id="Devisi" required> 
            </li>

            <li>
                <label for="Status">Status :</label>
                <input type="text" name="status" id="Status" required> 
            </li>

            <li>
                <label for="Gaji">Gaji :</label>
                <input type="text" name="gaji" id="Gaji" required> 
            </li>

        </ul>
         <button type="submit" name="submit">Tambah</button>
    </form> 
</body>
</html>