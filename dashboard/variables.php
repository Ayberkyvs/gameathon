<?php
require_once('./box-data.php');
session_start();
// Login Verisi - index.php'den geliyor
$username = $_SESSION['username'];
// ---------------------------------------

// Box'lar için data - box-data.php'den geliyor.
$ogrenciSayi = $_SESSION['ogrenciSayi'];
$grupSayi = $_SESSION['grupSayi'];
$okulSayi = $_SESSION['okulSayi'];
$duyuruSayi = $_SESSION['duyuruSayi'];
?>
