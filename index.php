<html>
    <head>
    <title></title>
 
    <script type="text/javascript" src="assets/js/jquery-3.0.0.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/PieBox.css">
 
    <script>
        $(document).ready(
            function() {
                setInterval(function() {
                    $.getJSON('getData.php',function(data) {
                        $.each(data, function(key, val) {
                            $('#'+key).html(val);
                        });
                    });
                }, 30000);
            });
    </script>
    </head>
 
    <body>
        <div id="container">
            <div id="alert" align="center" class="center"></div>
            <div id="top" align="center" class="center"></div>
            <div id="middle" class="middle">Loading...</div>
            <div id="bottom" align="center" class="center"></div>
        </div>
    </body>
</html>
