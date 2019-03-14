<?php
session_start();

if (!isset($_SESSION["submit"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

//ambil data
$id = $_GET["id"];

$krw = query("SELECT * FROM karyawan WHERE id = $id")[0];

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit data Karyawan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
</head>
<body>
    <h1>Edit data Karyawan</h1>

    <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $krw["id"];?>">
    <input type="hidden" name="gambarLama" value="<?php echo $krw["gambar"];?>"> 
        <ul>
            <li>
                <label for="Gambar">Gambar :</label>
                <img src="img/<?php echo $krw['gambar']; ?>" width="40">
                <input type="file" name="gambar" id="Gambar" required> 
            </li>
            
            <li>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama" required value="<?php echo $krw["nama"];?>"> 
            </li>

            <li>
                <label for="umur">Umur :</label>
                <input type="text" name="umur" id="umur" required value="<?php echo $krw["umur"];?>">
            </li>

            <li>
                <label for="Devisi">Devisi :</label>
                <input type="text" name="devisi" id="Devisi" required value="<?php echo $krw["devisi"];?>"> 
            </li>

            <li>
                <label for="Status">Status :</label>
                <input type="text" name="status" id="Status" required value="<?php echo $krw["status"];?>"> 
            </li>

            <li>
                <label for="Gaji">Gaji :</label>
                <input type="text" name="gaji" id="Gaji" required value="<?php echo $krw["gaji"];?>"> 
            </li>

        </ul>
         <button type="submit" name="submit">Update</button>
    </form> 
    <?php
    //mengecek tombol submit
        if( isset($_POST["submit"]) ) {

        if (edit($_POST) > 0 ) {
            echo "<script>
                    alert('data berhasil diupdate!');
                    document.location.href = 'index.php';
            </script>";
        }else {
            echo "<script>
                    alert('data gagal diupdate!');
                    document.location.href = 'index.php';
            </script>";
        }
    }

    ?>

</body>
</html>