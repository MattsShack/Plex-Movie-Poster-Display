<?php 
  include_once('config.php');
  $pmpImageSpeed = ($pmpImageSpeed * 1000);
?>

<html>
  <head>
    <title></title>

    <!-- JQuery -->
    <script src="assets/jquery-3.4.0/jquery-3.4.0.min.js"></script>

    <!-- Bootstrap JavaScript-->
    <script src="assets/bootstrap-4.3.1/js/bootstrap.min.js"></script>

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="assets/bootstrap-4.3.1/css/bootstrap.min.css">

    <!-- Default Poster Template CSS -->
    <link rel="stylesheet" href="assets/styles/default/poster.css">

    <script>
      $(document).ready(
        function() {
          setInterval(function() {
            $.getJSON('getData.php',function(data) {
              $.each(data, function(key, val) {
                $('#'+key).html(val);
              });
            });
          }, <?php echo $pmpImageSpeed; ?>);
        });
    </script>
  </head>
 
  <body>
    <div id="container">
      <div id="alert" align="center" class="center"></div>
      <div id="top" align="center" class="center"></div>
      <div id="middle" class="middle">Loading... First load will take <?php echo ($pmpImageSpeed / 1000); ?> Seconds.</div>
      <div id="bottom" align="center" class="center"></div>
    </div>
  </body>

</html>
