<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

// Form verilerini al
$day = $_POST['day'];
$exerciseName = $_POST['exerciseName'];
$setCount = $_POST['setCount'];

// Dosya yükleme işlemi
$target_dir = "images/egzersiz/";
$target_file = $target_dir . basename($_FILES["exerciseImage"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Dosya mevcut mu kontrol et
if (file_exists($target_file)) {
  echo "Üzgünüz, dosya zaten mevcut.";
  $uploadOk = 0;
}

// Dosya boyutunu kontrol et
if ($_FILES["exerciseImage"]["size"] > 500000) {
  echo "Üzgünüz, dosya çok büyük.";
  $uploadOk = 0;
}

// Dosya türünü kontrol et
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Üzgünüz, sadece JPG, JPEG, PNG & GIF dosyaları yüklenebilir.";
  $uploadOk = 0;
}

// Dosyayı taşı
if ($uploadOk == 0) {
  echo "Üzgünüz, dosyanız yüklenemedi.";
} else {
  if (move_uploaded_file($_FILES["exerciseImage"]["tmp_name"], $target_file)) {
    echo "Dosya başarıyla yüklendi.";
  } else {
    echo "Üzgünüz, dosyayı yüklerken bir hata oluştu.";
  }
}

// Veritabanına bağlan
$conn = new mysqli($servername, $username, $password, $dbname);
// Bağlantıyı kontrol et
if ($conn->connect_error) {
  die("Bağlantı hatası: " . $conn->connect_error);
}

// Veritabanına ekleme sorgusu
$sql = "INSERT INTO exercises7 (day, exerciseName, imagePath, setCount) VALUES ('$day', '$exerciseName', '$target_file', '$setCount')";

if ($conn->query($sql) === TRUE) {
  echo "Egzersiz başarıyla eklendi";
  echo'<script>
  // Sayfanın yüklenmesinden 2 saniye sonra yönlendirme yap
  setTimeout(function() {
      window.location.href = "gün.php";
  }, 2000); // 2 saniye = 2000 milisaniye
</script>';

} else {
  echo "Hata: " . $sql . "<br>" . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();
?>
