<?php
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
        $errorMessage = 'bruh';
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
                            // Kullanıcı verilerini öğrenciler tablosuna eklemeye başla
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
            if($errorMessage == null){
                $errorMessage = "Katılımcılar " . $studentCount . " fazla ". $minStudents . " az olamaz.";
            }
            session_start();
            $_SESSION['error_message'] = $errorMessage;
            header("Location: error.php");
        } else {
            $conn->commit();
            header("Location: success.php");
        }
    }
}

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
