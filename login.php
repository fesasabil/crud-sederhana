<?php
session_start();
require 'functions.php';

//cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    //ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    //cek cookie dengan username
    if( $key === hash('sha256', $row['username'])) {
        $_SESSION['submit'] = true;
    }
}

if (isset($_SESSION["submit"])) {
    header("Location: index.php");
    exit;
}

    if( isset($_POST["submit"]) ) {
       $username = $_POST["username"];
       $password = $_POST["password"];
        
       $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

       //cek username
       if( mysqli_num_rows($result) === 1){

            //cek password
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["password"])){
            //set session
            $_SESSION["submit"] = true;

            //cek remember me
            if( isset($_POST['remember'])) {
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() +60 );
            }

             header("Location: index.php");
            exit;
            }
       }

       $error = true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if( isset($error) ): ?>
    <p style="color: red;font-style:italic;">username / password salah</p>
    <?php endif ; ?>

    <form action="" method="post">
        <table>

        <tr>
            <td>
            <label for="user">Username :</label>
            <input type="text" name="username" id="user">
            </td>
        </tr>
        <br>

        <tr>
            <td>
            <label for="password">Password :</label>
            <input type="password" name="password" id="password">
            </td>
        </tr>
        <br>

        <tr>
            <td>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember Me</label>
            </td>
        </tr>

        <tr>
            <td>    
            <button type="submit" name="submit">login</button>
            </td>
        </tr>

        </table>
    </form>
    
    
</body>
</html>