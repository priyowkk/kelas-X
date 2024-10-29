<?php
$hobi = [
    "coding",
    "main musik",
    "mancing",
    "sepedah",
    "membaca"
];
$ident = [
    "Nama" => "Priyo Anggodho",
    "Alamat" => "Sono,Sidokerto RT04,RW04",
    "Email" => "anggabuduran@gmail.com",
    "Facebook" => "Anggaaa",
    "Tiktok" => "Priyoanakmamah",
    "IG" => "@Indomiethebestttttttt"
];
$sekolah = [
    "TK Kharisma",
    "SDI Sabilil Falah",
    "MTSN 1 Sidoarjo",
    "SMKN 2 Buduran"
]; //Array satu Dimensi
$sekolahs = [
    "TK" => "TK Kharisma",
    "SD" => "SDI Sabilil Falah",
    "SMP" => "MTSN 1 Sidoarjo",
    "SMK" => "SMKN 2 Buduran",
    "PT" => "Universitas Negeri Surabaya"
]; //Array Associatif
$skills = [
    "C++" => "Expert",
    "HTML" => "Newbie",
    "CSS" => "Newbie",
    "PHP" => "Intermediate",
    "JavaScript" => "Intermediate"
];
// echo "<br>";

// echo $sekolah[0];
// echo "<br>";
// echo $sekolahs["TK"];
// echo "<br>";
// echo $sekolah[1];
// echo "<br>";
// echo $sekolahs["SD"];

// echo "<br>";
// for ($i = 0; $i < 4; $i++) {
//     echo $sekolah[$i];
//     echo "<br>";
// }
// echo "<br>";

// foreach ($sekolah as $key) {
//     echo $key;
//     echo "<br>";
// }
// echo "<br>";

// foreach ($sekolahs as $key => $value) {
//     echo $key;
//     echo "=";
//     echo $value;
//     echo "<br>";
// }
// echo "<br>";

// foreach ($skills as $key => $value) {
//     echo $key;
//     echo "<br>";
// }
if (isset($_GET["menu"])) {
    $menu = $_GET["menu"];
    echo $menu;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <hr>
    <ul>
        <li><a href="?menu=Home">Home</a></li>
        <li><a href="?menu=CV">CV</a></li>
        <li><a href="?menu=Project">Project</a></li>
        <li><a href="?menu=Contact">Contact</a></li>
    </ul>
    <h2>Identitas</h2>
    <table border="1px">
        <tbody>
            <?php
            foreach ($ident as $key => $value) {
            ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $value ?></td>
                </tr>
            <?php
            } ?>
        </tbody>
    </table>
    <hr>
    <h2>Riwayat Sekolah</h2>
    <table border=1>
        <thead>
            <tr>
                <th>Jenjang</th>
                <th>Nama Sekolah</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($sekolahs as $key => $value) {
                echo "<tr>";
                echo "<td>";
                echo $key;
                echo "</td>";
                echo "<td>";
                echo $value;
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <hr>
    <h2>Skills</h2>
    <table border=1>
        <thead>
            <tr>
                <th>Skills</th>
                <th>Level</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($skills as $key => $value) {
            ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $value ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <hr>
    <h2>Hobi</h2>
    <ul>
        <?php
        foreach ($hobi as $key) {
        ?>
            <li><?= $key ?></li>
        <?php
        }
        ?>
    </ul>
</body>

</html>