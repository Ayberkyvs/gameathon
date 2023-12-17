const logo = document.querySelector("#mainLogoWrapper");

run();

function run() {
  window.addEventListener("scroll", rotateLogo);
}

let rotation = 0;
const rotationSpeed = 0.2;
let lastScrollY = window.scrollY;
function rotateLogo() {
  const scrollY = window.scrollY;
  const scrollDelta = scrollY - lastScrollY;
  rotation += scrollDelta * rotationSpeed;
  logo.style.transform = `rotate(${rotation}deg)`;

  lastScrollY = scrollY;
}

// const menuLinks = document.querySelectorAll('a[href^="#"]');
// run();

// function run() {
//   jQuery(document).ready(menuLinksScrollHandler);
// }
// function menuLinksScrollHandler($) {
//   function scrollToSection(event) {
//     var $section = $($(this).attr("href"));
//     $("html, body").animate(
//       {
//         scrollTop: $section.offset().top - 60,
//       },
//       500
//     );
//   }
//   $("[data-scroll]").on("click", scrollToSection);
// }
