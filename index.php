<?php
session_start();

if (!isset($_SESSION["submit"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

//mengambil data dari tabel karyawan
 $karyawan = query("SELECT * FROM karyawan ORDER BY id ASC");
    //while ($data = mysqli_fetch_array($result)) {
    // var_dump($data);
    //}

if ( isset($_POST["cari"])) {
    $karyawan = cari($_POST["keyword"]);
}

//cara mengambil data dimysqli
//mysqli_fetch_row(): mengembalikan array numerik
//mysqli_fetch_assoc(): array assosiative
//mysqli_fetch_array(): mengembalikan keduanya
//mysqli_fetch_object(): menggunakan ->

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document Karyawan</title>
</head>
<body>
    <h1>Daftar Karyawan</h1>

    <a href="tambah.php">Tambah data karyawan</a>
    <br><br>

<form action="" method="post">
        <input type="text" name="keyword" placeholder="Search" autofocus autocomplete="off" id="keyword"> 
        <button type="submit" name="cari" id="cari">Search</button>


</form>
<br>

<div id="container">
<table border="1" cellpadding="10" cellspacing="0">
    <tr>    

        <th>No.</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>Nama</th>
        <th>Umur</th>
        <th>Devisi</th>
        <th>Status</th>
        <th>Gaji</th>
    </tr>

    <?php $i = 1; ?>
    <?php foreach ($karyawan as $row) : ?>

    <tr>
        <td><?php echo $i; ?></td>
        <td>
            <a href="edit.php?id=<?php echo $row["id"]; ?>">Edit</a>
            <a href="delete.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('apakah anda ingin menghapus data ini?');">Delete</a>
        </td>
        <td>
            <img src="img/<?php echo $row["gambar"]; ?>" width="50">
        </td>
        <td><?php echo $row["nama"]; ?></td>
        <td><?php echo $row["umur"]; ?></td>
        <td><?php echo $row["devisi"]; ?></td>
        <td><?php echo $row["status"]; ?></td>
        <td><?php echo $row["gaji"]; ?></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>

</table>
</div>

<br>
<a href="logout.php">Logout</a>

<script src="js/script.js">

</script>
</body>
</html>