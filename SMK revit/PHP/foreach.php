<?php  
// $nama = array('tejo','budi','siti',100);
// var_dump($nama);

// echo "<br>";
// foreach($nama as $k) {
//     echo $k;
//     echo "<br>";
// }

$nama = array(
    'tejo' => 'surabaya',
    'budi' => 'malang',
    'siti' => 'sidoarjo',
);
var_dump($nama);
echo 'br';
foreach($nama as $k => $v){
    echo $k.'-'.$v;
    echo "<br>";
}
?>