<?php
    require_once 'Database.php';
    $db = new Database();
    $mhs = $db->table('mahasiswa')
        ->orderBy([
            'kode_prodi' => 'ASC',
            'kelas' => 'ASC',
        ])
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
    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Kode Prodi</th>
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
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>