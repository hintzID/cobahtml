<?php

require 'functions.php';

$santri = query("SELECT * FROM latihanphp1");

if (isset($_POST["cari"])) {

  $santri = cari($_POST["keyword"]);
}


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
a:link, a:visited {
  background-color: white;
  color: black;
  border: 2px solid green;
  padding: 5px 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  width:  80px;
  height: 50px;
}

a:hover, a:active {
  background-color: green;
  color: white;
}

body{
  background-image:url("img/wp1.jpg");
}

table,tr,td, th{
  border : 10px red solid;
  height: 100px; width: 100px;
  font-weight: bold;
}

th{
  font-weight: 1000;
  font-size:20px;
}

</style>
  </head>
  <body>
<div class="container-fluid" style="">
    <br>
    <h1 style="text-align:center; background-color:purple; color:white;">DAFTAR NAMA SANTRI</h1>
    <br>
    <div class="container" style="background-color: violet; position:center;" ><a href="tambah.php" style="text-decoration:none; background-color:yellow; padding: 0px 2px 2px 2px; float:left;" >Tambah Data</a></div>
</div>
<br>
<div class="container" >
  <span>
<form action="" method="post" style="text-align:center;">

<input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian" autocomplete="off" style="text-align:center;" border="1">
<button type="submit" name="cari" border="1">cari!</button>

</form>
<span>
    <table class="table" style="background-color:violet;">
  <thead>
    <tr>
        
      <th scope="col">No</th>
      <th scope="col">Aksi</th>
      <th scope="col" id="gambar">Gambar</th>
      <th scope="col">Nama</th>
      <th scope="col">Alamat</th>
      <th scope="col">Nomor HP</th>
      <th scope="col">gender</th>
      <th scope="col">Email</th>
    

    </tr>
  </thead>
  <tbody class="table-group-divider">

    <?php $i=1; ?>
    <?php foreach($santri as $row) : ?>

    <tr  >
      <td width="10px"><?= $i; ?></td>
      <td>
        <a href="ubah.php?id=<?= $row["id"]; ?>" style=" height: 30px; width: 70px;" ><b>UBAH</b></a> 
        <a href="hapus.php?id=<?= $row["id"]; ?>" onclick = "return confirm('yakin?');" style=" height: 30px; width: 70px; background-color:red;"><b>HAPUS</b></a>
      </td>
      <td ><img src="img/<?= $row["gambar"]; ?>" style="object-fit: fill; width: 100%; height: 100%; "></td>
      <td><?= $row["nama"]; ?></td>
      <td><?= $row["alamat"]; ?></td>
      <td><?= $row["no hp"]; ?></td>
      <td><?= $row["gender"]; ?></td>
      <td><?= $row["email"]; ?></td>
      
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>

</table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

  </body>
</html>