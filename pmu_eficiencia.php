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
  <p id="select-pmu" hidden>eficiencia</p>

  <!-- Page header and form -->
  <section class="pb-0" id="about">
    <div class="container">
      <h4> Measurement Unit: Microgrid </h4>

      <form>
        <div class="form-row">
          <div class="col">
            <label for="time_window_select">Time window in minutes</label>
            <input type="number" class="form-control" id="time_window_select" aria-describedby="time_window" placeholder="60" min="1" max="60" step="1">
            <small id="time_window" class="form-text text-muted">
              Highest time window available is 60 minutes.
            </small>
          </div>

          <div class="col">
            <label for="sample_frequency_select">
              Sample frequency in hertz
            </label>
            <input type="number" class="form-control" id="sample_frequency_select" aria-describedby="time_window" placeholder="15" min="15" max="20" step="1">
            <small id="freq_select" class="form-text text-muted">
              Sample frequency between 15 and 20 Hz.
            </small>
          </div>
        </div>

        <button type="button" id="button_id" class="btn btn-secondary" style="margin-top: 10px">
          Update
        </button>
      </form>

      <!-- Gráficos -->
      <div class="row" id="graph1" style="width: 1140px;"></div>
      <div class="row" id="graph2" style="width: 1140px;"></div>

      <!-- Tempo de atualização -->
      <div class="row justify-content-center" id="last-update" style="display:none">
        <h3>Last update at <span id="last-update-time"></span></h3>
      </div>
    </div>

    <!-- Logo de loading -->
    <div id="loading" style="text-align: center; display: none">
      <img src="svg/loading-big.gif" width="400px">
      <p align="center">
      <h1><b>LOADING...</b></h1>
      </p>
    </div>
  </section>

  <div class="text-center pb-5" id="pmu-location">
    <h5 class="pt-4">PMU geographical location</h5>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d900.6527585227743!2d-49.23439171191856!3d-25.45126449898119!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjXCsDI3JzA0LjYiUyA0OcKwMTQnMDEuOCJX!5e0!3m2!1spt-BR!2sbr!4v1623191654981!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
  </div>

  <?php include('footer.php'); ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="js/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="js/scrolling-nav.js"></script>

  <script type="text/javascript" src="js/plotly-latest.min.js"></script>
  <script type="text/javascript" src="js/graphs.js"></script>

</body>

</html>