<?php
session_start();
include("connect.php");

// Kullanıcı oturumu kontrolü
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

// Mevcut ölçüleri veritabanından al
$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($query);

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Yeni ölçüleri al
    $new_oolc = $_POST["new_oolc"];
    $new_golc = $_POST["new_golc"];
    $new_kolc = $_POST["new_kolc"];
    $new_bolc = $_POST["new_bolc"];
    $new_baolc = $_POST["new_baolc"];
    
    // Yeni ölçüleri güncelle
    $update_query = "UPDATE users SET oolc='$new_oolc', golc='$new_golc', kolc='$new_kolc', bolc='$new_bolc', baolc='$new_baolc' WHERE email='$email'";
    if(mysqli_query($conn, $update_query)) {
        // Başarılı güncelleme mesajı
        echo "<script>alert('Ölçüler başarıyla güncellendi');</script>";
        
        // Profil sayfasına yönlendir
        echo "<script>window.location.href = '/Fitness Website/profil.php';</script>";
    } else {
        // Hata mesajı
        echo "<script>alert('Ölçü güncelleme işlemi başarısız oldu');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ölçüleri Güncelle</title>
    <style>
        body {
            background-image: url("https://www.pixel4k.com/wp-content/uploads/2018/10/gym-disks-weight-bodybuilding-4k_1540063069.jpg.webp");
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .profile-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 400px;
            width: 100%;
        }

        .profile-card h2 {
            margin-top: 0;
        }

        .profile-card form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .profile-card label {
            font-weight: bold;
        }

        .profile-card input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .profile-card button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #ee4d2d;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .profile-card button[type="submit"]:hover {
            background-color: #ff6b4d;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-card">
            <h2>Ölçüleri Güncelle</h2>
            <form method="post">
                <label for="new_oolc">Omuz Ölçüsü:</label>
                <input type="text" id="new_oolc" name="new_oolc" value="">
                
                <label for="new_golc">Göğüs Ölçüsü:</label>
                <input type="text" id="new_golc" name="new_golc" value="">
                
                <label for="new_kolc">Kol Ölçüsü:</label>
                <input type="text" id="new_kolc" name="new_kolc" value="">
                
                <label for="new_bolc">Bel Ölçüsü:</label>
                <input type="text" id="new_bolc" name="new_bolc" value="">
                
                <label for="new_baolc">Bacak Ölçüsü:</label>
                <input type="text" id="new_baolc" name="new_baolc" value="">
                
                <button type="submit">Kaydet</button>
            </form>
        </div>
    </div>
</body>
</html>
