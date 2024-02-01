window.addEventListener("scroll", function () {
    let header = document.querySelector("header");
    header.classList.toggle("abajo", window.scrollY > 0);
  
  })