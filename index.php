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

  <section id="about">
    <div class="container">
      <h2>Escolha uma PMU</h2>
      <select class="custom-select" id="select-pmu" onchange="location = this.value;">
        <option value="index.php" selected>Selecione</option>
        <option value="pmu_eficiencia.php">Cabine</option>
        <option value="pmu_eficiencia.php">Eficiência</option>
        <option value="pmu_eficiencia.php">Palotina</option>
        <option value="pmu_eficiencia.php">Agrárias</option>
        <option value="pmu_eficiencia.php" disabled>Usina</option>
        <option value="pmu_eficiencia.php" disabled>Faxinal</option>
      </select>
  </section>

  <?php include('footer.php'); ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="js/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="js/scrolling-nav.js"></script>

</body>

</html>
