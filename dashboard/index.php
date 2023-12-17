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
  Thanks to Berke Mutlu
  -->

<?php
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: ../php/admin.php");
    exit;
}
@include('./variables.php');
@include('./lastgroup.php');
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard | Gameathon </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- BRUUUUH -->
  <link rel="stylesheet" href="style.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://kit.fontawesome.com/ec613c6134.js" crossorigin="anonymous"></script>

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#004a8c">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#000000">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="./index.php" class="nav-link">Ana Sayfa</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="./groups.php" class="nav-link">Tüm Gruplar</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="./duyurular.php" class="nav-link">Duyurular</a>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Bildirim</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 Yeni Mesaj
              <span class="float-right text-muted text-sm">3 Dakika</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 Yeni Katılımcı
              <span class="float-right text-muted text-sm">12 Saat</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 Yeni Grup
              <span class="float-right text-muted text-sm">2 Gün</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">Tüm Bildirimleri Oku</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../index.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">Gameathon</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo "$username" ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview menu-open">
              <a href="./index.php" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./index.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ana Sayfa</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./groups.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tüm Gruplar</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./duyurular.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Duyurular<span class="right badge badge-danger">Yeni</span></p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="../php/logout.php" class="nav-link">
                <i class="fa-solid fa-right-from-bracket" style="margin-right: 5px;"></i>
                <p>Çıkış Yap</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Ana Sayfa</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Ana Sayfa</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php echo "$ogrenciSayi" ?></h3>

                  <p>Öğrenci Kaydı</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="./index.php" class="small-box-footer">Yenile <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo "$grupSayi" ?></h3>

                  <p>Grup Sayısı</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="./index.php" class="small-box-footer">Yenile <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?php echo "$okulSayi" ?></h3>

                  <p>Okul</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="./index.php" class="small-box-footer">Yenile <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?php echo "$duyuruSayi" ?></h3>

                  <p>Duyuru</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="./index.php" class="small-box-footer">Yenile <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
                <!-- /.row -->
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i> Katılımcılar</h3>

                    <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Ad Soyad</th>
                          <th>TC</th>
                          <th>Telefon</th>
                          <th>Eposta</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      @include('../php/baglan.php');

                      $sql = "SELECT ogrenciler.ogrenci_id AS 'ID', ogrenciler.ogr_ad AS 'Ad', ogrenciler.ogr_soyad AS 'Soyad', ogrenciler.ogr_tc AS 'TC', ogrenciler.ogr_tel AS 'Telefon', ogrenciler.ogr_mail AS 'Eposta'
                      FROM ogrenciler";

                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                              echo "<tr>";
                              echo "<td>" . $row['ID'] . "</td>";
                              echo "<td>" . $row['Ad'] . ' ' . $row['Soyad'] . "</td>";
                              echo "<td>" . $row['TC'] . "</td>";
                              echo "<td>" . $row['Telefon'] . "</td>";
                              echo "<td>" . $row['Eposta'] . "</td>";
                              echo "</tr>";
                          }
                      } else {
                          echo '<div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <h5><i class="icon fas fa-ban"></i> Uyarı</h5>
                          Şu an gördüğünüz bu mesajın nedeni, veritabanında henüz öğrenci kaydı bulunmamasıdır. Eğer veritabanı verilerinizin varlığından emin değilseniz, lütfen kodları değiştirmeden önce dikkatli bir şekilde kontrol ediniz. İlk dönemdeki iki JavaScript kodu hakkında yaşadığımız sorunları hatırlayarak bu mesajı gönderiyoruz. :)
                        </div>';
                      }

                      $conn->close();
                      ?>


                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>
            <!-- /.row -->

            </section>

            <section class="col-lg-5 connectedSortable">
              <!-- TO DO List -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    Bilgi Paneli
                  </h3>

                  <div class="card-tools">
                    <ul class="pagination pagination-sm">
                    </ul>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                <!-- En son katılan grup-->
                <div class="callout callout-success">
                  <h5><strong><?php echo "$grupAdi" ?></strong></h5>

                  <p>en son katılan grup oldu.</p>
                </div>
                <!-- AAA aramızda kimler var -->
                <div class="callout callout-info">
                <h5><strong><?php echo $ogrAd . ' ' . $ogrSoyad?></strong>'da</h5>

                <p> Katılımcı olarak aramızda başarılar diliyoruz!</p>
                </div>
                <!-- En son duyuru -->
                <div class="callout callout-warning">
                <h5><strong><?php echo $duyuruAd ?></strong></h5>

                <p>Başlıklı duyurunuz yayında!</p>
                </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                </div>
              </div>
            </section>

            <section class="col-lg-7 connectedSortable">
              <!-- general form elements -->
              <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title">Duyuru Paylaş</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="./duyuru_gonder.php" enctype="multipart/form-data">
                  <div class="card-body">
                    <div div class="form-group">
                      <label for="exampleInputEmail1">Başlık Giriniz.</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Başlık" minlength="3" name="baslik" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPasswordi">İçerik Giriniz.</label>
                      <textarea class="form-control" rows="3" placeholder="İçeriği Yazınız" minlength="20" maxlength="300" name="icerik" required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Banner Alanı</label>
                    <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="resim" required>
                        <label class="custom-file-label" for="exampleInputFile">Dosya Seçiniz</label>
                    </div>  
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-warning">Gönder</button>
        </div>
    </form>
              </div>
              <!-- /.card -->
            </section>
            <section class="col-lg-5 connectedSortable">
            </section>
            <!-- right col -->
          </div>
          <!-- /.row (main row) -->
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2023-2024 <a href="http://www.ayberkyavas.com" target="_blank">Ayberk Yavaş</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Thanks to</b> <a href="#">Berke Mutlu</a>
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- To do Listesi için -->
  <script src="./js/app.js?v=0.1"></script>
</body>

</html>