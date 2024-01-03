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

//Para fechar o toogle no momento de click
document.addEventListener('DOMContentLoaded', function () {
  // Adiciona um ouvinte de clique a todos os itens de navegação
  var navItems = document.querySelectorAll('.navbar-nav .nav-link');
  navItems.forEach(function (item) {
    item.addEventListener('click', function () {
      // Fecha o menu ao clicar em um item
      var navbarToggleBtn = document.getElementById('navbarToggleBtn');
      var navbarNav = document.getElementById('navbarNav');
      
      if (navbarToggleBtn && navbarNav) {
        var isNavbarCollapsed = navbarNav.classList.contains('show');
        if (isNavbarCollapsed) {
          navbarToggleBtn.click(); // Simula o clique no botão de toogle
        }
      }
    });
  });
});
