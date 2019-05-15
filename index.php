<?php 
  //For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
  include_once('config.php');
  $pmpImageSpeed = ($pmpImageSpeed * 1000);
?>

<html>
  <head>
    <title>Plex Movie Poster Display</title>

    <!-- JQuery -->
    <script src="assets/jquery-3.4.0/jquery-3.4.0.min.js"></script>
    <script src="assets/jquery-3.4.0/jquery.marquee.min.js"></script>
    <script src="assets/jquery-3.4.0/jquery.easing.min.js"></script>

    <!-- Bootstrap JavaScript-->
    <script src="assets/bootstrap-4.3.1/js/bootstrap.min.js"></script>

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="assets/bootstrap-4.3.1/css/bootstrap.min.css">

    <!-- Default Poster Template CSS -->
    <link rel="stylesheet" href="assets/styles/default/poster.css">

    <script>
      $(function(){
        $.getJSON('getData.php',function(data) {
          $.each(data, function(key, val) {
            $('#'+key).html(val);
           });
         });
      });

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
      <div id="top" style="overflow: hidden;" align="center" class="center"></div>
      <div id="middle" class="middle"></div>
      <div id="bottom" style="overflow: hidden;" align="center" class="center"></div>
    </div>
  </body>

</html>