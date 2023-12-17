<?php
@include('baglan.php');


// Duyuruları çekmek için SQL sorgusu
$sql = "SELECT duyuru_id, duyuru_adi, duyuru_icerik, duyuru_resim, duyuru_tarih FROM duyurular";

// Sorguyu çalıştır
$result = $conn->query($sql);

// Sorgu sonuçlarını JSON dizisine çevir
$duyurular = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $duyurular[] = $row;
    }
}

// JSON formatına çevir
$jsonDuyurular = json_encode($duyurular);
// JavaScript dosyasına JSON verisini yaz
$jsonFilePath = "js/data/duyurular.json";
file_put_contents($jsonFilePath, $jsonDuyurular);



// Veritabanı bağlantısını kapat
$conn->close();
?>