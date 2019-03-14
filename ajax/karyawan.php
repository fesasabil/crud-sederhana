<?php
require '../functions.php';

$keyword = $_GET["keyword"];
$query = "SELECT * FROM karyawan 
                WHERE nama LIKE '%$keyword%' OR
                umur LIKE '%$keyword%' OR
                devisi LIKE '%$keyword%' OR
                status LIKE '%$keyword%' OR
                gaji LIKE '%$keyword%'
                ";

$karyawan = query($query);

?>

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

