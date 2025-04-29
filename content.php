<?php
$a = 'Mangga';

if($a == 'Apel') {
    echo 'Ini adalah Apel';
} elseif ($a == 'Mangga') {
    echo 'Ini adalah Mangga';
} else {
    echo "Ini bukan Mangga maupun Apel";
}
echo "</br>";
echo htmlspecialchars("</br>");
echo ($a == 'Apel') ? 'Ini adalah Apel' : 'Ini bukan Apel';

$data = array(
    array(
        'npm' => '5520123001',
        'nama' => 'Mahasiswa A',
        'kelas' => 'B'
    ),
    array(
        'npm' => '5520123002',
        'nama' => 'Mahasiswa B',
        'kelas' => 'B'
    ),
    array(
        'npm' => '5520123003',
        'nama' => 'Mahasiswa C',
        'kelas' => 'B'
    ),
);
?>
<h1>
    <?=$a?>
    <?php
        echo $a;
    ?>
</h1>
<pre>
<?php print_r($data); ?>
</pre>
<?php
foreach ($data as $mhs) {
    echo "NPM: " . $mhs['npm'] . "\n";
    echo "Nama: " . $mhs['nama'] . "\n";
    echo "Kelas: " . $mhs['kelas'] . "\n";
}

for ($i=0; $i < count($data); $i++) { 
    echo "NPM: " . $data[$i]['npm'] . "\n";
}

?>
<table border='1'>
    <thead>
        <tr>
            <th>#</th>
            <th>NPM</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $num = 1;
            foreach($data as $mhs) {
        ?>
        <tr>
            <td><?=$num++?></td>
            <td><?=$mhs['npm']?></td>
            <td><?=$mhs['nama']?></td>
            <td><?=$mhs['kelas']?></td>
            <td>
                <a href="localhost:8080/edit/<?=$mhs['npm']?>">Edit</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>