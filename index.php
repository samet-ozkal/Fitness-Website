<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="images/x-icon" href="/images/logoshort.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="style.css">
    <title>Fitness Website</title>
    <style>
        .bmi__container {
            margin: 50px auto;
            padding: 20px;
            max-width: 500px;
            background-color: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .bmi__container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .bmi__container form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .bmi__container label {
            margin: 10px 0 5px;
            font-size: 1.1em;
            color: #555;
        }

        .bmi__container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        .bmi__container button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        .bmi__container button:hover {
            background-color: #0056b3;
        }

        .bmi__result__container {
            margin: 50px auto;
            padding: 20px;
            max-width: 500px;
            background-color: #e9ffe9;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .bmi__result__container p {
            margin: 10px 0;
            font-size: 1.1em;
        }

        .bmi__result__container a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        .bmi__result__container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav_logo">
            <a href="#"><img src="images/logo.png" alt="logo"></a>
        </div>
        <ul class="nav_links">
            <li class="link"><a href="#">Ana Sayfa</a></li>
            <li class="link"><a href="#program">Program</a></li>
            <li class="link"><a href="#içerik">İçerik</a></li>
            <li class="link"><a href="#hakkında">İletişim</a></li>
        </ul>

        <?php
        if(isset($_SESSION['email'])) {
          echo '<a href="profil.php"><button class="btn">Kullanıcı Bilgileri</button></a>';
          echo '<a href="logout.php"><button class="btn">Çıkış</button></a>';
        } else {
          echo '<a href="register.html"><button class="btn">Üye Ol</button></a> 
          <a href="login.html"><button class="btn2">Giriş Yap</button></a>';
        }
        ?>
    </nav>
    <header class="section__container header__container">
        <div class="header__content">
            <span class="bg__blur"></span>
            <span class="bg__blur header__blur"></span>
            <h4>BAYBURT'UN GÖZDESİ</h4>
            <h1><span>VÜCUT</span> ŞEKLİNİ DEĞİŞTİR</h1>
            <p>
                Potansiyelini açığa çıkar ve daha güçlü olmak için doğru bir yolculuğa çık.
                Hedefini seç ve o yolda şaşmadan ilerle
                ve vücudunun yapabileceği inanılmaz dönüşüme tanık ol!
            </p>
            <a href="#bmiForm"><button class="btn">Hazırım</button></a>
        </div>
        <div class="header__image">
            <img src="images/header.png" alt="header" />
        </div>
    </header>

    <section class="section__container explore__container">
        <div class="explore__header">
            <h2 class="section__header"><a name="program">ANTRENMAN PROGRAMLARI</a></h2>
        </div>
        <div class="explore__grid">
            <div class="explore__card">
                <span><i class="ri-boxing-fill"></i></span>
                <h4>Kuvvet</h4>
                <p>Estetik bir görünümden ziyade kuvvet odaklı çalışmak istiyorsan bu program tam sana göre.</p>
                <?php
                if(isset($_SESSION['email'])) {
                  echo '<a href="index3.html">Katıl <i class="ri-arrow-right-line"></i></a>';
                } else {
                  echo '<a href="login.html">Katıl <i class="ri-arrow-right-line"></i></a>';
                }
                ?>
            </div>
            <div class="explore__card">
                <span><i class="ri-run-line"></i></span>
                <h4>Yağ Kaybı</h4>
                <p>Yağlarından kurtulmak ve fit bir görünüm elde etmek için daha fazla zaman kaybetme.</p>
                <?php
                if(isset($_SESSION['email'])) {
                  echo '<a href="index4.html">Katıl <i class="ri-arrow-right-line"></i></a>';
                } else {
                  echo '<a href="login.html">Katıl <i class="ri-arrow-right-line"></i></a>';
                }
                ?>
            </div>
            <div class="explore__card">
                <span><i class="ri-heart-pulse-fill"></i></span>
                <h4>Kas Kazanımı</h4>
                <p>Daha estetik bir görünüm, belirgin ve çizgili kaslar için bu zorlu mücadeleye bir an önce başlamalısın.</p>
                <?php
                if(isset($_SESSION['email'])) {
                  echo '<a href="index5.html">Katıl <i class="ri-arrow-right-line"></i></a>';
                } else {
                  echo '<a href="login.html">Katıl <i class="ri-arrow-right-line"></i></a>';
                }
                ?>
            </div>
            <div class="explore__card">
                <span><i class="ri-shopping-basket-fill"></i></span>
                <h4>Gündelik</h4>
                <p>Gün içinde gerekli enerji harcamanı sağlayacak basit, tekrar eden gündelik hareketler.</p>
                <?php
                if(isset($_SESSION['email'])) {
                  echo '<a href="index6.html">Katıl <i class="ri-arrow-right-line"></i></a>';
                } else {
                  echo '<a href="login.html">Katıl <i class="ri-arrow-right-line"></i></a>';
                }
                ?>
            </div>
        </div>
    </section>

    <section class="section__container class__container">
        <div class="class__image">
            <span class="bg__blur"></span>
            <img src="images/sınav.png" alt="class" class="class__img-1" />
            <img src="images/class-2.jpg" alt="class" class="class__img-2" />
        </div>
        <div class="class__content">
            <h2 class="section__header"><a name="içerik">EGZERSİZ İÇERİKLERİ</a></h2>
            <p>
                Burada göreceğiniz egzersizler tamamen hedefleriniz doğrultusunda ilerlemenizi ve hayal ettiğiniz vücuda kavuşmanız için uyarlanmıştır.
                "Ekipmanlı Egzersizler" spor salonlarında veya evinizde bulunan kısıtlı ekipmanlarla yapabileceğiniz hareketler içermektedir.
                "Ekipmansız Egzersizler" ise sizlere evinizde, bahçenizde ve parklarda rahatlıkla hiç bir ekipmana 
                ihtiyaç duymadan yapabileceğiniz antrenmanlar sunmaktadır.
            </p>
            <a href="#program"><button class="btn">Hemen Başla</button></a>
        </div>
    </section>

    <section class="review">
        <div class="section__container review__container">
            <span><i class="ri-double-quotes-r"></i></span>
            <div class="review__content">
                <h4>YORUMLAR</h4>
                <p>
                    Antrenmanlarımı aksatmadan düzenli bir şekilde yerine getirdim ve gelişimimin farkındayım.
                    Böylesine güzel ve etkili egzersizlere ücretsiz ulaşabildiğim için çok şanslıyım.
                    Teşekkürler...
                </p>
                <div class="review__rating">
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                </div>
                <div class="review__footer">
                    <div class="review__member">
                        <img src="images/testo.png" alt="member" />
                        <div class="review__member__details">
                            <h4>Testo Taylan</h4>
                            <p>Vücut Geliştirme</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="section__container footer__container">
        <span class="bg__blur"></span>
        <span class="bg__blur footer__blur"></span>
        <div class="footer__col">
            <div class="footer__logo"><img src="images/logo.png" alt="logo" /></div>
            <p><a name="hakkında">Sayfamı ziyaret edip bana vakit ayırdığın için teşekkürler. Umarım sana yardımcı olabilmişimdir. Sosyal medya hesaplarıma  göz atmayı unutma. Sporla kal !!!</a></p>
            <div class="footer__socials">
                <a href="https://open.spotify.com/intl-tr/artist/3bSXH0fk0ZIcFFetRwmVCe?si=zV8DG-acR2CMz5AP_BTydQ"><i class="ri-spotify-fill"></i></a>
                <a href="https://www.instagram.com/samet.ozkal/?next=%2F"><i class="ri-instagram-line"></i></a>
                <a href="https://www.youtube.com/channel/UCVvsBdLiqrYavloX26Ed4Fg"><i class="ri-youtube-fill"></i></a>
            </div>
        </div>
        <div class="iletisim">
            <h4>GSM</h4>
              <h5>0551 193 23 90</h5>
        </div>
        <div class="mail">
            <h4>E-mail</h4>
              <h5>sametozkal69@gmail.com</h5>
        </div>
    </footer>

    <?php
    if(isset($_SESSION['email'])) {
        echo '
        <section class="section__container bmi__container" id="bmiForm">
            <h2 class="section__header">Vücut Kitle Endeksi (BMI) Hesaplama</h2>
            <form method="POST" action="#bmiResult">
                <label for="height">Boy (cm): </label>
                <input type="number" name="height" id="height" required>
                <label for="weight">Kilo (kg): </label>
                <input type="number" name="weight" id="weight" required>
                <button type="submit" class="btn">Hesapla</button>
            </form>
        </section>
        ';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $height = $_POST['height'];
            $weight = $_POST['weight'];

            $height_m = $height / 100; 
            $bmi = $weight / ($height_m * $height_m);

            echo "<section class='section__container bmi__result__container' id='bmiResult'>";
            echo "<h2 class='section__header'>BMI Sonucunuz: " . round($bmi, 2) . "</h2>";

            if ($bmi < 18.5) {
                echo "<p>Zayıf - Daha fazla kas kazanımı programını öneriyoruz.</p>";
                echo '<a href="index5.html" class="btn">Kas Kazanımı Programına Git</a>';
            } elseif ($bmi >= 18.5 && $bmi < 24.9) {
                echo "<p>Normal - Kuvvet programını öneriyoruz.</p>";
                echo '<a href="index3.html" class="btn">Kuvvet Programına Git</a>';
            } elseif ($bmi >= 25 && $bmi < 29.9) {
                echo "<p>Fazla Kilolu - Yağ kaybı programını öneriyoruz.</p>";
                echo '<a href="index4.html" class="btn">Yağ Kaybı Programına Git</a>';
            } else {
                echo "<p>Obez - Yağ kaybı programını öneriyoruz.</p>";
                echo '<a href="index4.html" class="btn">Yağ Kaybı Programına Git</a>';
            }

            echo "</section>";
        }
    }
    ?>
</body>
</html>
