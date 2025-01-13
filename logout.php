<?php
session_start();

// Oturumu sonlandır
session_destroy();

// Oturum değişkenlerini temizle
$_SESSION = array();

// Yönlendirme yap
header("Location: index.php");
exit();
?>
