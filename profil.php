<?php
session_start();
include("connect.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Sayfası</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            background-image: url("https://www.pixel4k.com/wp-content/uploads/2018/10/gym-disks-weight-bodybuilding-4k_1540063069.jpg.webp");
            background-color: aliceblue;
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            background-size: cover;
        }
        .container {
            width: 90%;
            max-width: 600px;
            margin: auto;
            text-align: center;
            margin-top: 110px;
        }
        .profile-card {
            background-color: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            margin: auto;
            transition: transform 0.3s ease;
        }
        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }
        .profile-info {
            text-align: left;
            margin-bottom: 20px;
        }
        .profile-info p {
            font-size: 20px;
            margin: 15px 0;
            color: #333;
            border-left: 5px solid #ee4d2d;
            padding-left: 15px;
        }
        .logout-link, .home-link {
            text-decoration: none;
            color: #ee4d2d;
            font-size: 18px;
            margin-top: 20px;
            transition: color 0.3s ease;
            display: inline-block;
            padding: 10px 20px;
            background-color: #fff;
            border-radius: 30px;
            border: 2px solid #ee4d2d;
        }
        .logout-link:hover, .home-link:hover {
            color: #fff;
            background-color: #ee4d2d;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-card">
            <?php 
            if(isset($_SESSION['email'])){
                $email=$_SESSION['email'];
                $query=mysqli_query($conn, "SELECT users.* FROM `users` WHERE users.email='$email'");
                while($row=mysqli_fetch_array($query)){
                    echo "<div class='profile-info'>";
                    echo" <h2>Kullanıcı bilgileri</h2>";
                    echo "<p><strong>Ad:</strong> " . $row['firstName'] . "</p>";
                    echo "<p><strong>Soyad:</strong> " . $row['lastName'] . "</p>";
                    echo "<p><strong>E-posta:</strong> " . $row['email'] . "</p>";
                    echo "<h3>Ölçüleriniz</h3>";
                    echo "<p><strong>Omuz Ölçüsü:</strong> " . $row['oolc'] . "</p>";
                    echo "<p><strong>Göğüs Ölçüsü:</strong> " . $row['golc'] . "</p>";
                    echo "<p><strong>Kol Ölçüsü:</strong> " . $row['kolc'] . "</p>";
                    echo "<p><strong>Bel Ölçüsü:</strong> " . $row['bolc'] . "</p>";
                    echo "<p><strong>Bacak Ölçüsü:</strong> " . $row['baolc'] . "</p>";
                    echo "</div>";
                }
            }
            ?>
            <a class="home-link" href="index.php">Ana Sayfa</a>
            <a class="logout-link" href="update_measurements.php">Ölçüleri Güncelle</a>
            <a class="logout-link" href="logout.php">Çıkış Yap</a>
            
            
        </div>
    </div>
</body>
</html>
