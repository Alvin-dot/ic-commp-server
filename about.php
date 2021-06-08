<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>About the project</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/scrolling-nav.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <?php include('menu.php'); ?>

  <section id="about">
    <div class="container">
      <h2 class="mt-4">About the project</h2>
      <p>
        The main goal of this project is to investigate new methods and algorithms for PMU/ µPMU data analysis aiming to estimate power system oscillation modes.
        The results are useful to support decisions regarding power system stability (transient and small signals) and found application to both in the Generation/Transmission or the Distribution context.<br>

        Some methods and algorithms have several tunning parameters which should be wisely selected for an adequate result.
        So, for a better understanding of the whole problem, this web environment has been designed to estimate electromechanical modes present in the distribution grid based on real-time data from µPMU units. Those µPMU are located at different campuses of the Universidade Federal do Paraná (UFPR). In this first version, we are testing the well-known Welch and Yule-Walker algorithms, which have parallel basic properties.<br>
        More details about this project can be found <a href="https://professorgustavo.weebly.com/pmu-based-real-time-power-systems-monitoring.html" target="_blank">here</a>.
      </p>
      <br />
      <br />
      <h3>Team</h3>
      <table class="table table-hover">
        <tbody>
          <tr>
            <td>Prof. Dr. Gustavo Henrique da Costa Oliveira (coordinator)</td>
            <td>gustavo.oliveira@ufpr.br</td>
          </tr>
          <tr>
            <td>Prof. Dr. Ricardo Schumacher</td>
            <td>schumacher.ric@gmail.com</td>
          </tr>
          <tr>
            <td>Prof. Dr. Eduardo Parente Ribeiro</td>
            <td>edu@eletrica.ufpr.br</td>
          </tr>
          <tr>
            <td>Prof. Dr. Roman Kuiava</td>
            <td>romankuiava@gmail.com</td>
          </tr>
          <tr>
            <td>Álvaro José Baranoski</td>
            <td>alvarojosebaranoski01@gmail.com</td>
          </tr>
          <tr>
            <td>Yuri Poledna</td>
            <td>ypoledna@gmail.com</td>
          </tr>
        </tbody>
      </table>
      <br />
      <h3>Acknowledgements</h3>
      <p>This research was supported by ANEEL’s R&D Program through COPEL’s PD 2866-0470-2017 project.</p>
    </div>
  </section>

  <?php include('footer.php'); ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="js/scrolling-nav.js"></script>

  <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
  <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3.0.0/es5/tex-mml-chtml.js"></script>

</body>

</html>