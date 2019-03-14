<?php
session_start();

if (!isset($_SESSION["submit"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$id = $_GET["id"];

if (hapus($id) > 0) {
    echo "<script>
                    alert('data berhasil didelete!');
                    document.location.href = 'index.php';
            </script>";
}else {
    echo "<script>
                    alert('data gagal didelete!');
                    document.location.href = 'index.php';
            </script>";
}

?>