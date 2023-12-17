// JSON verilerini yükleme
fetch("js/data/duyurular.json")
  .then(function (response) {
    if (response.status !== 200) {
      console.error(
        "Veri yüklenirken bir hata oluştu. Durum Kodu: " + response.status
      );
      return;
    }

    response.json().then(function (data) {
      processData(data);
    });
  })
  .catch(function (error) {
    console.error("Veri yükleme hatası:", error);
  });

// JSON verilerini işler ve teker teker metoda gönderir
function processData(data) {
  console.log(data);
  if (!(data.length > 0)) {
    createError();
  }
  if (Array.isArray(data)) {
    data.forEach(function (duyuru) {
      handleDuyuru(duyuru);
    });
  }
}

function createError() {
  const cardDiv = document.createElement("div");
  cardDiv.className = "alert alert-danger ann-danger";
  cardDiv.setAttribute("role", "alert");
  cardDiv.textContent = "Veri Bulunamadı! Lütfen daha sonra tekrar deneyin.";

  const container = document.querySelector(".announcement-container");
  container.appendChild(cardDiv);
}

function handleDuyuru(duyuru) {
  // Burada duyuru verilerini kullanabilirsiniz
  const duyuruID = duyuru.duyuru_id;
  const duyuruAdi = duyuru.duyuru_adi;
  const duyuruIcerik = duyuru.duyuru_icerik;
  const duyuruResim = duyuru.duyuru_resim;
  const duyuruTarih = duyuru.duyuru_tarih;

  // Örnek: Duyuru adını konsola yazdırma
  console.log(
    "Duyuru Adı: " +
      duyuruID +
      duyuruAdi +
      duyuruIcerik +
      duyuruResim +
      duyuruTarih
  );
  ekranaYaz(duyuruAdi, duyuruIcerik, duyuruResim, duyuruTarih);
}

function ekranaYaz(duyuruAdi, duyuruIcerik, duyuruResim, duyuruTarih) {
  // Yeni bir div elementi oluştur
  const cardDiv = document.createElement("div");
  cardDiv.className = "card";

  const imageContainer = document.createElement("div");
  imageContainer.className = "image-container";
  // İmg elementi oluştur ve özelliklerini ayarla
  const img = document.createElement("img");
  img.src = `dashboard/${duyuruResim}`;
  img.className = "card-img-top";
  img.alt = `${duyuruResim}`;

  // İç içe geçmiş div elementlerini oluştur
  const cardInnerDiv = document.createElement("div");
  cardInnerDiv.className = "card-inner";

  const cardHeaderDiv = document.createElement("div");
  cardHeaderDiv.className = "card-header";
  cardHeaderDiv.textContent = `Yayınlanma Tarihi : ${duyuruTarih}`;

  const cardBodyDiv = document.createElement("div");
  cardBodyDiv.className = "card-body";

  const cardTitle = document.createElement("h5");
  cardTitle.className = "card-title";
  cardTitle.textContent = `${duyuruAdi}`;

  const cardText = document.createElement("p");
  cardText.className = "card-text";
  cardText.textContent = `${duyuruIcerik}`;

  //   const link = document.createElement("a");
  //   link.href = "#";
  //   link.className = "btn btn-primary sa";
  //   link.textContent = "Daha Fazla";

  // Elementleri birbirine ekleyin (hiyerarşi oluşturun)
  imageContainer.appendChild(img);
  cardDiv.appendChild(imageContainer);
  cardDiv.appendChild(cardInnerDiv);
  cardInnerDiv.appendChild(cardHeaderDiv);
  cardInnerDiv.appendChild(cardBodyDiv);
  cardBodyDiv.appendChild(cardTitle);
  cardBodyDiv.appendChild(cardText);
  //   cardBodyDiv.appendChild(link);

  // Son olarak, oluşturduğunuz elementi sayfanın bir bölümüne ekleyin (örneğin, bir div'e)
  const container = document.querySelector(".announcement-container"); // Eklenecek container elementini seçin
  container.appendChild(cardDiv);
}
