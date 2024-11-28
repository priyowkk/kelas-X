<?php
$nama = array('joni', 'budi', 'tejo', 'siti', 'edi', "100", "2.5");

var_dump($nama);

echo "<br>";

echo $nama[5];

echo "<br>";

// for ($i = 0; $i < 6; $i++){
//     // echo $i
//     echo $nama[$i].'<br>'; 
// }

// foreach ($nama as $k) {
//     echo $k . '<br>';
// }

$nama = array(
    "joni"  => "surabaya",
    "budi"  => "malang",
    "tejo"  => "jakarta",
    "siti"  => "sidoarjo",
);
var_dump($nama);

echo "<br>";

echo $nama['budi'];
foreach($nama as $key => $value){
    echo $key . " => " . $value . "<br>";
}