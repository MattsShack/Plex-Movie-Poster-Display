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
    <!-- Text Scaler -->
    <script src="assets/fitty/fitty.js"></script>
    <!-- Bootstrap JavaScript-->
    <script src="assets/bootstrap-4.3.1/js/bootstrap.min.js"></script>

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="assets/bootstrap-4.3.1/css/bootstrap.min.css">

    <!-- Default Poster Template CSS -->
    <link rel="stylesheet" href="assets/styles/default/poster.css">
    <style>
        .comingSoonTop {
            font-size: <?php echo $comingSoonTopFontSize?>px;
        }
        .comingSoonBottom {
            font-size: <?php echo $comingSoonBottomFontSize?>px;
        }
        .nowPlayingTop {
            font-size: <?php echo $nowShowingTopFontSize?>px;
        }
        .nowPlayingBottom {
            font-size: <?php echo $nowShowingBottomFontSize?>px;
        }
    </style>

    <script>
        $(function () {
            $.getJSON('getData.php', function (data) {
                $.each(data, function (key, val) {
                    if (key == "middle") {
                        $('#' + key).css('background-image', val);
                    } else {
                        $('#' + key).html(val);
                    }
                });
                fitty('.userText', {maxSize: 100, minSize: 10});
                fitty.fitAll();
            });
        });

        $(document).ready(
            function () {
                setInterval(function () {
                    $.getJSON('getData.php', function (data) {
                        $.each(data, function (key, val) {
                            if (key == "middle") {
                                $('#' + key).css('background-image', val);
                            } else {
                                $('#' + key).html(val);
                            }
                        });
                    });
                    fitty('.userText', {maxSize: 100, minSize: 10});
                    fitty.fitAll();
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