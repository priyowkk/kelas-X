<?php

$sekolah = "SMKN 2 Buduran";
$isi = "hari ini saya belajar php";
$materi = "Materi Belajar PHP";
$schools = ["Tk Islam Kharisma", "SDI Sabilil Falah", "MTSN 1 SDA", "SMKN 2 Buduran"];
$adress = [
    "SMKN 2 Buduran",
    "Jl. Jenggolo No.2 A, Bedrek, Siwalanpanji, Kec. Buduran, Kabupaten Sidoarjo, Jawa Timur 61219",
];
$judul = "Kurikulum Vitae";
$hobies = ["Coding", "Gaming", "Editing", "Badminton"];
$skills = ["PHP Expert", "HTML Expert", "C Expert", "Editing Expert"];


$lists = [
    "Variabel",
    "Array",
    "Pengujian",
    "Pengulangan",
    "Function",
    "Class",
    "Object",
    "Framework",
    "PHP and MySql",
];
?>
<html>

<head>
    <title>
        Resume
    </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&amp;display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #6C63FF;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin-top: 10px;
        }

        .container {
            width: 800px;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .left {
            width: 35%;
            background-color: #6C63FF;
            color: #fff;
            padding: 20px;
            box-sizing: border-box;
        }

        .left img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .left h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .left p {
            font-size: 14px;
            margin: 5px 0;
        }

        .left .section {
            margin-bottom: 20px;
        }

        .left .section h3 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .left .section p {
            font-size: 14px;
            margin: 5px 0;
        }

        .right {
            width: 65%;
            padding: 20px;
            box-sizing: border-box;
            position: relative;
        }

        .right h1 {
            font-size: 30px;
            margin-bottom: 5px;
            margin-right: 70px;
            color: purple;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .right h2 {
            font-size: 18px;
            color: black;
            margin-bottom: 20px;
        }

        .right .section {
            margin-bottom: 20px;
        }

        .right .section h3 {
            font-size: 16px;
            margin-bottom: 10px;
            color: #6C63FF;
        }

        .right .section p {
            font-size: 14px;
            margin: 5px 0;
        }

        .right .section .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .right .section .item p {
            margin: 0;
        }

        .right .section .item span {
            font-size: 12px;
            color: #FF6F61;
        }

        .right .section .skills {
            display: flex;
            justify-content: space-between;
        }

        .right .section .skills p {
            width: 48%;
        }

        .right .section .languages {
            display: flex;
            flex-direction: column;
        }

        .right .section .languages p {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .right .section .languages p span {
            width: 50%;
            height: 5px;
            background-color: #FF6F61;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left">
            <img alt="Profile Picture" height="100" src="muka.jpg" width="100" />
            <div class="section">
                <h2>
                    KONTAK
                </h2>
                <p>
                    <i class="fas fa-phone">
                    </i>
                    08662653653
                </p>
                <p>
                    <i class="fas fa-envelope">
                    </i>
                    email@gmail.com
                </p>
                <p>
                    <i class="fas fa-map-marker-alt">
                    </i>
                    <?php echo $adress[1]; ?>
                </p>
            </div>
            <div class="section">
                <h2>
                    PENDIDIKAN
                </h2>
                <p>
                    <?php echo $schools[0]; ?>
                </p>
                <p>
                    <?php echo $schools[1]; ?>
                </p>
                <p>
                    <?php echo $schools[2]; ?>
                </p>
                <p>
                    <?php echo $schools[3]; ?>
                </p>
                <p>
                    2024
                </p>
            </div>
            <div class="section">
                <h2>
                    BAHASA
                </h2>
                <p>
                    Indonesia
                    <span style="width: 80%;">
                    </span>
                </p>
                <p>
                    English
                    <span style="width: 60%;">
                    </span>
                </p>
            </div>
        </div>
        <div class="right">
            <h1>
                <?php echo $judul; ?>
            </h1>
            <h2>
                Priyo Anggodho
            </h2>
            <div class="section">
                <h3>
                    TENTANG SAYA
                </h3>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essent
                </p>
            </div>
            <div class="section">
                <h3>
                    HOBI
                </h3>
                <div class="item">
                    <p>
                        <?php echo $hobies[0] ?>
                    </p>
                </div>
                <p>
                    <?php echo $hobies[1] ?>
                </p>
                <div class="item">
                    <p>
                        <?php echo $hobies[2] ?>
                    </p>
                </div>
                <p>
                    <?php echo $hobies[3] ?>
                </p>
            </div>
            <div class="section">
                <h3>
                    KEMAMPUAN
                </h3>
                <div class="skills">
                    <p>
                        <?php echo $skills[0]; ?>
                    </p>
                    <p>
                        <?php echo $skills[1]; ?>
                    </p>
                </div>
                <div class="skills">
                    <p>
                        <?php echo $skills[2]; ?>
                    </p>
                    <p>
                        <?php echo $skills[3]; ?>
                    </p>
                </div>
            </div>
            <div class="section">
                <h3>
                    SERTIFIKAT
                </h3>
                <div class="item">
                    <p>
                        Google Adword Advanced
                    </p>
                    <span>
                        2020
                    </span>
                </div>
                <div class="item">
                    <p>
                        Mikrotik RouterOS Training
                    </p>
                    <span>
                        2020 - 2021
                    </span>
                </div>
                <div class="item">
                    <p>
                        Certification of Professional Achievement in Data Sciences
                    </p>
                    <span>
                        2010 - 2022
                    </span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>