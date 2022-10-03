<?php 
 $conn = mysqli_connect("localhost", "root", "", "phpdasar");

 function query($query){
     global $conn;
     $result = mysqli_query($conn, $query);
     $rows =[];
     while( $row = mysqli_fetch_assoc($result) ){
         $rows[] = $row;
     }
     return $rows;
 }
 function tambah($data){
        global $conn;
        $Nama = htmlspecialchars($data["Nama"]);
        $Nrp = htmlspecialchars($data["Nrp"]);
        $Email = htmlspecialchars($data["Email"]);
        $Jurusan = htmlspecialchars($data["Jurusan"]);

       $Gambar = upload();
       if( !$Gambar){
           return false;
       }

        
        $query = "INSERT INTO mahasiswaa
                    VALUES
                    ('', '$Nama', '$Nrp', '$Email', '$Jurusan',
                     '$Gambar')";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);

 }

 function upload(){
     
    $namafile = $_FILES['Gambar']['name'];
    $ukuranfile = $_FILES ['Gambar']['size'];
    $error = $_FILES['Gambar']['error'];
    $tmpname = $_FILES['Gambar']['tmp_name'];

    //cek apakah ad gambar yang di upload

    if( $error === 4 ){
        echo "<script>
            alert('pilih gambar terlebih dahulu!');
        </script>";
        return false;
    }

    //cek yang di upload
    $ekstensiGambarvalid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namafile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarvalid) ){
        echo "<script>
        alert('Yang Anda Upload Bukan Gambar!');
    </script>";
    return false;
    }
    // cek jika ukuran terlalu besar
    if( $ukuranfile > 1000000 ){
        echo "<script>
        alert('Ukuran Gambar Terlalu Besar!');
    </script>";
    return false;
    }

    // lolos pengecekan
    // generete nama baru
    move_uploaded_file($tmpname, 'pertemuan12' . $namafile);

    return $namafile;


 }

 function hapus($id) {
     global $conn;
     mysqli_query($conn, "DELETE FROM mahasiswaa WHERE id = $id");

     return mysqli_affected_rows($conn);
 }
 function ubah($data){
    global $conn;
    $id = $data["id"];    
    $Nama = htmlspecialchars($data["Nama"]);
    $Nrp = htmlspecialchars($data["Nrp"]);
    $Email = htmlspecialchars($data["Email"]);
    $Jurusan = htmlspecialchars($data["Jurusan"]);
    $Gambar = htmlspecialchars($data["Gambar"]);

    
    $query = "UPDATE mahasiswaa SET 
                Nama = '$Nama', 
                Nrp = '$Nrp',
                Email = '$Email',
                Jurusan = '$Jurusan',
                Gambar = '$Gambar'
                WHERE id = $id
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

 }

 function cari ($keyword){
     $query = "SELECT * FROM mahasiswaa 
                WHERE 
                nama LIKE '%$keyword%' OR
                nrp LIKE '%$keyword%' OR
                email LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%' 
                ";
    return query($query);
 }

 function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $passowrd2 = mysqli_real_escape_string($conn, $data["password2"]);
    

    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username= '$username'");
    if(mysqli_fetch_assoc($result) ){
        echo"<script>
            alert('username sudah terdaftar!');
            </script>";
        return false;
    }
    //cek konfirmasi password
    if($password !== $passowrd2){
    echo "<script>
            alert('konfirmasi password tidak sesuai!');
            </script>";
            return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);
 }
?>