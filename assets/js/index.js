// Form Submission Handling
document.getElementById("contactForm").addEventListener("submit", function (e) {
  e.preventDefault();
  alert("Thank you for your message. This is a frontend demo.");
  this.reset();
});

// Navbar Scroll Effect
window.addEventListener("scroll", function () {
  const navbar = document.querySelector(".navbar");
  if (window.scrollY > 50) {
    navbar.style.padding = "0.5rem 0";
    navbar.style.boxShadow = "0 10px 30px rgba(0,0,0,0.5)";
  } else {
    navbar.style.padding = "1rem 0";
    navbar.style.boxShadow = "none";
  }
});

const navLinks = document.querySelectorAll(".nav-link");
const sections = document.querySelectorAll(".section");

navLinks.forEach((navlink) => {
  navlink.addEventListener("click", () => {
    const isActive = document.querySelector(".nav-link.active");

    if (isActive) isActive.classList.remove("active");

    navlink.classList.add("active");
  });
});

window.addEventListener("scroll", () => {
  let currentActive = "";

  sections.forEach((section) => {
    const sectionTop = section.offsetTop;
    const sectionHeight = section.clientHeight;

    if (window.scrollY >= sectionTop - 150) {
      currentActive = section.getAttribute("id");
    }
  });

  navLinks.forEach((navlink) => {
    navlink.classList.remove("active");

    if (navlink.getAttribute("href") === `#${currentActive}`) {
      navlink.classList.add("active");
    }
  });
});
