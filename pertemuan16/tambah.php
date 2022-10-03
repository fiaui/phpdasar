<?php 
session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
} 

require 'functions.php';

 if( isset($_POST["submit"]) ){


        
    if( tambah($_POST) > 0 ) {
        echo "
           <script> 
           alert('data berhasil ditambahkan');
           document.location.href = 'index.php';
           </script> ";
    } else {
        echo "
        <script> 
        alert('data gagal ditambahkan');
        document.location.href = 'index.php';
        </script> ";
    }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Data Mahasiswa</title>
</head>
<body>
    <h1>Tambah data mahasiswa</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="Nama">Nama : </label>
                <input type="" name="Nama" id="Nama"
                required>
            </li>
            <li>
                <label for="Nrp">NRP : </label>
                <input type="text"name="Nrp" id="Nrp"
                required>
            </li>
            <li>
                <label for="Email">Email : </label>
                <input type="text" name="Email" id="Email">
            </li>
            <li>
                <label for="Jurusan">Jurusan : </label>
                <input type="text" name="Jurusan" id="Jurusan">
            </li>
            <li>
                <label for="Gambar">Gambar : </label>
                <input type="file" name="Gambar" id="Gambar">
            </li>
            <li>
                <button type="submit" name="submit">Tambah Data!</button>
            </li>
        </ul>

    </form>
</body>
</html>