<?php
$conn = mysqli_connect("localhost", "root", "siapalagi04", "phpdasar");

function query($query) {
    global $conn;

    $result = mysqli_query($conn, $query);
    $kos = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $kos[] = $row;
    }
        return $kos;
}

function tambah($data) {
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $umur = htmlspecialchars($data["umur"]);
    $devisi = htmlspecialchars($data["devisi"]);
    $status = htmlspecialchars($data["status"]);
    $gaji = htmlspecialchars($data["gaji"]);

    //upload gambar
  $gambar = upload();
    if (!$gambar) {
        return false;
    }

    //query insert data
    $query = "INSERT INTO karyawan (gambar, nama, umur, devisi, status, gaji) VALUES ('$gambar', '$nama', '$umur', '$devisi', '$status', '$gaji')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);  
}

function upload(){
    $namafile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpname = $_FILES['gambar']['tmp_name']; 

    if ($error === 4) {
        echo "<script>
            alert('pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }

    //cek gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namafile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
            alert   ('Yang anda upload bukan gambar!');
            </script>";
        return false;
    }

    //cek ukuran
    if($ukuranfile > 2000000){
        echo "<script>
            alert('ukuran gambar terlalu besar!');
            </script>";
        return false;
    }

    //generate nama gambar baru
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensiGambar;

    move_uploaded_file($tmpname, 'img/' . $namafilebaru);
    return $namafilebaru;
}

function hapus($id) {
    global $conn;

    mysqli_query($conn, "DELETE FROM karyawan WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function edit($data) {
    global $conn;

    $id = $data["id"];
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    //cek gambar
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    }else {
        $gambar = upload();
    }

    $nama = htmlspecialchars($data["nama"]);
    $umur = htmlspecialchars($data["umur"]);
    $devisi = htmlspecialchars($data["devisi"]);
    $status = htmlspecialchars($data["status"]);
    $gaji = htmlspecialchars($data["gaji"]);

    //query update data
    $query = "UPDATE karyawan SET
                gambar = '$gambar',
                nama = '$nama',
                umur = '$umur',
                devisi = '$devisi',
                status  = '$status',
                gaji = '$gaji'
                WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword){
    $query = "SELECT * FROM karyawan 
                WHERE nama LIKE '%$keyword%' OR
                umur LIKE '%$keyword%' OR
                devisi LIKE '%$keyword%' OR
                status LIKE '%$keyword%' OR
                gaji LIKE '%$keyword%'
                ";

    return query($query);
}

function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek username
    $result = mysqli_query($conn, "SELECT username from users WHERE username = '$username'");

    if ( mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Username sudah ada!');
            </script>";

        return false;
    }


    //cek confirmasi password
    if( $password !== $password2){
        echo "<script>
                alert('Confirmasi password tidak sesuai');
            </script>";
    
        return false;    
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //menambahkan user ke database
    mysqli_query($conn, "INSERT INTO users (username, password)  VALUES ('$username', '$password')");

    return mysqli_affected_rows($conn);
}



?>