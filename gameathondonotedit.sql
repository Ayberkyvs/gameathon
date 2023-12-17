
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `gameathon`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `adminler`
--

CREATE TABLE `adminler` (
  `admin_id` int(11) NOT NULL,
  `admin_kadi` varchar(255) NOT NULL,
  `admin_sifre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `adminler`
--

-- Kullanıcı adı sadece harflerden oluşmak zorundadır. Büyük küçük harf serbest
-- Şifre Belirlerken ', ", null, ?, / gibi karakterler yasaktır. '
INSERT INTO `adminler` (`admin_id`, `admin_kadi`, `admin_sifre`) VALUES
(1, 'admin', 'turgay1225');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `duyurular`
--

CREATE TABLE `duyurular` (
  `duyuru_id` int(11) NOT NULL,
  `duyuru_adi` varchar(255) NOT NULL,
  `duyuru_icerik` text NOT NULL,
  `duyuru_resim` varchar(255) DEFAULT './uploads/null.png',
  `duyuru_tarih` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `duyurular`
--

INSERT INTO `duyurular` (`duyuru_id`, `duyuru_adi`, `duyuru_icerik`, `duyuru_resim`, `duyuru_tarih`) VALUES
(1, 'Başarılı!', 'Bu mesajı görmekteyseniz veri tabanı kodları başarıyla import edilmiştir ve gameathon websitesinin admin paneli büyük olasılıkla çalışmaya hazırdır. Bu alana 400x300 fotoğraflar yüklenmelidir. Yüklemeyi Dashboard üzerinden yapabilirsiniz. Hemen keşfedin!', './uploads/tebrikler.png', '1923-10-29');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gruplar`
--

CREATE TABLE `gruplar` (
  `grup_id` int(11) NOT NULL,
  `okul_id` int(11) DEFAULT NULL,
  `grup_olusturulma_tarihi` date DEFAULT NULL,
  `grup_adi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `gruplar`
--


-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenciler`
--

CREATE TABLE `ogrenciler` (
  `ogrenci_id` int(11) NOT NULL,
  `ogr_ad` varchar(50) NOT NULL,
  `ogr_soyad` varchar(50) NOT NULL,
  `ogr_tc` varchar(11) NOT NULL,
  `ogr_tel` varchar(15) NOT NULL,
  `ogr_mail` varchar(255) NOT NULL,
  `grup_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `ogrenciler`
--


-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `okullar`
--

CREATE TABLE `okullar` (
  `okul_id` int(11) NOT NULL,
  `okul_adi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `okullar`
--

INSERT INTO `okullar` (`okul_id`, `okul_adi`) VALUES
(1, 'Arkas Narlıdere MTAL'),
(2, 'Mazhar Zorlu MTAL'),
(3, 'Nevvar Salih İşgören MTAL'),
(4, 'Göztepe MTAL'),
(5, 'Mithatpaşa MTAL'),
(6, 'Karabağlar Atatürk MTAL'),
(7, 'Ito Vakfi Süleyman Taştekin MTAL');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `adminler`
--
ALTER TABLE `adminler`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_kadi` (`admin_kadi`);

--
-- Tablo için indeksler `duyurular`
--
ALTER TABLE `duyurular`
  ADD PRIMARY KEY (`duyuru_id`);

--
-- Tablo için indeksler `gruplar`
--
ALTER TABLE `gruplar`
  ADD PRIMARY KEY (`grup_id`),
  ADD KEY `okul_id` (`okul_id`);

--
-- Tablo için indeksler `ogrenciler`
--
ALTER TABLE `ogrenciler`
  ADD PRIMARY KEY (`ogrenci_id`),
  ADD UNIQUE KEY `ogr_tc` (`ogr_tc`),
  ADD UNIQUE KEY `ogr_tel` (`ogr_tel`),
  ADD UNIQUE KEY `ogr_mail` (`ogr_mail`),
  ADD KEY `grup_id` (`grup_id`);

--
-- Tablo için indeksler `okullar`
--
ALTER TABLE `okullar`
  ADD PRIMARY KEY (`okul_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `adminler`
--
ALTER TABLE `adminler`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `duyurular`
--
ALTER TABLE `duyurular`
  MODIFY `duyuru_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `gruplar`
--
ALTER TABLE `gruplar`
  MODIFY `grup_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ogrenciler`
--
ALTER TABLE `ogrenciler`
  MODIFY `ogrenci_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `okullar`
--
ALTER TABLE `okullar`
  MODIFY `okul_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `gruplar`
--
ALTER TABLE `gruplar`
  ADD CONSTRAINT `Gruplar_ibfk_1` FOREIGN KEY (`okul_id`) REFERENCES `okullar` (`okul_id`);

--
-- Tablo kısıtlamaları `ogrenciler`
--
ALTER TABLE `ogrenciler`
  ADD CONSTRAINT `ogrenciler_ibfk_1` FOREIGN KEY (`grup_id`) REFERENCES `gruplar` (`grup_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
