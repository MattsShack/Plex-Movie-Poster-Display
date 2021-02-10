<?php
//For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
include_once('config.php');
include_once('assets/plexmovieposter/tokenCheck.php');
include 'assets/plexmovieposter/CommonLib.php';
include 'assets/plexmovieposter/tools.php';
$pmpImageSpeed = ($pmpImageSpeed * 1000);
?>

<!doctype html>
<html lang="en">
<head>
    <?php HeaderInfo(basename(__FILE__)); ?>
    
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
            });

            $(document).keypress(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                console.log("Keypress: " + keycode);
                if(keycode == '115'){
                    $('#myModal').modal({show:true});
                    $("#settingFrame").attr('src', 'admin.php');
                }

            });

                $('#myModal').on('hidden.bs.modal', function(){
                    $('#settingFrame').html("").attr("src", "");
                });

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
            }, <?php echo $pmpImageSpeed; ?>);
        });

    </script>
</head>

<body>
<div id="container">
<!-- <div id="container" style="background-image: url('/cache/art/####'); background-repeat: no-repeat; background-attachment: fixed; background-size: cover;"> -->
    <div id="alert" align="center" class="center"></div>
    <div id="top" style="overflow: hidden;" align="center" class="center"></div>
    <div id="middle" class="middle"></div>
    <div id="bottom" style="overflow: hidden;" align="center" class="center"></div>
</div>
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bmd-modalContent">

            <div class="modal-body">

                <div class="close-button">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <iframe class="embed-responsive-item" id='settingFrame' frameborder="0"></iframe>

            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</body>

</html>
