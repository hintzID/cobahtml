<?php
// koneksi ke database
$conn = mysqli_connect("localhost","root","","latihanphp");


function query($query) {

    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];

    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
 
}


function tambah($data) {

    global $conn;

     //ambil data dari tiap elemen dari form
     $nama = htmlspecialchars($data["nama"]);
     $alamat = htmlspecialchars($data["alamat"]);
     $no_hp = htmlspecialchars($data["no_hp"]);
     $gender = htmlspecialchars($data["gender"]);
     $email = htmlspecialchars($data["email"]);

     //upload gambar
     $gambar = upload();

     if(!$gambar ) {

        return false;
     }

     //query insert data
    $query = "INSERT INTO latihanphp1 VALUES
    ('', '$nama', '$alamat', '$no_hp', '$gender', '$email', '$gambar')
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
 
}

function upload() {

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek apakah ada gambar yang diupload
    if( $error === 4){
        echo "<script>
        alert ('pilih gambar terlebih dahulu!')
        </script>";

        return false;
    }

    //yang boleh di-upload hanya gambar
    $ekstensiGambarValid = ['jpg','jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {

        echo "<script>
        alert ('yang anda upload bukan gambar!')
        </script>";

        return false;

    }

    //cek jika ukurannya terlalu besar
    if($ukuranFile > 1000000) {

        echo "<script>
        alert ('ukuran gambar terlalu besar!')
        </script>";

       return false;
       


    }

    //lolos pengecekan, gambar siap di-upload
    //generate nama baru

    $namaFileBaru = uniqid();
    $namaFileBaru .='.';
    $namaFileBaru .= $ekstensiGambar;

   

    move_uploaded_file($tmpName, 'img/'.$namaFileBaru);

    return $namaFileBaru;

   

}


function hapus($id) {

    global $conn;

    mysqli_query($conn, "DELETE FROM latihanphp1 WHERE id = $id");

    return mysqli_affected_rows($conn);

}


function ubah($data) {

    global $conn;

    //ambil data dari tiap elemen dari form
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    $gender = htmlspecialchars($data["gender"]);
    $email = htmlspecialchars($data["email"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    //cek apakah user pilih gambar baru atau tidak
    if($_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambarLama;
    } else {

        $gambar = upload();

    }

    

    //query insert data
   $query = "UPDATE latihanphp1 SET 
            `nama`= '$nama',
            `alamat` = '$alamat',
            `no hp` = '$no_hp',
            `gender` = '$gender',
            `email` = '$email',
            `gambar` = '$gambar'
             WHERE id = $id
   ";

   mysqli_query($conn, $query);

   return mysqli_affected_rows($conn);

}

function cari($keyword) {
    $query ="SELECT * FROM latihanphp1
             WHERE
             `nama` LIKE '%$keyword%' OR
             `alamat` LIKE '%$keyword%' OR
             `no hp` LIKE '%$keyword%' OR
             `gender` LIKE '%$keyword%' OR
             `email` LIKE '%$keyword%' OR
             `gambar` LIKE '%$keyword%' 
             
             ";
    return query($query);         
 }


?>