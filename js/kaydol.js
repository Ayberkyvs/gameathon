btnaddUser = document.querySelector(".btn-addUser");
cardBody = document.querySelector(".user-form-container");
bannerimg = document.querySelector(".banner-image");
userList = document.querySelector(".userList");
createGroup = document.querySelector("#createGroup");
selectSchool = document.querySelector(".selectSchool");
banner = document.querySelector(".banner");
groupContainer = document.querySelector(".group-container");
userContainer = document.querySelector(".user-container");
submitContainer = document.querySelector(".submit-container");
btnSubmit = document.querySelector(".btnSubmit");
form = document.querySelector("#application-form");

var sayi = 0;
var secretKey = 0;
var groupNameAvailability = 0;
document.addEventListener("DOMContentLoaded", run);

function run() {
  selectSchool.addEventListener("change", displayGroupContainer);
  createGroup.addEventListener("change", displayUserContainer);
  btnaddUser.addEventListener("click", controlUserForm);
  createGroup.addEventListener("keyup", checkGroupName);
  bannerimg.addEventListener("click", handleBannerClick);
  form.addEventListener("keydown", (event) => {
    if (event.key === "Enter") {
      event.preventDefault();
      Swal.fire({
        title: "Kaydınızı Tamamlamak",
        text: "Başvurunuzu tamamlamak için tüm bilgileri doldurduktan sonra çıkacak butona tıklamanız gerekmektedir.",
        icon: "info",
      });
    }
  });
}

function checkGroupName() {
  groupAvailabilityMessage = document.querySelector(
    ".groupAvailabilityMessage"
  );
  const groupName = createGroup.value;
  if (groupName.length > 3) {
    const xhr = new XMLHttpRequest();
    xhr.open(
      "GET",
      "check_group_availability.php?group_name=" + groupName,
      true
    );

    xhr.onload = function () {
      if (xhr.status === 200) {
        const response = JSON.parse(xhr.responseText);
        if (response.available) {
          groupAvailabilityMessage.textContent = "Bu grup adı kullanılabilir!";
          groupAvailabilityMessage.style.color = "green";
          createGroup.style.borderColor = "green";
          groupNameAvailability = 1;
          displayUserContainer();
        } else {
          groupAvailabilityMessage.textContent = "Bu grup adı zaten alınmış!";
          groupAvailabilityMessage.style.color = "red";
          createGroup.style.borderColor = "red";
          groupNameAvailability = 0;
          displayUserContainer();
        }
      }
    };

    xhr.send();
  } else {
    groupAvailabilityMessage.textContent =
      "Grup adı minimum 4 karakter olmalıdır.";
    groupAvailabilityMessage.style.color = "red";
    createGroup.style.borderColor = "red";
    groupNameAvailability = 0;
    displayUserContainer();
  }
}
function showSubmitButton() {
  if (userContainer.style.display === "block" && sayi >= 2) {
    submitContainer.style.display = "block";
  } else {
    submitContainer.style.display = "none";
  }
}
function handleBannerClick() {
  secretKey = secretKey + 1;
  if (secretKey >= 10) {
    bannerimg.src = "img/basvuru/ayberkeffect.png";
  }
}
function displayGroupContainer() {
  if (selectSchool.value > 0) {
    groupContainer.style.display = "block";
    displayUserContainer();
  } else {
    groupContainer.style.display = "none";
    displayUserContainer();
    // userContainer.style.display = "none";
  }
}
function displayUserContainer() {
  if (
    createGroup.value.length > 3 &&
    groupContainer.style.display === "block" &&
    groupNameAvailability === 1
  ) {
    userContainer.style.display = "block";
  } else {
    userContainer.style.display = "none";
  }
}

function controlUserForm() {
  if (sayi < 4 && sayi >= 0) {
    createUserForm(sayi);
    isBtnVisible(0);
  } else {
    btnaddUser.className = "btn btn-danger btn-addUser";
    btnaddUser.style.pointerEvents = "none";
    btnaddUser.innerHTML = "Daha Fazla Katılımcı Ekleyemezsin. (4/4)";
  }
}

function isBtnVisible(boolean) {
  if (sayi >= 2) {
    showSubmitButton();
  }
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
  adInput.placeholder = "";
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
  soyadInput.placeholder = "";
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
  kimliknoInput.placeholder = "";
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
  emailInput.placeholder = "";
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
  telefonInput.placeholder = "5_________";
  telefonInput.pattern = "[0-9]{3} [0-9]{3} [0-9]{2} [0-9]{2}";
  telefonInput.title = "Örnek: 5456414380";
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
  closeBtn.addEventListener("click", closeUserForm);
}
function closeUserForm() {
  const formId = document.querySelector(`#addUserForm${sayi}`);
  const ad = document.querySelector(`#ad${sayi}`);
  const soyad = document.querySelector(`#soyad${sayi}`);
  const kimlikno = document.querySelector(`#kimlikno${sayi}`);
  const email = document.querySelector(`#email${sayi}`);
  const telefon = document.querySelector(`#telefon${sayi}`);
  //   console.log("Temizlenmemiş : " + ad.value);
  if (
    ad.value !== "" &&
    soyad.value !== "" &&
    kimlikno.value !== "" &&
    email.value !== "" &&
    telefon.value !== ""
  ) {
    // console.log("Temizlenmiş : " + ad.value);
    formId.style.display = "none";
    (ad.value = capitalizeAndCleanText(ad.value.trim())),
      (soyad.value = capitalizeAndCleanText(soyad.value.trim())),
      (kimlikno.value = capitalizeAndCleanText(kimlikno.value.trim())),
      (email.value = capitalizeAndCleanText(email.value.trim())),
      (telefon.value = capitalizeAndCleanText(telefon.value.trim()));
    createAlertBox(ad.value, soyad.value);
    sayi++;
    isBtnVisible(1);
  } else {
    Swal.fire({
      title: "Tüm Alanların Doldurulması Gerekli!",
      text: "Başvurunuzu tamamlamak için tüm alanları doldurmanız gerekmektedir.",
      icon: "error",
    });
  }
}
function capitalizeAndCleanText(text) {
  if (text !== " " && text !== null) {
    // Boşluklara göre metni böler
    const words = text.split(/\s+/);

    // Her kelimenin baş harfini büyük yap ve fazladan boşlukları temizle
    const cleanedWords = words.map((word) => {
      return word
        .replace(/^\s+|\s+$/g, "")
        .replace(/^(.)(.*)$/, function (_, first, rest) {
          return first.toUpperCase() + rest;
        });
    });

    return cleanedWords.join(" ");
  } else {
    alert("Tüm Alanların Doldurulması Gerekli");
  }
}
function createAlertBox(ad, soyad) {
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
  text.textContent = `${ad} ${soyad}`;

  div.appendChild(i);
  div.appendChild(text);

  //   const div2 = document.createElement("div");
  //   const idelete = document.createElement("i");
  //   const value = document.createElement("span");
  //   const button = document.createElement("button");

  //   button.type = "button";
  //   button.className = "btn btnDeleteUser";

  //   value.innerHTML = `${sayi}`;
  //   value.style.display = "none";

  //   idelete.className = "fa-solid fa-trash deleteUser";
  //   idelete.style = "cursor:pointer; ";

  //   button.appendChild(idelete);
  //   div2.appendChild(value);
  //   div2.appendChild(button);
  alertPrimary.appendChild(div);
  //   alertPrimary.appendChild(div2);
  userList.appendChild(alertPrimary);
}
