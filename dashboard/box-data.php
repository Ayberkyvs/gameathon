<?php
session_start();
@include('../php/baglan.php');

function getCountAndSetSession($conn, $table, $sessionKey) {
    $sql = "SELECT COUNT(*) AS count FROM $table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION[$sessionKey] = $row["count"];
    } else {
        $_SESSION[$sessionKey] = 0;
        echo "Veri bulunamadı veya sorgu hatası oluştu.";
    }
}

// Öğrenciler tablosu için işlem
getCountAndSetSession($conn, 'ogrenciler', 'ogrenciSayi');

// Gruplar tablosu için işlem
getCountAndSetSession($conn, 'gruplar', 'grupSayi');

// Okullar tablosu için işlem
getCountAndSetSession($conn, 'okullar', 'okulSayi');

// Duyurular tablosu için işlem
getCountAndSetSession($conn, 'duyurular', 'duyuruSayi');

// Bağlantıyı kapat
$conn->close();
?>
