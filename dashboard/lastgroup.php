<?php
session_start();
@include('../php/baglan.php');

$query = "SELECT grup_adi FROM gruplar ORDER BY grup_id DESC LIMIT 1";

$result = $conn->query($query);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $grupAdi = $row['grup_adi'];

        $_SESSION['grupAdi'] = $grupAdi;

        $result->free();
    } else {
        $grupAdi = "-";

        $_SESSION['grupAdi'] = $grupAdi;

        $result->free();
    }
} else {
    echo "Sorgu hatası: " . $conn->error;
}

$query = "SELECT ogr_ad, ogr_soyad FROM ogrenciler ORDER BY RAND() LIMIT 1";

$result = $conn->query($query);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ogrAd = $row['ogr_ad'];
        $ogrSoyad = $row['ogr_soyad'];

        $_SESSION['ogrAd'] = $ogrAd;
        $_SESSION['ogrSoyad'] = $ogrSoyad;

        $result->free();
    } else {
        $ogrAd = "-";
        $ogrSoyad = "-";

        $_SESSION['ogrAd'] = $ogrAd;
        $_SESSION['ogrSoyad'] = $ogrSoyad;

        $result->free();
    }
} else {
    echo "Sorgu hatası: " . $conn->error;
}

$query = "SELECT duyuru_adi FROM duyurular ORDER BY duyuru_id DESC LIMIT 1";

$result = $conn->query($query);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $duyuruAd = $row['duyuru_adi'];

        $_SESSION['duyuruAd'] =  $duyuruAd;

        $result->free();
    } else {
        $duyuruAd = "-";
        $_SESSION['duyuruAd'] =  $duyuruAd;
        $result->free();
    }
} else {
    echo "Sorgu hatası: " . $conn->error;
}

$conn->close();
?>
