<?php
require 'functions.php';

if ( isset($_POST["register"])) {
    if ( registrasi($_POST) > 0) {
        echo "<script>
            alert('user berhasil ditambah');
            </script>";
    }else {
        echo mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Halaman Registrasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <style>
        label {
            display: block;
        }
    </style>
</head>
<body>

<h1>Registrasi</h1>

<form action="" method="post">
    <ul>
        <li>
            <label for="username">username :</label>
            <input type="text" name="username" id="username">
        </li>

        <li>
            <label for="password">Password :</label>
            <input type="password" name="password" id="password">
        </li>

        <li>
            <label for="password2">Confirmasi password :</label>
            <input type="password" name="password2" id="password2">
        </li><br>

        <li>
            <button type="submit" name="register">Register</button>
        </li>
    
    </ul>
</form>
    
</body>
</html>