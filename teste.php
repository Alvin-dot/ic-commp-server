<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Scrolling Nav - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/scrolling-nav.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="index.php">R3LS</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="about.php">Sobre o projeto</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- <header class="bg-primary text-white">
    <div class="container text-center">
      <h1>Welcome to Scrolling Nav</h1>
      <p class="lead">A landing page template freshly redesigned for Bootstrap 4</p>
    </div>
  </header> -->

  <section id="about">
    <div class="container">
      <select class="custom-select" id="select-pmu">
        <option value="5999">Cabine</option>
        <option value="6000" selected>Eficiência</option>
        <option value="6001">Palotina</option>
        <option value="6002">Agrárias</option>
        <option value="6003" disabled>Usina</option>
        <option value="6004" disabled>Faxinal</option>
      </select>

      <div class="row" id="graph1"></div>
      <div class="row" id="graph2"></div>
      <div class="row" id="graph3"></div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Aplicação do projeto Desenvolvimento De Minirredes Com Fontes De Energia Renováveis Não Convencionais</p>
      <p class="m-0 text-center text-white">2018-2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="js/scrolling-nav.js"></script>

  <script type="text/javascript" src="js/plotly-latest.min.js"></script>
  <script type="text/javascript" src="js/generate-graphs.js"></script>

</body>

</html>
