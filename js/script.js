document.addEventListener("DOMContentLoaded", function () {
  const carousel = document.querySelector("#heroCarousel");

  if (carousel) {
    carousel.addEventListener("slide.bs.carousel", function (e) {
      const captions = carousel.querySelectorAll(".carousel-caption .animated-rise-up");
      captions.forEach(el => {
        el.classList.remove("animated-rise-up"); 
        void el.offsetWidth; 
        el.classList.add("animated-rise-up");
      });
    });
  }
});
