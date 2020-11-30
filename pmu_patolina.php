<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Welch</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/scrolling-nav.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <?php include('menu.php'); ?>

  <!-- Gets PMU value for page -->
  <p id="select-pmu" hidden>patolina</p>

  <section id="about">
    <div class="container">
      <h4> Unidade de medição: Patolina </h4>
      <div class="row" id="graph1" style="width: 1140px;"></div>
      <div class="row" id="graph2" style="width: 1140px;"></div>
      <div class="row justify-content-center" id="last-update" style="display:none"><h3>Last updated at <span id="last-update-time"></span></h3></div>
    </div>
      
      <div id="loading" style="text-align: center; display: none">
      <img src="svg/loading-big.gif" width="400px">
      <p align="center"><h1><b>LOADING...</b></h1></p>
    </div>

  </section>

  <?php include('footer.php'); ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="js/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="js/scrolling-nav.js"></script>

  <script type="text/javascript" src="js/plotly-latest.min.js"></script>
  <script type="text/javascript" src="js/generate-graphs.js"></script>

</body>

</html>
