const addTodoButton = document.querySelector(".addTodoButton");
const addTodoInput = document.querySelector(".addTodoInput");

function run() {
  document.addEventListener("DOMContentLoaded", veriCek);
}

// function veriSil(li, text) {
//   console.log(li, text);
//   removeItem(li);
// }

function veriCek() {
  console.log("çalışıyor");
  fetch("js/data/tododata.json")
    .then(function (response) {
      if (response.status !== 200) {
        console.error(
          "Veri yüklenirken bir hata oluştu. Durum Kodu: " + response.status
        );
        return;
      }

      response.json().then(function (data) {
        console.log(data);
        processData(data);
      });
    })
    .catch(function (error) {
      console.error("Veri yükleme hatası:", error);
    });

  // JSON verilerini işler ve teker teker metoda gönderir
  function processData(data) {
    if (!(data.length > 0)) {
      createError();
    }
    if (Array.isArray(data)) {
      data.forEach(function (data) {
        console.log(data);
        currentDate(data.yap_adi, data.yap_id, data.yap_tarih);
      });
    }
  }
}
function currentDate(yap_adi, yap_id, yap_tarih) {
  const today = new Date();
  const formattedDate = new Date(
    today.getFullYear(),
    today.getMonth(),
    today.getDate()
  );

  console.log("formatlanmış: ", formattedDate);

  const yapTarih = new Date(yap_tarih); // yap_tarih'i Date nesnesine dönüştürün

  console.log("tarih : ", yapTarih);

  const farkMilisaniye = formattedDate - yapTarih;

  const farkGun = farkMilisaniye / (1000 * 60 * 60 * 24); // Milisaniyeden güne çevirin

  console.log("fark : ", farkGun);
  handleTodo(yap_adi, yap_id, farkGun);
}
function handleTodo(todo, index, farkGun) {
  if (farkGun < 0) {
    farkGun = 0;
  }
  if (todo == "" || todo == null) {
    console.log("Yarraaa");
  } else {
    // Yeni bir <li> öğesi oluşturun
    const listItem = document.createElement("li");

    // <li> öğesine sınıf ekleyin
    listItem.className = "list-item";

    // <span> öğesini oluşturun ve sınıf ekleyin
    const spanHandle = document.createElement("span");
    spanHandle.className = "handle";

    // İkinci <i> öğesini ekleyin
    const icon2 = document.createElement("i");
    icon2.className = "fas fa-ellipsis-v";
    spanHandle.appendChild(icon2);

    // İlk <i> öğesini ekleyin
    const icon1 = document.createElement("i");
    icon1.className = "fas fa-ellipsis-v";
    spanHandle.appendChild(icon1);

    // <div> öğesini oluşturun ve sınıf ekleyin
    const divCheckbox = document.createElement("div");
    divCheckbox.className = "icheck-primary d-inline ml-2";

    // <input> öğesini oluşturun ve özelliklerini ayarlayın
    const inputCheckbox = document.createElement("input");
    inputCheckbox.className = "todoCheckBoxs";
    inputCheckbox.type = "checkbox";
    inputCheckbox.value = "";
    inputCheckbox.name = `todo${index}`;
    inputCheckbox.id = `todoCheck${index}`;

    // <label> öğesini oluşturun ve "for" özelliğini ayarlayın
    const labelCheckbox = document.createElement("label");
    labelCheckbox.setAttribute("for", `todoCheck${index}`);

    // <span> öğesini oluşturun ve metni ayarlayın
    const spanText = document.createElement("span");
    spanText.className = "text";
    spanText.textContent = todo;

    // <small> öğesini oluşturun ve içeriği ayarlayın
    const smallBadge = document.createElement("small");
    smallBadge.className = "badge badge-danger";
    smallBadge.innerHTML = `<i class="far fa-clock"></i> ${farkGun} gün önce`;

    // <div> öğesini oluşturun ve sınıf ekleyin
    const divTools = document.createElement("div");
    divTools.className = "tools";

    // <i> öğesini oluşturun
    const iconEdit = document.createElement("i");
    iconEdit.className = "fas fa-edit";

    // İkinci <i> öğesini oluşturun
    const iconDelete = document.createElement("i");
    iconDelete.className = "fas fa-trash-o";

    // Öğeleri birbirine ekleyin
    divTools.appendChild(iconEdit);
    divTools.appendChild(iconDelete);
    divCheckbox.appendChild(inputCheckbox);
    divCheckbox.appendChild(labelCheckbox);
    listItem.appendChild(spanHandle);
    listItem.appendChild(divCheckbox);
    listItem.appendChild(spanText);
    listItem.appendChild(smallBadge);
    listItem.appendChild(divTools);

    const todolist = document.querySelector(".todo-list");
    todolist.appendChild(listItem);
  }
}

function checkBoxCheck() {
  const checkBoxes = document.querySelectorAll(
    'input[type="checkbox"][id^="todoCheck"]'
  );
  checkBoxes.forEach((checkbox) => {
    checkbox.addEventListener("click", (e) => {
      const li = e.target.parentNode.parentNode;
      const text =
        e.target.parentNode.parentNode.querySelectorAll("span")[1].innerHTML;
      veriSil(li, text);
    });
  });
}

run();
