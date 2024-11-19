<?php
$sql = "SELECT * FROM product ORDER BY product ASC";
// echo $sql;
$hasil = mysqli_query($koneksi, $sql);
$baris = mysqli_num_rows($hasil);
echo $baris;
if ($baris == 0) {
    echo "<h1>Produk Belum Diisi</h1>";
}
?>
<div class="product">
    <h1>Product</h1>
    <?php
    if ($baris > 0) {
        while ($row = mysqli_fetch_assoc($hasil)) {
    ?>
            <div class="detail-product">
                <h2><?= $row["product"q]; ?></h2>
                <img src="image/<?= $row["gambar"] ?>" alt="">
                <p><?= $row["deskripsi"] ?></p>
                <p><?= $row["stock"] ?></p>
                <p><strong><?= $row["harga"] ?></strong></p>
                <a href="?menu=cart&add= <?= $row["id"] ?>"><button>Buy</button></a>
            </div>
    <?php
        }
    }
    ?>
</div>