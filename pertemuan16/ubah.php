<?php 
session_start();

if( !isset ($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
} 

require 'functions.php';

$id = $_GET["id"];

$mhs = query("SELECT * FROM mahasiswaa WHERE id = $id")[0];

 if( isset($_POST["submit"]) ){
        
    if( ubah($_POST) > 0 ) {
        echo "
           <script> 
                alert('data berhasil diubah');
                document.location.href = 'index.php';
           </script> ";
    } else {
        echo "
        <script> 
            alert('data gagal diubah');
            document.location.href = 'index.php';
        </script> ";
    }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ubah Data Mahasiswa</title>
</head>
<body>
    <h1>Ubah data mahasiswa</h1>

    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
        <ul>
            <li>
                <label for="Nama">Nama : </label>
                <input type="" name="Nama" id="Nama"
                required value="<?= $mhs["Nama"] ?>"> 
            </li>
            <li>
                <label for="Nrp">NRP : </label>
                <input type="text"name="Nrp" id="Nrp"
                required value="<?= $mhs["Nrp"] ?>">
            </li>
            <li>
                <label for="Email">Email : </label>
                <input type="text" name="Email" id="Email"
                required value="<?= $mhs["Email"] ?>">
            </li>
            <li>
                <label for="Jurusan">Jurusan : </label>
                <input type="text" name="Jurusan" id="Jurusan"
                required value="<?= $mhs["Jurusan"] ?>">
            </li>
            <li>
                <label for="Gambar">Gambar : </label>
                <input type="text" name="Gambar" id="Gambar"
                required value="<?= $mhs["Gambar"] ?>">
            </li>
            <li>
                <button type="submit" name="submit">Ubah Data!</button>
            </li>
        </ul>

    </form>
</body>
</html>