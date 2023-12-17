<?php
    // error_reporting(1);
    session_start();    
    $error_message = $_SESSION['error_message'];
    if ($error_message == null){
        $error_message = "Bilinmeyen bir hata meydana geldi!";
    }
?>
<!doctype html>
<html lang="tr">

<!--
██╗░░░██╗░█████╗░██╗░░░██╗░█████╗░░██████╗
╚██╗░██╔╝██╔══██╗██║░░░██║██╔══██╗██╔════╝
░╚████╔╝░███████║╚██╗░██╔╝███████║╚█████╗░
░░╚██╔╝░░██╔══██║░╚████╔╝░██╔══██║░╚═══██╗
░░░██║░░░██║░░██║░░╚██╔╝░░██║░░██║██████╔╝
░░░╚═╝░░░╚═╝░░╚═╝░░░╚═╝░░░╚═╝░░╚═╝╚═════╝░
Unauthorized and misuse of codes is prohibited.
All Rights Reserved.
https://ayberkyavas.com
-->

<head>
    <meta name="theme-color" content="#004a8c" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hata Oluştu! | İzmir Ekonomi Üniversite</title>
     <meta http-equiv="refresh" content="10;url=basvuru.php">
    <meta name="description" content="İzmir Ekonomi Üniversitesi etkinlik başvuru sayfası ve
        hakkında ki genel bilgiler bu sayfalarda yer almaktadır.">
    <meta name="author" content="ayberk yavas" />
    <meta name="keywords" content="izmir,ekonomi,basvuru,gamejam,üniversite,ieu">
    <link rel="stylesheet" href="scss/basarili.css" />
    <link rel="icon" type="image/x-icon" href="/img/header/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <!-- FONT ICIN -->
    <link href='https://fonts.googleapis.com/css?family=Jost&display=swap' rel='stylesheet'>
    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/ec613c6134.js" crossorigin="anonymous"></script>
    <script src="node_modules/jQuery/tmp/jquery.js"></script>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#004a8c">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#000000">
</head>

<body>

    <!--================ Loader Başlangıç =================-->
    <div id="loader">
        <img src="img/loader/loading.png" alt="Loader Logo">
    </div>
    <!--================ Loader Bitiş =================-->

    <!--================ Scrolldown Başlangıç =================-->
    <!-- 
  <div id="scrolldown">

  </div> -->

    <!--================ Scrolldown Bitiş =================-->

    <!-- ================ Demo Başlangıç =================-->

    <!-- <div id="demo-div" class="rainbow">
    <div id="inner-div">
      <div class="social-links">
        <a href="https://www.instagram.com/ieumyo/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
        <a href="https://www.youtube.com/channel/UCURWfZ-wenSrGEBgLWSViVQ" target="_blank"><i
            class="fa-brands fa-youtube"></i></a>
      </div>
    </div>
  </div> -->

    <!--================ Demo Bitiş ================= -->

    <!--================ Header Başlangıç =================-->

    <header>
        <div class="header altKenarHareket">
            <div class="inner-header">
                <div id="main-logo-wrapper" class="main-logo-wrapper üstKenarHareket">
                    <img src="img/logo/wrapperLogo.png" id="mainLogoWrapper">
                    <a href="index.php" style="text-decoration: none; color: black; cursor: pointer;">
                        <img id="mainLogo" src="img/logo/innerLogo.png" alt="Logo"></a>
                </div>
                <input class="menu-btn" type="checkbox" id="menu-btn" />
                <label class="menu-icon" for="menu-btn"><span class="nav-icon"></span></label>
                <ul class="menu">
                    <li><a data-scroll href="index.php" style="text-transform:uppercase">Duyurular</a></li>
                    <li><a data-scroll href="index.php" style="text-transform:uppercase">Sponsorlar</a></li>
                    <li><a href="https://vs.ieu.edu.tr/cp/tr" target="_blank"
                            style="text-transform:uppercase">IEUMYO</a></li>
                </ul>
                <a href="basvuru.php"><button class="btnBasvur"><i class="fa-solid fa-plus"></i> <span>Hemen
                            Katıl!</span></button></a>
            </div>
        </div>
    </header>

    <!--================ Header Bitiş =================-->

    <!--================ Main Alanı Başlangıç =================-->

    <main>
        <div class="main-container">
            <div class="inner-main-container">
                <?php
                echo '<h6 class="errorMessage">' . $error_message . '</h6>';
                session_destroy();
                ?>
                <!--================ Başarılı Alanı Başlangıç =================-->
                <div class="img-container"><img src="img/success/tryagain.png" alt="Tekrar Deneyin"></div>
                <!--================ Başarılı Alanı Bitiş =================-->
            </div>
        </div>
    </main>
    <!--================ Main Alanı Bitiş =================-->

    <!--================ Footer Alanı Başlangıç =================-->

    <footer>
        <div class="footer-container">
            <div class="footer-col1">
                <h2>İzmir Ekonomi Üniversitesi</h2>
                <a href="https://www.izto.org.tr/tr/" target="_blank">
                    <img src="img/svg/izto.png" alt="İzmir Ticaret Odası"></a>
                <h2>İzmir Ticaret Odası Eğitim ve Sağlık Vakfı</h2>
                <a href="https://iztovakfi.org/" target="_blank">
                    <img src="img/svg/iztosaglik.png" alt="İzmir Ticaret Odası"></a>
                <h2>kuruluşudur.</h2>
            </div>

            <div class="footer-col2">
                <div class="footer-col2-mg1">
                    <img src="img/svg/footer-logo-tr.png" alt="İzmir Ekonomi Üniversitesi Logosu">
                    <h2>Sakarya Caddesi No:156 <br>35330 Balçova - İzmir / TÜRKİYE</h2>
                </div>

                <hr class="vertical-line">

                <div class="footer-col2-mg2">
                    <img src="img/svg/gameathonLogo.png" alt="Gameathon Logosu">
                    <ul>
                        <li><a href="https://www.ieu.edu.tr/tr/tarihce" target="_self">Üniversite</a></li>
                        <li><a href="https://www.ieu.edu.tr/tr/ieude-hayat" target="_self">Kampüs</a></li>
                        <li><a href="https://www.ieu.edu.tr/international/en" target="_self">Uluslararası</a></li>
                        <li><a href="https://www.ieu.edu.tr/tr/iletisim" target="_self">İletişim</a></li>
                    </ul>
                </div>

                <hr class="vertical-line">

                <div class="footer-col2-mg3">
                    <img src="img/svg/kampusizmir.png" alt="Kampüs İzmir">
                    <h2>Bizi Takip Edin</h2>
                    <div class="social-logos">
                        <a href="https://www.instagram.com/ieumyo/" target="_blank" class="fa fa-instagram"
                            aria-hidden="true"></a>
                        <a href="https://www.youtube.com/channel/UCURWfZ-wenSrGEBgLWSViVQ" target="_blank"
                            class="fa fa-youtube" aria-hidden="true"></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!--================ Footer Alanı Bitiş =================-->
    <script src="js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>