<?php
    ob_start();

    require_once "Database.php";

    $db = new Database();

    $npm = $_GET['npm'];
    
    $mahasiswa = $db->table('mahasiswa')->where(['npm' => $npm])->first();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
        <label>NPM</label>
        <input type="text" name="npm" value="<?=$mahasiswa['npm']?>" required/>
        <br/>
        <label>NAMA</label>
        <input type="text" name="nama" value="<?=$mahasiswa['nama']?>" required/>
        <br/>
        <label>KELAS</label>
        <input type="text" name="kelas" value="<?=$mahasiswa['kelas']?>" required/>
        <br/>
        <label>KODE PRODI</label>
        <input type="text" name="kode_prodi" value="<?=$mahasiswa['kode_prodi']?>" required/>
        <br/>
        <input type="submit" name="update" value="Update"/>
    </form>
</body>
</html>

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $query = $db->table('mahasiswa')
            ->where([
                'npm' => $mahasiswa['npm']
            ])
            ->update([
                'npm' => $_POST['npm'],
                'nama' => $_POST['nama'],
                'kelas' => $_POST['kelas'],
                'kode_prodi' => $_POST['kode_prodi']
            ]);

    header('Refresh:0, url=mahasiswa.php');
}