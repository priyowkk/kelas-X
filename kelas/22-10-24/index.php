<?php
require_once "./index.php"


?>


<!DOCTYPE html>
<html lang="en">
<div class="header">
    <h1><?php $judul ?></h1>
</div>
<div class="identitas">
    <table>
        <thead>
        </thead>
        <tbody>
            <tr>
                <th>Nama</th>
                <th><?php echo $identities[0] ?></th>
            </tr>
            <tr>
                <th>Alamat</th>
                <th><?php echo $identities[1] ?></th>
            </tr>
        </tbody>
    </table>
</div>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .kamar {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <div class="kamar">
        <h1><?php echo $data; ?></h1>
        <p><? echo $isi; ?></p>
        <h2><?php echo $materi; ?></h2>
        <div class="list">
            <ol>
                <li><?php echo $lists[0] ?></li>
                <p>variabel adalah wadah untuk menyimpan data</p>
                <p>data bisa berupa text atau string bisa juga berupa angka atau numerik,data juga bisa gabungan antara text,angka,dan simbol</p>
                <li><?php echo $lists[1] ?></li>
                <li><?php echo $lists[2] ?></li>
                <li><?php echo $lists[3] ?></li>
                <li><?php echo $lists[4] ?></li>
                <li><?php echo $lists[5] ?></li>
                <li><?php echo $lists[6] ?></li>
                <li><?php echo $lists[7] ?></li>
                <li><?php echo $lists[8] ?></li>
            </ol>
        </div>
    </div>
</body>

</html>