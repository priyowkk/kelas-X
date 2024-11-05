<?php
$sql = "SELECT * FROM about";
$hasil = mysqli_query($koneksi, $sql);
while ($row = mysqli_fetch_array($hasil)) {
?>

    <div class="about">
        <h2><?= $row[1] ?></h2>
        <p><?=$row[2] ?></p>
    </div>
<?php
}
?>