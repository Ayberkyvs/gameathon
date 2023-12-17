btnaddUser = document.querySelector(".btn-addUser");
cardBody = document.querySelector(".user-form-container");
userList = document.querySelector(".userList");
createGroup = document.querySelector("#createGroup");
selectSchool = document.querySelector(".selectSchool");
groupContainer = document.querySelector(".group-container");
userContainer = document.querySelector(".user-container");
submitContainer = document.querySelector(".submit-container");
btnSubmit = document.querySelector(".btnSubmit");

var sayi = JSON.parse(localStorage.getItem("userData"))?.length || 0;
console.log("sayi: " + sayi);
document.addEventListener("DOMContentLoaded", getLocalStorage);
// localStorage.clear();
function run() {
  btnaddUser.addEventListener("click", controlUserForm);
  selectSchool.addEventListener("change", displayGroupContainer);
  createGroup.addEventListener("change", displayUserContainer);
}

function showAllContainers() {
  if (localStorage.getItem("schoolData")) {
    groupContainer.style.display = "block";
    if (
      localStorage.getItem("groupData").length > 3 &&
      groupContainer.style.display === "block"
    ) {
      userContainer.style.display = "block";
      if (userContainer.style.display === "block" && sayi >= 2) {
        submitContainer.style.display = "block";
        console.log("sayi 2 den büyük");
      } else {
        submitContainer.style.display = "none";
        console.log("gizle oç");
      }
    }
  }
}

function displayUserContainer() {
  localStorage.setItem("groupData", createGroup.value);
  if (
    localStorage.getItem("groupData").length > 3 &&
    groupContainer.style.display == "block"
  ) {
    userContainer.style.display = "block";
  } else {
    userContainer.style.display = "none";
  }
}
function displayGroupContainer() {
  localStorage.setItem("schoolData", selectSchool.value);
  if (localStorage.getItem("schoolData") > 0) {
    groupContainer.style.display = "block";
  } else {
    groupContainer.style.display = "none";
    userContainer.style.display = "none";
  }
}
function deleteListener() {
  const deleteUserButtons = document.querySelectorAll(".btnDeleteUser");
  deleteUserButtons.forEach((button, index) => {
    button.addEventListener("click", function () {
      const value = button.previousElementSibling.textContent;
      deleteLocalStorage(value);
    });
  });
}
function deleteLocalStorage(value) {
  let existingData = JSON.parse(localStorage.getItem("userData")) || [];
  if (value >= 0 && value < existingData.length) {
    existingData.splice(value, 1);
    localStorage.setItem("userData", JSON.stringify(existingData));
    window.location.reload();
  }
}
function getLocalStorage() {
  run();
  ekranaYaz();
  showAllContainers();
  if (sayi !== null && sayi > 0) {
    deleteListener();
    isBtnVisible(1);
  }
  if (sayi === 4) {
    controlUserForm();
  }
}
function controlUserForm() {
  if (sayi <= 3 && sayi >= 0) {
    createUserForm(sayi);
    isBtnVisible(0);
  } else {
    btnaddUser.className = "btn btn-danger btn-addUser";
    btnaddUser.style.pointerEvents = "none";
    btnaddUser.innerHTML = "Daha Fazla Katılımcı Ekleyemezsin. (4/4)";
  }
}

function isBtnVisible(boolean) {
  if (boolean === 1) {
    btnaddUser.style.display = "block";
    userList.style.display = "block";
    btnaddUser.innerHTML = `<i class="fa-solid fa-plus"></i> Katılımcı Ekleyin (${sayi} / 4)`;
  } else if (boolean === 0) {
    btnaddUser.style.display = "none";
    userList.style.display = "none";
  }
}

function createUserForm(sayi) {
  // Ana form elementini oluştur
  const userForm = document.createElement("div");
  userForm.id = `addUserForm${sayi}`;
  userForm.className = "addUser-container";

  const name = document.createElement("div");
  name.className = "mb-3";

  const adLabel = document.createElement("label");
  adLabel.setAttribute("for", `ad${sayi}`);
  adLabel.className = "form-label";
  adLabel.textContent = "Ad";

  const adInput = document.createElement("input");
  adInput.type = "text";
  adInput.className = "form-control";
  adInput.id = `ad${sayi}`;
  adInput.placeholder = "Ayberk";
  adInput.name = `ad${sayi}`;
  adInput.required = true;

  name.appendChild(adLabel);
  name.appendChild(adInput);

  const surname = document.createElement("div");
  surname.className = "mb-3";
  // Soyad input elementini oluştur
  const soyadLabel = document.createElement("label");
  soyadLabel.setAttribute("for", `soyad${sayi}`);
  soyadLabel.className = "form-label";
  soyadLabel.textContent = "Soyad";

  const soyadInput = document.createElement("input");
  soyadInput.type = "text";
  soyadInput.className = "form-control";
  soyadInput.id = `soyad${sayi}`;
  soyadInput.placeholder = "Yavaş";
  soyadInput.name = `soyad${sayi}`;
  soyadInput.required = true;

  surname.appendChild(soyadLabel);
  surname.appendChild(soyadInput);

  const tc = document.createElement("div");
  tc.className = "mb-3";

  const kimliknoLabel = document.createElement("label");
  kimliknoLabel.setAttribute("for", `kimlikno${sayi}`);
  kimliknoLabel.className = "form-label";
  kimliknoLabel.textContent = "Kimlik Numarası";

  const kimliknoInput = document.createElement("input");
  kimliknoInput.type = "text";
  kimliknoInput.className = "form-control";
  kimliknoInput.id = `kimlikno${sayi}`;
  kimliknoInput.name = `kimlikno${sayi}`;
  kimliknoInput.placeholder = "26323163174";
  kimliknoInput.pattern = "[0-9]{11}";
  kimliknoInput.title = "11 Haneli TC Numarasını Giriniz";
  kimliknoInput.maxLength = 11;
  kimliknoInput.minLength = 11;
  kimliknoInput.required = true;

  tc.appendChild(kimliknoLabel);
  tc.appendChild(kimliknoInput);

  // Email input elementini oluştur
  const email = document.createElement("div");
  email.className = "mb-3";

  const emailLabel = document.createElement("label");
  emailLabel.setAttribute("for", `email${sayi}`);
  emailLabel.className = "form-label";
  emailLabel.textContent = "Email";

  const emailInput = document.createElement("input");
  emailInput.type = "email";
  emailInput.className = "form-control";
  emailInput.id = `email${sayi}`;
  emailInput.placeholder = "contact@ayberkyavas.com";
  emailInput.name = `email${sayi}`;
  emailInput.required = true;

  email.appendChild(emailLabel);
  email.appendChild(emailInput);

  // Telefon input elementini oluştur
  const telefon = document.createElement("div");
  telefon.className = "mb-3";

  const telefonLabel = document.createElement("label");
  telefonLabel.setAttribute("for", `telefon${sayi}`);
  telefonLabel.className = "form-label";
  telefonLabel.textContent = "Telefon";

  const telefonInput = document.createElement("input");
  telefonInput.type = "tel";
  telefonInput.className = "form-control";
  telefonInput.id = `telefon${sayi}`;
  telefonInput.name = `telefon${sayi}`;
  telefonInput.placeholder = "5555555555";
  telefonInput.pattern = "[0-9]{3} [0-9]{3} [0-9]{2} [0-9]{2}";
  telefonInput.title = "Örnek: 5555555555";
  telefonInput.maxLength = 10;
  telefonInput.required = true;

  telefon.appendChild(telefonLabel);
  telefon.appendChild(telefonInput);
  // Close button elementini oluştur
  const btnClose = document.createElement("div");
  btnClose.className = "mb-3";

  const closeBtn = document.createElement("button");
  closeBtn.type = "button";
  closeBtn.className = "btn btn-primary btn-addUser-close";
  closeBtn.id = `closeAddUserForm${sayi}`;
  closeBtn.textContent = "Tamam";

  btnClose.appendChild(closeBtn);

  userForm.appendChild(name);
  userForm.appendChild(surname);
  userForm.appendChild(tc);
  userForm.appendChild(email);
  userForm.appendChild(telefon);
  userForm.appendChild(btnClose);

  cardBody.appendChild(userForm);
  // const closeBtn = document.querySelector(`#closeAddUserForm${sayi}`);
  closeBtn.addEventListener("click", closeUserForm);
}

function closeUserForm() {
  const formId = document.querySelector(`#addUserForm${sayi}`);
  const ad = document.querySelector(`#ad${sayi}`);
  const soyad = document.querySelector(`#soyad${sayi}`);
  const kimlikno = document.querySelector(`#kimlikno${sayi}`);
  const email = document.querySelector(`#email${sayi}`);
  const telefon = document.querySelector(`#telefon${sayi}`);
  if (
    ad.value !== "" &&
    soyad.value !== "" &&
    kimlikno.value !== "" &&
    email.value !== "" &&
    telefon.value !== ""
  ) {
    formId.style.display = "none";

    addLocalStorage(
      capitalizeAndCleanText(ad.value.trim()),
      capitalizeAndCleanText(soyad.value.trim()),
      capitalizeAndCleanText(kimlikno.value.trim()),
      capitalizeAndCleanText(email.value.trim()),
      capitalizeAndCleanText(telefon.value.trim())
    );
    isBtnVisible(1);
  } else {
    alert("Tüm Alanların Doldurulması Gerekli");
  }
  // window.location.reload();
}
function capitalizeAndCleanText(text) {
  // Boşluklara göre metni böler
  const words = text.split(" ");

  // Her kelimenin baş harfini büyük yap ve fazladan boşlukları temizle
  const cleanedWords = words.map((word) => {
    return word
      .replace(/^\s+|\s+$/g, "")
      .replace(/^(.)(.*)$/, function (_, first, rest) {
        return first.toUpperCase() + rest;
      });
  });

  // Temizlenmiş kelimeleri birleştir ve sonucu döndür
  return cleanedWords.join(" ");
}

function addLocalStorage(ad, soyad, kimlik, email, telefon) {
  let existingData = JSON.parse(localStorage.getItem("userData")) || [];
  existingData.push({ ad, soyad, kimlik, email, telefon });
  localStorage.setItem("userData", JSON.stringify(existingData));
  ekranaYaz();
}

function ekranaYaz() {
  const userData = JSON.parse(localStorage.getItem("userData")) || [];
  sayi = userData.length;

  const schoolData = localStorage.getItem("schoolData") || [];
  selectSchool.value = schoolData;

  const groupData = localStorage.getItem("groupData") || [];
  createGroup.value = groupData;

  createUserFormUI(userData);
  createAlertBox(userData);
  deleteListener();
  // window.location.reload();
}
function createUserFormUI(userData) {
  userData.forEach((user, index) => {
    const userForm = document.createElement("div");
    userForm.id = `addUserForm${index}`;
    userForm.className = "addUser-container";
    userForm.style.display = "none";
    const name = document.createElement("div");
    name.className = "mb-3";
    const adLabel = document.createElement("label");
    adLabel.setAttribute("for", `ad${index}`);
    adLabel.className = "form-label";
    adLabel.textContent = "Ad";
    const adInput = document.createElement("input");
    adInput.type = "text";
    adInput.className = "form-control";
    adInput.id = `ad${index}`;
    adInput.placeholder = "Ayberk";
    adInput.name = `ad${index}`;
    adInput.required = true;
    name.appendChild(adLabel);
    name.appendChild(adInput);
    const surname = document.createElement("div");
    surname.className = "mb-3";
    // Soyad input elementini oluştur
    const soyadLabel = document.createElement("label");
    soyadLabel.setAttribute("for", `soyad${index}`);
    soyadLabel.className = "form-label";
    soyadLabel.textContent = "Soyad";
    const soyadInput = document.createElement("input");
    soyadInput.type = "text";
    soyadInput.className = "form-control";
    soyadInput.id = `soyad${index}`;
    soyadInput.placeholder = "Yavaş";
    soyadInput.name = `soyad${index}`;
    soyadInput.required = true;
    surname.appendChild(soyadLabel);
    surname.appendChild(soyadInput);
    const tc = document.createElement("div");
    tc.className = "mb-3";
    const kimliknoLabel = document.createElement("label");
    kimliknoLabel.setAttribute("for", `kimlikno${index}`);
    kimliknoLabel.className = "form-label";
    kimliknoLabel.textContent = "Kimlik Numarası";
    const kimliknoInput = document.createElement("input");
    kimliknoInput.type = "text";
    kimliknoInput.className = "form-control";
    kimliknoInput.id = `kimlikno${index}`;
    kimliknoInput.name = `kimlikno${index}`;
    kimliknoInput.placeholder = "26323163174";
    kimliknoInput.pattern = "[0-9]{11}";
    kimliknoInput.title = "11 Haneli TC Numarasını Giriniz";
    kimliknoInput.maxLength = 11;
    kimliknoInput.minLength = 11;
    kimliknoInput.required = true;
    tc.appendChild(kimliknoLabel);
    tc.appendChild(kimliknoInput);
    // Email input elementini oluştur
    const email = document.createElement("div");
    email.className = "mb-3";
    const emailLabel = document.createElement("label");
    emailLabel.setAttribute("for", `email${index}`);
    emailLabel.className = "form-label";
    emailLabel.textContent = "Email";
    const emailInput = document.createElement("input");
    emailInput.type = "email";
    emailInput.className = "form-control";
    emailInput.id = `email${index}`;
    emailInput.placeholder = "contact@ayberkyavas.com";
    emailInput.name = `email${index}`;
    emailInput.required = true;
    email.appendChild(emailLabel);
    email.appendChild(emailInput);
    // Telefon input elementini oluştur
    const telefon = document.createElement("div");
    telefon.className = "mb-3";
    const telefonLabel = document.createElement("label");
    telefonLabel.setAttribute("for", `telefon${index}`);
    telefonLabel.className = "form-label";
    telefonLabel.textContent = "Telefon";
    const telefonInput = document.createElement("input");
    telefonInput.type = "tel";
    telefonInput.className = "form-control";
    telefonInput.id = `telefon${index}`;
    telefonInput.name = `telefon${index}`;
    telefonInput.placeholder = "5555555555";
    telefonInput.pattern = "[0-9]{3} [0-9]{3} [0-9]{2} [0-9]{2}";
    telefonInput.title = "Örnek: 5555555555";
    telefonInput.maxLength = 10;
    telefonInput.required = true;
    telefon.appendChild(telefonLabel);
    telefon.appendChild(telefonInput);
    // Close button elementini oluştur
    const btnClose = document.createElement("div");
    btnClose.className = "mb-3";
    const closeBtn = document.createElement("button");
    closeBtn.type = "button";
    closeBtn.className = "btn btn-primary btn-addUser-close";
    closeBtn.id = `closeAddUserForm${index}`;
    closeBtn.textContent = "Tamam";
    btnClose.appendChild(closeBtn);
    userForm.appendChild(name);
    userForm.appendChild(surname);
    userForm.appendChild(tc);
    userForm.appendChild(email);
    userForm.appendChild(telefon);
    userForm.appendChild(btnClose);
    cardBody.appendChild(userForm);

    adInput.value = user.ad;
    soyadInput.value = user.soyad;
    kimliknoInput.value = user.kimlik;
    emailInput.value = user.email;
    telefonInput.value = user.telefon;
  });
}
function createAlertBox(userData) {
  userList.innerHTML = ""; // Önceki içeriği temizle
  userData.forEach((user, index) => {
    const alertPrimary = document.createElement("div");
    alertPrimary.className =
      "alert alert-primary d-flex align-items-center justify-content-between";
    alertPrimary.role = "alert";

    const div = document.createElement("div");
    div.className = "d-flex align-items-center";

    const i = document.createElement("i");
    i.className = "fa-solid fa-user";

    const text = document.createElement("div");
    text.style = "margin-left: 10px; text-transform: uppercase;";
    text.textContent = `${user.ad} ${user.soyad}`;

    div.appendChild(i);
    div.appendChild(text);

    const div2 = document.createElement("div");
    const idelete = document.createElement("i");
    const value = document.createElement("span");
    const button = document.createElement("button");

    button.type = "button";
    button.className = "btn btnDeleteUser";

    value.innerHTML = `${index}`;
    value.style.display = "none";

    idelete.className = "fa-solid fa-trash deleteUser";
    idelete.style = "cursor:pointer; ";

    button.appendChild(idelete);
    div2.appendChild(value);
    div2.appendChild(button);
    alertPrimary.appendChild(div);
    alertPrimary.appendChild(div2);
    userList.appendChild(alertPrimary);
  });
}
