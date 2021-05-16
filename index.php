<?php
//For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
include_once('config.php');
include_once('assets/plexmovieposter/tokenCheck.php');
include 'assets/plexmovieposter/CommonLib.php';
include 'assets/plexmovieposter/tools.php';
include 'status.php';
include 'statusRefresh.php';

// $pmpImageSpeed = ($pmpImageSpeed * 1000);
if (empty($currentRefreshSpeed)) {
    $currentRefreshSpeed = 30;
}

$pmpImageSpeed = ($currentRefreshSpeed * 1000);
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
                    switch(key) {
                        // case "refreshSpeed":
                        //     var tmpRefreshSpeed = parseInt(val);
                        //     var currRefreshSpeed = parseInt(<?php echo $currentRefreshSpeed ?>);
                        //     if (tmpRefreshSpeed != currRefreshSpeed) {
                        //         // document.write("Refresh out of sync");
                        //         location.reload(true);
                        //     }
                        //     break;
                        case "middle":
                            $('#' + key).css('background-image', val);
                            break;
                        case "mediaArt":
                            $('.' + key).css('background-image', val);
                            break;
                        case 'fullScreenMode':
                            var SetMode = val;
                            if (SetMode == true) {
                                //  document.write("fullScreenMode");
                                $('.' + "mediaArt").css('filter', "none");
                                $('.' + "mediaArt").css('-webkit-filter', "none");
                                // $('.' + "mediaArt").css('background-size', "auto 100%");
                                $('.' + "mediaArt").css('background-size', "contain");
                            }
                            else {
                                //  document.write("fullScreenMode");
                                $('.' + "mediaArt").css('filter', "blur(8px)");
                                $('.' + "mediaArt").css('-webkit-filter', "blur(8px)");
                                $('.' + "mediaArt").css('background-size', "cover");
                                }
                            break;
                        default:
                            $('#' + key).html(val);
                            break;
                    }
                });
            });

            // Press 's' key will bring up the settings page.
            // onkeypress - The Unicode CHARACTER code is: 115
            // onkeydown - The Unicode KEY code is: 83
            // https://www.w3schools.com/jsref/tryit.asp?filename=tryjsref_event_key_keycode2
            $(document).keypress(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                console.log("Keypress: " + keycode);
                // if (keycode == '115') {
                //     $('#myModal').modal({show:true});
                //     $("#settingFrame").attr('src', 'settings/general.php');
                // }
                switch (keycode) {
                    case 115: // 's'
                        $('#myModal').modal({show:true});
                        $("#settingFrame").attr('src', 'settings/general.php');
                        break;
                    // case 105: // 'i'
                    //     $('#myModal').modal({show:true});
                    //     $("#settingFrame").attr('src', '');
                    //     break;
                    default:
                        break;
                }
            });

            $('#myModal').on('hidden.bs.modal', function(){
                $('#settingFrame').html("").attr("src", "");
            });

            setInterval(function () {
                $.getJSON('getData.php', function (data) {
                    $.each(data, function (key, val) {
                        switch(key) {
                            case "refreshSpeed":
                                var tmpRefreshSpeed = parseInt(val);
                                var currRefreshSpeed = parseInt(<?php echo $currentRefreshSpeed ?>);
                                if (tmpRefreshSpeed != currRefreshSpeed) {
                                    // document.write("Refresh out of sync");
                                    location.reload(true);
                                }
                                break;
                            case "middle":
                                $('#' + key).css('background-image', val);
                                break;
                            case "mediaArt":
                                $('.' + key).css('background-image', val);
                                break;
                            case 'fullScreenMode':
                                var SetMode = val;
                                if (SetMode == true) {
                                    //  document.write("fullScreenMode");
                                    $('.' + "mediaArt").css('filter', "none");
                                    $('.' + "mediaArt").css('-webkit-filter', "none");
                                    // $('.' + "mediaArt").css('background-size', "auto 100%");
                                    $('.' + "mediaArt").css('background-size', "contain");
                                } 
                                else {
                                    //  document.write("fullScreenMode");
                                    $('.' + "mediaArt").css('filter', "blur(8px)");
                                    $('.' + "mediaArt").css('-webkit-filter', "blur(8px)");
                                    $('.' + "mediaArt").css('background-size', "cover");
                                }
                            break;
                            default:
                                $('#' + key).html(val);
                                break;
                        }
                    });
                });
            }, <?php echo $pmpImageSpeed; ?>);
        });

    </script>
</head>

<body>
    <div class="mediaArt"></div>

    <div id="container">
        <div id="alert" align="center" class="center"></div>
        <div id="top" style="overflow: hidden;" align="center" class="center"></div>
        <div id="progress" class="center"></div>
        <div id="middle" class="middle"></div>
        <div id="bottom" style="overflow: hidden;" align="center" class="center"></div>
    </div>

    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bmd-modalContent">
                <div class="modal-body">
                    <div class="close-button">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <iframe class="embed-responsive-item" id='settingFrame' frameborder="0"></iframe>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</body>

</html>
