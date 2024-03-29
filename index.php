<!DOCTYPE html>
<html lang="en">

<head>
  <title>CloudGarage</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <!-- /Google Fonts -->
  <link rel="shortcut icon" type="imagex/png" href="logo.svg">
  <link href="css/style.css" rel="stylesheet">
  <script src="scripts/script.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>
</head>

<body>
  <div class="container-fluid">
    <!-- Botão Para puxar o site para cima -->
    <button id="scrollToTopBtn" class="btn btn-dark" onclick="scrollToTop()">
        <i class="fas fa-arrow-up"></i>
    </button>
    <!-- Navbar section -->
    <div class="row p-1">
      <div class="col special-border">
        <nav class="navbar navbar-expand-lg bg-white">
          <a class="navbar-brand p-3" href="#">
            <i class="fa-solid fa-gear fa-fw spin text-secondary"></i>
          </a>
          <button id="navbarToggleBtn" class="navbar-toggler special-border mr-2" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse justify-content-end " id="navbarNav">
            <ul class="navbar-nav bg-white p-1">
              <li class="nav-item mx-auto p-1">
                <a class="nav-link active" href="#banner">Home</a>
              </li>
              <li class="nav-item mx-auto p-1">
                <a class="nav-link" href="#vantagens">Vantagens</a>
              </li>
              <li class="nav-item mx-auto p-1">
                <a class="nav-link" href="#planos">Planos</a>
              </li>
              <li class="nav-item mx-auto p-1">
                <a class="nav-link" href="#contactos">Contactos</a>
              </li>
              <li class="nav-item special-border mx-auto p-1">
                <a class="nav-link" href="/sir/pages/public/signin.php">Login</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
    <!-- Banner -->
    <div id="banner" class="mt-1">
      <div class="grad special-border top d-flex align-items-center">
        <div class="text-center text-dark">
          <div>
            <img class="logo" src="logo.svg">
          </div>
          <div class="d-flex flex-column align-items-center">
            <h1 class="text-white text-shadow">CloudGarage</h1>
            <h3 class="p-3 text-white font-weight-bold">Onde a <span class="text-dark">Performance</span> encontra a
              <span class="text-dark">Confiança</span>
            </h3>
            <h5 class="pb-3 col-9 text-white lead">
              Com uma equipa apaixonada pela mecânica, dedicamo-nos a oferecer o melhor serviço,
              desde reparações essenciais até otimizações de desempenho.
              Somos o teu parceiro confiável na busca por qualidade e fiabilidade.
              Confia-nos o teu veículo e descobre a diferença, onde precisão encontra paixão pela condução.
            </h5>
            <a class="w-100 text-white" href="#planos">
              <button class="btn btn-secondary special-border col-md-2 col-8 mt-3">
                Adira Já
              </button>
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- Advantages section -->
    <div id="vantagens" class="d-flex flex-column align-items-center justify-content-center mt-5">
      <div class="text-center">
        <h1 class="pt-5 pb-4">
          Vantagens da CloudGarage
        </h1>
        <div class="row mb-5">
          <p class="col-8 mx-auto">
            Ao escolher a CloudGarage para as suas necessidades de manutenção de veículos,
            você está optando por uma abordagem moderna e eficiente. Aqui estão algumas
            vantagens irresistíveis que tornam a CloudGarage a escolha inteligente
          </p>
        </div>
      </div>
      <!-- <hr class="w-75 mb-4"> -->
      <div class="row px-5 text-center mb-5">
        <div class="col-md-3 col-12 mt-3">
          <span class="fs-4">Experiência Profissional</span>
          <div class="special-border pb-2">
            <img class="img-thumbnail rounded-0" src="images/experienciaProfisional.png">
            <div class="fs-5 p-2 mt-1">Equipa de mecânicos altamente qualificados e experientes.
            </div>
          </div>
        </div>
        <div class="col-md-3 col-12 mt-3">
          <span class="fs-4">Agendamento Simplificado</span>
          <div class="special-border pb-2">
            <img class="img-thumbnail rounded-0" src="images/easyBooking.png">
            <span class="fs-5 p-2 mt-1">Agende a manutenção do seu veículo com facilidade através da nossa
              plataforma.</span>
          </div>
        </div>
        <div class="col-md-3 col-12 mt-3">
          <span class="fs-4">Total Transparência</span>
          <div class="special-border pb-2">
            <img class="img-thumbnail rounded-0" src="images/transparencia.png">
            <span class="fs-5 p-2 mt-1">Acompanhe em tempo real, o estado da manutenção do seu veículo.</span>
          </div>
        </div>
        <div class="col-md-3 col-12 mt-3">
          <span class="fs-4">Cobertura Nacional</span>
          <div class="special-border pb-2">
            <img class="img-thumbnail rounded-0" src="images/CoberturaNacional.jpg">
            <span class="fs-5 p-2 mt-1">Conte com o nosso serviço de recolha em qualquer ponto do país.</span>
          </div>
        </div>
      </div>
    </div>
    <!-- Carousel -->
    <div class="mb-xs-4 pb-xs-2">
      <div class="row d-block mb-sm-5">
        <div class="col-md-10 col-12 m-auto">
          <div id="carouselLanding" class="carousel carousel-dark slide p-2 special-border" data-bs-ride="carousel">
            <div class="carousel-inner">
              <!-- 1º Item -->
              <div class="carousel-item active">
                <div class="d-block special-border">
                  <img src="images/Carousel/inovacao.png" class="obj-fit mx-auto d-block img-carousel"  alt="Image 1">
                </div>
                <div class="m-1 p-2 bg-light rounded special-border">
                  <h2>Tecnologia Avançada</h2>
                  <p>Na CloudGarage, incorporamos as mais recentes inovações tecnológicas em nossos serviços. Desde
                    diagnósticos precisos até reparos eficientes, estamos na vanguarda da tecnologia automotiva.</p>
                </div>
              </div>
              <!-- 2º Item -->
              <div class="carousel-item">
                <div class="d-block special-border">
                  <img src="images/Carousel/ecologico.png" class="obj-fit mx-auto d-block img-carousel"  alt="Image 2">
                </div>
                <div class="m-1 p-2 bg-light rounded special-border">
                  <h2>Comprometidos com o Ambiente</h2>
                  <p>Além de cuidar do seu veículo, também nos preocupamos com o meio ambiente. Adotamos práticas
                    sustentáveis para minimizar nosso impacto ambiental.</p>
                </div>
              </div>
              <!-- 3º Item -->
              <div class="carousel-item">
                <div class="d-block special-border">
                  <img src="images/Carousel/seguranca.png" class="obj-fit mx-auto d-block img-carousel"  alt="Image 3">
                </div>
                <div class="m-1 p-2 bg-light rounded special-border">
                  <h2>Serviços Personalizados</h2>
                  <p>Entendemos que cada veículo é único. Oferecemos serviços personalizados para atender às
                    necessidades
                    específicas do seu carro, garantindo um tratamento individualizado.</p>
                </div>
              </div>
              <!-- 4º Item -->
              <div class="carousel-item">
                <div class="d-block special-border">
                  <img src="images/Carousel/inov.jpg" class="obj-fit mx-auto d-block img-carousel"  alt="Image 4">
                </div>
                <div class="m-1 p-2 bg-light rounded special-border">
                  <h2>Prioridade na Segurança</h2>
                  <p>Sua segurança é nossa principal preocupação. Utilizamos peças de qualidade e aderimos aos mais
                    altos
                    padrões de segurança em todas as nossas operações.</p>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselLanding" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselLanding" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
            <div id="indicadores" class="text-center">
              <i class="fa-regular fa-circle fa-fw active" data-bs-target="#carouselLanding" data-bs-slide-to="0"
                aria-current="true"></i>
              <i class="fa-regular fa-circle fa-fw" data-bs-target="#carouselLanding" data-bs-slide-to="1"></i>
              <i class="fa-regular fa-circle fa-fw" data-bs-target="#carouselLanding" data-bs-slide-to="2"></i>
              <i class="fa-regular fa-circle fa-fw" data-bs-target="#carouselLanding" data-bs-slide-to="3"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Secção "planos" -->
    <div id="planos" class="py-5 p-3 mt-5 mt-md-3">
      <div
        class="d-flex flex-column align-items-center justify-content-center p-1 py-3 special-background special-border">
        <h2 class="text-center mb-5 text-white text-shadow">Planos de Subscrição</h2>
        <p class="lead text-center mb-5 text-white">Escolha o plano que melhor se adequa a si</p>
        <div class="row justify-content-center col-12">
          <div class="col-md-4 col-12 h-100 mb-4 mb-md-0">
            <div class="card text-center simple-background special-border">
              <div class="card-body custom">
                <h5 class="py-3 rounded-3 bg-black fg-white card-title">Plano Básico</h5>
                <p class="fs-5">Reparação pontual com preço competitivo.</p>
                <ul class="text-start col-9 mx-auto">
                  <li>Preço competitivo</li>
                  <li>Profissionalismo garantido</li>
                  <li>Serviços adicionais</li>
                </ul>
                <p class="card-text"><u><b>Ideal para necessidades ocasionais.</b></u></p>
                <hr />
                <p class="fs-2 card-text"><strong>Preço:</strong> $19.99/mês</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-12 h-100 mb-4 mb-md-0">
            <div class="card text-center simple-background special-border">
              <div class="card-body custom">
                <h5 class="py-3 rounded-3 bg-black fg-white card-title">Plano Anual</h5>
                <p class="fs-5">Reparação coberta por um ano completo.</p>
                <ul class="text-start col-9 mx-auto">
                  <li>Assistência prioritária</li>
                  <li>Serviços de diagnóstico gratuitos</li>
                  <li>Serviços adicionais</li>
                </ul>
                <p class="card-text"><u><b>A escolha mais popular.</b></u></p>
                <hr />
                <p class="fs-2 card-text"><strong>Preço:</strong> $29.99/mês</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-12 h-100 mb-4 mb-md-0">
            <div class="card text-center simple-background special-border">
              <div class="card-body custom">
                <h5 class="py-3 rounded-3 bg-black fg-white card-title">Plano Total</h5>
                <p class="fs-5">Reparação de até 3 carros por ano.</p>
                <ul class="text-start col-9 mx-auto">
                  <li>Serviço de reboque gratuito</li>
                  <li>Serviços de diagnóstico gratuitos</li>
                  <li>Descontos exclusivos em peças</li>
                </ul>
                <p class="card-text"><u><b>Para utilizadores avançados.</b></u></p>
                <hr />
                <p class="fs-2 card-text"><strong>Preço:</strong> $39.99/mês</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="contactos">
      <!-- Form -->
      <div class="col-12">
        <div class="d-flex align-items-center justify-content-center">
          <div class="simple-background special-border p-4">
            <h3>Envie-nos uma mensagem</h3>
            <p>A sua opinião é bem-vinda e estamos sempre disponíveis para ajudar. Por favor preencha o formulário.</p>
            <span>
              <i class="text-gray text-sm">Todos os campos são de preenchimento obrigatório
                <b class="text-danger">*</b>
              </i>
            </span>
            <form action="mailto:CloudGarage@gmail.com" method="post" enctype="text/plain">
              <div class="row">
                <div class="col-md-6 col-12">
                  <div class="p-2">
                    <label for="nameInput" class="form-label">Nome</label>
                    <input type="text" class="form-control special-border" id="nameInput" name="name" required />
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="p-2">
                    <label for="emailInput" class="form-label">Email</label>
                    <input type="email" class="form-control special-border" id="emailInput" name="email" required />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="p-2">
                    <label for="subjectInput" class="form-label">Assunto</label>
                    <input type="text" class="form-control special-border" id="subjectInput" name="subject" required />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="p-2">
                    <label for="messageInput" class="form-label">Mensagem</label>
                    <textarea rows="3" class="form-control special-border" id="messageInput" name="message"
                      required></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 d-flex justify-content-end">
                  <button type="submit" class="btn btn-secondary special-border mt-3 mx-3">
                    Submeter
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- contactos -->
      <div class="col-12 mt-5">
        <div class="row align-items-center">
          <!-- Logo -->
          <div class="col-md-6 col-0 d-md-block text-end">
            <a class="navbar-brand" href="#">
              <i class="fa-solid fa-gear fa-fw spin text-secondary"></i>
            </a>
          </div>
          <!-- Company info -->
          <div class="col-6 mx-auto align-items-center">
            <!-- Location -->
            <div class="d-flex align-items-center">
              <i class="fa-solid fa-location-dot fa-fw mx-3 text-danger"></i>
              <div>
                <span>Avenida do Atlântico, n.º 644,</span><br>
                <span>Viana do Castelo, Portugal</span>
              </div>
            </div>
            <!-- Telemovel -->
            <div class="d-flex align-items-center">
              <i class="fa-solid fa-phone-volume fa-fw mx-3"></i>
              <span>+351 258 819 700</span>
            </div>
            <!-- Email -->
            <div class="d-flex align-items-center">
              <i class="fa-solid fa-envelope  mx-3 fa-fw"></i>
              <span>CloudGarage@gmail.com</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Social Media -->
    <div class="d-flex justify-content-center mt-3">
      <div class="wrapper">
        <div class="button">
          <a href="https://www.facebook.com/" target="_blank" rel='noreferrer' class="facebook">
            <div class="icon">
              <i class="fab fa-facebook-f"></i>
            </div>
            <span>Facebook</span>
          </a>
        </div>
        <div class="button">
          <a href="https://www.instagram.com/" target="_blank" rel='noreferrer' class="instagram">
            <div class="icon">
              <i class="fab fa-instagram"></i>
            </div>
            <span>Instagram</span>
          </a>
        </div>
        <div class="button">
          <a href="https://www.youtube.com/" target="_blank" rel='noreferrer' class="youtube">
            <div class="icon">
              <i class="fab fa-youtube"></i>
            </div>
            <span>YouTube</span>
          </a>
        </div>
      </div>
    </div>
    <hr style="border: 1px solid black;opacity: 1">
    <footer>
      <div class="text-center mb-3">
        <span>&copy; Copyright 2023</span><br>
        <span>Made by <b>Diogo Carvalho</b> & <b>João Freitas</b></span>
      </div>
    </footer>
  </div>
</body>

</html>