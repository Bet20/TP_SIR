document.addEventListener('DOMContentLoaded', function () {
  const myCarousel = document.getElementById('carouselLanding');

  // Adiciona a classe fa-solid ao primeiro indicador por causa da primeira vez que o carousel carrega
  const firstIndicator = document.querySelector('#indicadores i.fa-circle');
  firstIndicator.classList.add('fa-solid');

  myCarousel.addEventListener('slid.bs.carousel', function (event) {
    const activeIndex = event.to;

    const indicators = document.querySelectorAll('#indicadores i.fa-circle');

    indicators.forEach(function (i) {
      i.classList.remove('fa-solid');
    });

    indicators[activeIndex].classList.add('fa-solid');
  });
});
