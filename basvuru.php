<?php
session_start();
@include ('php/baglan.php');

$groupID = null;

$conn->begin_transaction();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedSchool = $_POST["selectSchool"];
    $group = $_POST["createGroup"];

    $sql = "INSERT INTO gruplar (okul_id, grup_olusturulma_tarihi, grup_adi) VALUES (?, NOW(), ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $selectedSchool, $group);
    $stmt->execute();

    if ($stmt->errno == 1062) {
        echo "Eklemeye Çalıştığınız veri daha önce eklenmiş.";
    } else {
        $groupID = $stmt->insert_id;

        $error = false;
        $errorMessage = 'Bilinmeyen bir hata oluştu!';
        $minStudents = 2; // Minimum öğrenci sayısı
        $maxStudents = 4; // Maksimum öğrenci sayısı
        $studentCount = 0; // Öğrenci sayısını takip etmek için değişken

        for ($i = 0; $i < 4; $i++) {
            $ad = $_POST["ad" . $i];
            $soyad = $_POST["soyad" . $i];
            $kimlikno = $_POST["kimlikno" . $i];
            $email = $_POST["email" . $i];
            $telefon = $_POST["telefon" . $i];

            // Sadece dolu olan alanları işle
            if (!empty($ad) && !empty($soyad) && !empty($kimlikno) && !empty($email) && !empty($telefon)) {
                // E-posta kontrolü
                if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                    // Cep telefonu kontrolü
                    if (preg_match('/^(\d{3})(\d{3})(\d{2})(\d{2})$/', $telefon)) {
                        // TC kimlik numarası kontrolü
                        if (validateTC($kimlikno)) {
                            $studentCount++;
                            $sql = "INSERT INTO ogrenciler (ogr_ad, ogr_soyad, ogr_tc, ogr_tel, ogr_mail, grup_id) VALUES (?, ?, ?, ?, ?, ?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("sssssi", $ad, $soyad, $kimlikno, $telefon, $email, $groupID);

                            if (!$stmt->execute()) {
                                $errorMessage = "Girdiğiniz bir veri kayıtlarımızda zaten mevcut!";
                                $error = true;
                                break;
                            }
                        } else {
                            $errorMessage = "Lütfen geçerli bir TC kimlik numarası girin. (11 haneli bir sayı)";
                            $error = true;
                            break;
                        }
                    } else {
                        $errorMessage = "Lütfen geçerli bir cep telefonu numarası girin. Örnek: 5XXXXXXXXX";
                        $error = true;
                        break;
                    }
                } else {
                    $errorMessage =  "Lütfen geçerli bir e-posta adresi girin.";
                    $error = true;
                    break;
                }
            }
        }

        if ($error || $studentCount < $minStudents || $studentCount > $maxStudents) {
            $conn->rollback();
            if($errorMessage == ""){
                $errorMessage = "Katılımcılar " . $studentCount . " fazla ". $minStudents . " az olamaz.";
            }
            $_SESSION['error_message'] = $errorMessage;
            header("Location: error.php");
        } else {
            $conn->commit();
            header("Location: success.php");
        }
    }
}

// function sendEmail($person){
//   echo $person[0], $person[1], $person[2], $person[3];
// }

$conn->close();


function validateTC($tc) {
    // TC kimlik numarasının uzunluğunu kontrol et (11 haneli olmalı)
    if (strlen($tc) != 11) {
        return false;
    }

    // TC kimlik numarası algoritmasını kullanarak doğruluğunu kontrol et
    $tc = str_split($tc);
    $total = 0;
    for ($i = 0; $i < 10; $i++) {
        $total += $tc[$i];
    }
    if (($total % 10) == $tc[10]) {
        return true;
    } else {
        return false;
    }
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
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Hemen Katıl | İzmir Ekonomi Üniversite</title>
  <meta name="description" content="İzmir Ekonomi Üniversitesi etkinlik başvuru sayfası ve
        hakkında ki genel bilgiler bu sayfalarda yer almaktadır.">
  <meta name="author" content="ayberk yavas" />
  <meta name="keywords" content="izmir,ekonomi,basvuru,gamejam,üniversite,ieu">
  <link rel="stylesheet" href="scss/application.css" />
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
  <!-- <div id="loader">
    <img src="img/loader/loading.png" alt="Loader Logo">
  </div> -->
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
          <li><a href="https://vs.ieu.edu.tr/cp/tr" target="_blank" style="text-transform:uppercase">IEUMYO</a></li>
        </ul>
        <!-- <a href="basvuru.html"><button class="btnBasvur"><i class="fa-solid fa-plus"></i> <span>Hemen
              Katıl!</span></button></a> -->
      </div>
    </div>
  </header>

  <!--================ Header Bitiş =================-->

  <!--================ Main Alanı Başlangıç =================-->
  <main class="main-container">
    <form action="basvuru.php" method="POST" class="application-form" id="application-form" novalidate>
      <!-- Başvuru Banner Fotoğrafı -->
      <div class="card mb-4 banner">
        <img src="img/basvuru/gameathon_banner.jpg" class="card-img-top banner-image" alt="Banner Image">
      </div>

      <!-- Başvuru Başlığı -->
      <div class="card mb-4">
        <div class="card-header"></div>
        <div class="card-body">
          <h5 class="card-title" style="font-size: 20px;">Gameathon Başvuru Formu</h5>
          <p class="card-text">Bu başvuru formunda grup oluşturacaksınız. Grupta maksimum 4, minimum 2 kişi olabilir. Her üyenin
            bilgilerini başvuru yapan kişi dolduracaktır.</p>
          <p class="card-text"><small class="text-muted">Etkinlik Zamanı : 22-23 Aralık</small></p>
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-body">
          <label for="selectSchool" class="form-label">Okul Seçiniz *</label>
          <select class="form-select selectSchool" aria-label="selectSchool" name="selectSchool" required>
            <option selected class="form-select-option" value="0">
              Lütfen Okulunuzu Seçin
            </option>
            <?php
              @include('php/baglan.php');
              $sql = "SELECT okul_id, okul_adi FROM okullar";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo '<option value="' . $row["okul_id"] . '" class="form-select-option">' . $row["okul_adi"] . '</option>';
                }
              } else {
                echo "Okul bulunamadı";
              }
              $conn->close();
              ?>
          </select>
        </div>
      </div>

      <div class="card mb-4 group-container" style="display: none;">
        <div class="card-body">
          <label for="createGroup" class="form-label">Grubunuzun Adı *</label>
          <input type="text" class="form-control" id="createGroup" name="createGroup" placeholder="DevOps Grubu"
            maxlength="30" minlength="3" required>
          <div class="groupAvailabilityMessage" style="color: red;"></div>
      </div>
    </div>


      <div class="card mb-4 user-container" style="display: none;">
        <div class="card-body user-form-container">
          <h3 class="form-label" style="font-weight: 400;">Katılımcıları Ekleyin *</h3>
          <div class="userList"></div>
          <button type="button" class="btn btn-success btn-addUser"><i class="fa-solid fa-plus"></i> Katılımcı
            Ekleyin</button>

          <!-- <div class="alert alert-primary d-flex align-items-center justify-content-between" role="alert">
            <div class="d-flex align-items-center">
              <i class="fa-solid fa-user"></i>
              <div style="margin-left: 10px; text-transform: uppercase;">
                Ayberk Yavas
              </div>
            </div>
            <div>
              <i class="fa-solid fa-pen-to-square editUser" style="cursor:pointer"></i>
              <i class="fa-solid fa-trash deleteUser" style="cursor:pointer"></i>
            </div>
          </div> -->
        </div>
      </div>

      <div class="card mb-4 align-items-center justify-content-center submit-container" style="display: none;">
        <div class="card-body" style="width: 100%;">
        <div class="sartname-container">
          <input type="checkbox" class="inputSartname" id="inputSartname" name="sartname" value="yes" required>
          <label class="labelSartname" for="sartname"> <a href="gameathon_sartname.pdf" target="_blank"> Şartname </a>'yi okudum ve anladım.</label><br>
            </div>
          <button type="submit" class="btn btn-outline-dark btnSubmit" style="width: 100%;">Kaydınızı
            Tamamlayın</button>
        </div>
      </div>
    </form>
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
          <img src="img/svg/kampusizmir.png">
          <h2>Bizi Takip Edin</h2>
          <div class="social-logos">
            <a href="#" class="fa fa-instagram"></a>
            <a href="#" class="fa fa-youtube"></a>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!--================ Footer Alanı Bitiş =================-->

  <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/control.js"></script>
  <script src="js/kaydol.js?v=1.0"></script>
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