<?php
session_start();
@include('baglan.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $girilen_kullanici_adi = $_POST["kullanici_adi"];
    $girilen_sifre = $_POST["sifre"];

    if (preg_match("/^[a-zA-Z]+$/", $girilen_kullanici_adi)) {
        if (preg_match("/^[^\s'\"?\/]+$/", $girilen_sifre)) {
            // Şifre sadece belirtilen karakterleri içermez

            $sql = "SELECT * FROM adminler WHERE admin_kadi = '$girilen_kullanici_adi' AND admin_sifre = '$girilen_sifre'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $_SESSION['authenticated'] = true;
                $_SESSION['username'] = $girilen_kullanici_adi;
                header("Location: ../dashboard/index.php");
                exit;
            } else {
                $error_message = "Giriş Başarısız!";
            }
        } else {
            $error_message = "Şifre istenmeyen karakterler içermemelidir.";
        }
    } else {
        $error_message = "Kullanıcı adı sadece harf içermelidir.";
    }
    $conn->close();
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
  <title>Admin | İzmir Ekonomi Üniversite</title>
  <meta name="description" content="İzmir Ekonomi Üniversitesi etkinlik başvuru sayfası ve
        hakkında ki genel bilgiler bu sayfalarda yer almaktadır.">
  <meta name="author" content="ayberk yavas" />
  <meta name="keywords" content="izmir,ekonomi,basvuru,gamejam,üniversite,ieu,gameathon,login">
  <link rel="stylesheet" href="../scss/admin.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
  <!-- FONT ICIN -->
  <link href='https://fonts.googleapis.com/css?family=Jost&display=swap' rel='stylesheet'>
  <!-- FONT AWESOME -->
  <script src="https://kit.fontawesome.com/ec613c6134.js" crossorigin="anonymous"></script>

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
    <img src="../img/loader/loading.png" alt="Loader Logo">
  </div>
  <!--================ Loader Bitiş =================-->

  <!--================ Header Başlangıç =================-->

  <header>
    <div class="header altKenarHareket">
      <div class="inner-header">
        <div id="main-logo-wrapper" class="main-logo-wrapper üstKenarHareket">
          <img src="../img/logo/wrapperLogo.png" id="mainLogoWrapper">
          <a href="../index.php" style="text-decoration: none; color: black; cursor: pointer;">
            <img id="mainLogo" src="../img/logo/innerLogo.png" alt="Logo"></a>
        </div>
        <!-- <input class="menu-btn" type="checkbox" id="menu-btn" /> -->
        <!-- <label class="menu-icon" for="menu-btn"><span class="nav-icon"></span></label> -->
      </div>
    </div>
  </header>

  <!--================ Header Bitiş =================-->

  <!--================ Main Alanı Başlangıç =================-->
  <section class="vh-100" style="background-color: white">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="../img/admin/loginbanner.png" alt="login form" class="img-fluid"
                  style="border-radius: 1rem 0 0 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                  <form method="POST" action="admin.php">
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fa-solid fa-lock"></i>
                      <span class="h6 fw-bold mb-0">Admin Paneli</span>
                    </div>

                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Hesabına Giriş Yap!</h5>

                    <div class="form-outline mb-4">
                      <label class="form-label" for="form2Example17">Kullanıcı Adı</label>
                      <input type="text" id="form2Example17" name="kullanici_adi" class="form-control form-control-lg" />
                    </div>

                    <div class="form-outline mb-4">
                      <label class="form-label" for="form2Example27">Şifre</label>
                      <input type="password" id="form2Example27" name="sifre" class="form-control form-control-lg" />

                    </div>

                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block btn-login" type="submit">Giriş Yap</button>
                      <?php
                      if (isset($error_message)) {
                          echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
                      }
                      ?>
                    </div>

                    <a class="small text-muted" href="#!">Şifremi unuttum</a>
                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Hesabın yok mu? <a href="https://www.instagram.com/ayberksch/" target="_blank"
                        style="color: #393f81;">Buradan kaydol</a></p>
                    <a href="www.ayberkyavas.com" target="_blank" class="small text-muted">© Ayberk Yavas</a>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================ Main Alanı Bitiş =================-->
  <script src="../js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
</body>

</html>