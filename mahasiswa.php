<?php
    ob_start();
    require_once 'Database.php';
    $db = new Database();
    $mhs = $db->table('mahasiswa')
        // ->orderBy([
        //     'kode_prodi' => 'ASC',
        //     'kelas' => 'ASC',
        // ])
        ->get();
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
        <input type="text" name="npm" required/>
        <br/>
        <label>NAMA</label>
        <input type="text" name="nama" required/>
        <br/>
        <label>KELAS</label>
        <input type="text" name="kelas" required/>
        <br/>
        <label>KODE PRODI</label>
        <input type="text" name="kode_prodi" required/>
        <br/>
        <input type="submit" name="submit"/>
    </form>
<hr/>
    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Kode Prodi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $num = 1;
            foreach($mhs as $row): 
            ?>
                <tr>
                    <td><?= $num++ ?></td>
                    <td><?= $row['npm'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['kelas'] ?></td>
                    <td><?= $row['kode_prodi'] ?></td>
                    <td>
                        <a href="mahasiswa-edit.php?npm=<?=$row['npm']?>">EDIT</a>
                        <form method="POST" action="<?php $_SERVER['PHP_SELF']?>" onsubmit="return confirm('Apakah anda yakin?');">
                            <input type="hidden" name="npm" value="<?=$row['npm']?>"/>
                            <input type="submit" name="delete" value="HAPUS"/>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

<?php

if(isset($_POST['submit']))
{
    $db->table('mahasiswa')
        ->insert([
            'npm' => $_POST['npm'],
            'nama' => $_POST['nama'],
            'kelas' => $_POST['kelas'],
            'kode_prodi' => $_POST['kode_prodi'],
        ]);

    header('Refresh:0');
}

if(isset($_POST['delete']))
{
    $db->table('mahasiswa')
        ->where([
            'npm' => $_POST['npm']
        ])->delete();

    header('Refresh:0');
}