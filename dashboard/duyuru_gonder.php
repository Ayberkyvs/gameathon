<?php
@include('../php/baglan.php');

// Formdan gelen verileri alın
$baslik = $conn->real_escape_string($_POST["baslik"]);
$icerik = $conn->real_escape_string($_POST["icerik"]);

// Dosya yolu belirleme ve resmi sunucuda kaydetme
$uploadsDirectory = './uploads/';
$uploadedFile = $uploadsDirectory . basename($_FILES['resim']['name']);

if (move_uploaded_file($_FILES['resim']['tmp_name'], $uploadedFile)) {
    // echo "Resim başarıyla sunucuda belirtilen dizine kaydedildi.";
    header("Location: ./index.php");
} else {
    echo "Resim yükleme hatası.";
}

// Şu anki tarihi yyyy-mm-dd formatında alın
$duyuruTarih = date("Y-m-d");

// Resmin dosya yolunu veritabanına kaydetme
$sql = "INSERT INTO duyurular (duyuru_adi, duyuru_icerik, duyuru_resim, duyuru_tarih) VALUES ('$baslik', '$icerik', '$uploadedFile', '$duyuruTarih')";

if ($conn->query($sql) === TRUE) {
    // echo "Yeni kayıt başarıyla oluşturuldu";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
