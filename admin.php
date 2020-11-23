<?php
//For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
include_once('loginCheck.php');

//Clear Poster Cache Directory
if (!empty($_POST['clearPosterCache'])) {
    $files = glob('cache/posters/*');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
}

//Clear Custom Cache Directory
if (!empty($_POST['clearCustomCache'])) {
    $files = glob('cache/custom/*');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
}

if (!empty($_POST['saveConfig'])) {
    //Custom Image Upload
    if ($_FILES['customImageUpload'] != "") {
        $uploaddir = 'cache/custom/';
        $uploadfile = $uploaddir . basename($_FILES['customImageUpload']['name']);

        if (move_uploaded_file($_FILES['customImageUpload']['tmp_name'], $uploadfile)) {
        } else {
            $uploadfile = $_POST['customImageUpload'];
        }
    }

    //Define Config File
    $myfile = fopen("config.php", "w") or die("Unable to open file!");

    //FixUP POST Data
    $_POST = array_map("stripslashes", $_POST);

    //Create New Config
    $newConfig = "
<?php
//PMPD Configuration
\$pmpConfigVersion = '2';
\$pmpUsername = '$_POST[pmpUsername]';
\$pmpPassword = '$_POST[pmpPassword]';
\$pmpClearImageCache = 'Yes'; //Default Yes
\$pmpImageSpeed = '$_POST[pmpImageSpeed]'; //Default 30 Seconds
\$pmpPosterDir = 'cache/posters/'; //Default cache/posters/ (FUTURE)
\$pmpCustomDir = 'cache/custom/'; //Default cache/custom/ (FUTURE)

//Server Configuration
\$plexServer = '$_POST[plexServer]';
\$plexToken = '$_POST[plexToken]';
\$plexServerMovieSection = '$_POST[plexServerMovieSection]';
\$cacheEnabled = '$_POST[cacheEnabled]'; //Default true

//Client Configuration
\$plexClient = '$_POST[plexClient]';
\$plexClientName = '$_POST[plexClientName]';

//Custom Image Configuration
\$customImageEnabled = '$_POST[customImageEnabled]'; //Default: Disabled
\$customImage = '$_POST[customImage]';
\$customTopText = '$_POST[customTopText]';
\$customTopFontSize = '$_POST[customTopFontSize]'; //Default: 55 (px)
\$customTopFontColor = '$_POST[customTopFontColor]'; //Default: #FFFF00 (Yellow)
\$customTopFontOutlineSize = '$_POST[customTopFontOutlineSize]'; //Default: 2 (px)
\$customTopFontOutlineColor = '$_POST[customTopFontOutlineColor]'; //Default: #FFFF00 (Yellow)
\$customBottomText = '$_POST[customBottomText]';
\$customBottomFontSize = '$_POST[customBottomFontSize]'; //Default: 25 (px)
\$customBottomFontColor = '$_POST[customBottomFontColor]'; //Default: #FFFFFF (White)
\$customBottomFontOutlineSize = '$_POST[customBottomFontOutlineSize]'; //Default: 2 (px)
\$customBottomFontOutlineColor = '$_POST[customBottomFontOutlineColor]'; //Default: #FFFF00 (Yellow)

//Coming Soon Configuration
\$comingSoonTop = '$_POST[comingSoonTop]'; //Default: custom (title/summary/tagline/custom)
\$comingSoonTopAutoScale = '$_POST[comingSoonTopAutoScale]'; //Default: false
\$comingSoonTopText = '$_POST[comingSoonTopText]';
\$comingSoonTopFontSize = '$_POST[comingSoonTopFontSize]'; //Default: 55 (px)
\$comingSoonTopFontColor = '$_POST[comingSoonTopFontColor]'; //Default: #FFFF00 (Yellow)
\$comingSoonTopFontOutlineSize = '$_POST[comingSoonTopFontOutlineSize]'; //Default: 2 (px)
\$comingSoonTopFontOutlineColor = '$_POST[comingSoonTopFontOutlineColor]'; //Default: #FFFF00 (Yellow)
\$showComingSoonInfo = '$_POST[showComingSoonInfo]'; //Default: false
\$comingSoonBottom = '$_POST[comingSoonBottom]'; //Default: custom (title/summary/tagline/custom)
\$comingSoonBottomText = '$_POST[comingSoonBottomText]';
\$comingSoonBottomAutoScale = '$_POST[comingSoonBottomAutoScale]'; //Default: false
\$comingSoonBottomFontSize = '$_POST[comingSoonBottomFontSize]'; //Default: 25 (px)
\$comingSoonBottomFontColor = '$_POST[comingSoonBottomFontColor]'; //Default: #FFFFFF (White)
\$comingSoonBottomFontOutlineSize = '$_POST[comingSoonBottomFontOutlineSize]'; //Default: 2 (px)
\$comingSoonBottomFontOutlineColor = '$_POST[comingSoonBottomFontOutlineColor]'; //Default: #FFFF00 (Yellow)
\$comingSoonShowSelection = '$_POST[comingSoonShowSelection]'; //Default: unwatched

//Now Showing Configuration
\$nowShowingTop = '$_POST[nowShowingTop]'; //Default: custom (title/summary/tagline/custom)
\$nowShowingTopAutoScale = '$_POST[nowShowingTopAutoScale]'; //Default: false
\$nowShowingTopText = '$_POST[nowShowingTopText]';
\$nowShowingTopFontSize = '$_POST[nowShowingTopFontSize]'; //Default: 55 (px)
\$nowShowingTopFontColor = '$_POST[nowShowingTopFontColor]'; //Default: #FFFF00 (Yellow)
\$nowShowingTopFontOutlineSize = '$_POST[nowShowingTopFontOutlineSize]'; //Default: 2 (px)
\$nowShowingTopFontOutlineColor = '$_POST[nowShowingTopFontOutlineColor]'; //Default: #FFFF00 (Yellow)
\$nowShowingBottom = '$_POST[nowShowingBottom]'; //Default: title (title/summary/tagline/custom)
\$nowShowingBottomText = '$_POST[nowShowingBottomText]';
\$nowShowingBottomAutoScale = '$_POST[nowShowingBottomAutoScale]'; //Default: false
\$nowShowingBottomFontSize = '$_POST[nowShowingBottomFontSize]'; //Default: 25 (px)
\$nowShowingBottomFontColor = '$_POST[nowShowingBottomFontColor]'; //Default: #FFFFFF (White)
\$nowShowingBottomFontOutlineSize = '$_POST[nowShowingBottomFontOutlineSize]'; //Default: 2 (px)
\$nowShowingBottomFontOutlineColor = '$_POST[nowShowingBottomFontOutlineColor]'; //Default: #FFFF00 (Yellow)

//Misc Configuration
\$pmpDisplayProgress = '$_POST[pmpDisplayProgress]'; //Default: Disabled
\$pmpDisplayProgressSize = '$_POST[pmpDisplayProgressSize]'; //Default: 5 (px)
\$pmpDisplayProgressColor = '$_POST[pmpDisplayProgressColor]'; //Default: #FFFF00 (Yellow)
\$pmpDisplayClock = 'Disabled'; //Default: Disabled (FUTURE)
\$pmpBottomScroll = '$_POST[pmpBottomScroll]'; //Default: Disabled
\$pmpBottomScrollSpeed = '1'; //Default: 1 (FUTURE)";

    echo $newConfig;
    fwrite($myfile, $newConfig);
    sleep(1);
    fclose($myfile);
    header("Location: admin.php");
}

//Count Items in Posters
$posters = scandir('cache/posters');
$posterCount = count($posters) - 2;

//Count Items in Custom Images
$custom = scandir('cache/custom');
$customCount = count($custom) - 2;

//Fixup Size Calculations
function fixupSize($bytes)
{
    $places = '2';
    $size = array('B', 'KB', 'MB', 'GB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$places}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

include('config.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="www.mattsshack.com">
    <meta content="no-cache, no-store, must-revalidate" http-equiv="Cache-Control"/>
    <meta content="no-cache" http-equiv="Pragma"/>
    <meta content="0" http-equiv="Expires"/>

    <link rel="shortcut icon" type="image/png" href="assets/images/favicon-16x16.png"/>

    <title>PMPD Admin</title>

    <!-- JQuery -->
    <script src="assets/jquery-3.4.0/jquery-3.4.0.min.js"></script>

    <!-- Popper -->
    <script src="assets/popper/popper.min.js"></script>

    <!-- Bootstrap-->
    <script src="assets/bootstrap-4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/bootstrap-4.3.1/css/bootstrap.min.css">

    <!-- Bootstrap Colorpicker -->
    <link rel="stylesheet" href="assets/bootstrap-colorpicker/css/bootstrap-colorpicker.css">
    <script src="assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="assets/styles/default/style.css">
    <link rel="stylesheet" href="assets/styles/default/form-validation.css">

    <script>
        $(document).ready(function(){

            $('.showhideconfigButton').click(function(){
            if ( this.value === 'Hide' ) {
                // if it's open close it
                open = false;
                this.value = 'Show';
                $(this).next("div.showhideconfig").hide("fast");
            }
            else {
                // if it's close open it
                open = true;
                this.value = 'Hide';
                // $(this).siblings("[value='Hide']").click(); //to collapse the open divs - Disabled to allow for all divs to stay open
                $(this).next("div.showhideconfig").show("fast");
            }
            });

        });
    </script>

</head>

<body class="bg-light">
<div class="container">
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="assets/images/android-chrome-192x192.png" alt="" width="192"
             height="192">
        <h2>Plex Movie Poster Display</h2>
        <p class="text-muted text-center text-small">
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#Server">Server</a></li>
            <li class="list-inline-item"><a href="#Client">Client</a></li>
            <li class="list-inline-item"><a href="#ComingSoon">Coming Soon</a></li>
            <li class="list-inline-item"><a href="#NowShowing">Now Showing</a></li>
            <li class="list-inline-item"><a href="#CustomImages">Custom Images</a></li>
            <li class="list-inline-item"><a href="logout.php">Logout</a></li>
        </ul>
        </p>
        <p class="small">Please allow <?php echo $pmpImageSpeed; ?> seconds for display to update with changes.</p>
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Stats</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Posters</h6>
                        <small class="text-muted">Items in cache/posters</small>
                    </div>
                    <span class="text-muted"><?php echo $posterCount; ?></span>
                    <form method="post" class="needs-validation" novalidate>
                        <button name="clearPosterCache" type="submit" class="btn btn-danger btn-sm"
                                value="clearPosterCache">Clear
                        </button>
                    </form>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Custom Images</h6>
                        <small class="text-muted">Items in cache/custom</small>
                    </div>
                    <span class="text-muted"><?php echo $customCount; ?></span>
                    <form method="post" class="needs-validation" novalidate>
                        <button name="clearCustomCache" type="submit" class="btn btn-danger btn-sm"
                                value="clearCustomCache">Clear
                        </button>
                    </form>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Free Space</h6>
                        <small class="text-muted">Free space on /</small>
                    </div>
                    <span class="text-muted"><?php echo fixupSize(disk_free_space("/")); ?></span>
                </li>
            </ul>
        </div>

        <div class="col-md-8 order-md-1">
            
            <!-- Security Configuration -->
            <h4 class="mb-3"><a name="Server"></a>Security Configuration</h4>
            <input class="btn btn-secondary showhideconfigButton" type="button" value="Show"></input>
            <div class="showhideconfig">
                <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                    <div class="mb-3">

                        <div class="form-alignment input-group">
                            <label for="pmpUsername">Username:&nbsp;</label>
                            <input type="text" class="fieldInfo-username form-control" id="pmpUsername" name="pmpUsername"
                                placeholder="Username" value="<?php echo $pmpUsername; ?>" required>
                            <div class="invalid-feedback" style="width: 100%;">
                                Movie Poster Display Username.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-alignment input-group" id="password_view">
                        <label for="pmpPassword">Password:&nbsp;&nbsp;</label>
                            <input type="password" class="fieldInfo-password form-control" id="pmpPassword" name="pmpPassword"
                                placeholder="Password" value="<?php echo $pmpPassword; ?>" required>
                                &nbsp;
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button" id="password_view_btn" onclick="passwordView()">Show</button>
                            </span>
                        </div>
                    </div>
            </div>
            
            <hr class="mb-4">

            <!-- Plex Movie Poster Display Common Configuration -->
            <h4 class="mb-3"><a name="Server"></a>Plex Movie Poster Display Common Configuration</h4>
            <input class="btn btn-secondary showhideconfigButton" type="button" value="Show"></input>
            <div class="showhideconfig">
                <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                    <div class="mb-3">
                        <div class="form-alignment input-group">
                            <!-- <label for="pmpImageSpeed">Poster Transition/Refresh Speed <small>(Seconds)</small>: &nbsp;</label> -->
                            <label for="pmpImageSpeed">Poster Transition/Refresh Speed: &nbsp;</label>
                            <input type="text" class="fieldInfo-xsmall form-control" id="pmpImageSpeed" name="pmpImageSpeed"
                                placeholder="Poster Transition Speed" value="<?php echo $pmpImageSpeed; ?>" required>
                            <div class="fieldInfo-group-text input-group-prepend">
                                <div class=" input-group-text">Seconds</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-alignment input-group">
                            <label for="pmpBottomScroll">Bottom Scrolling Text: &nbsp;</label>
                            <select class="fieldInfo-select custom-select d-block w-100" id="pmpBottomScroll" name="pmpBottomScroll">
                                <option value="Disabled" <?php if ($pmpBottomScroll == 'Disabled') {
                                    echo "selected";
                                } ?>>Disabled
                                </option>
                                <option value="Enabled" <?php if ($pmpBottomScroll == 'Enabled') {
                                    echo "selected";
                                } ?>>Enabled
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="input-group">
                            <label for="cacheEnabled" class="checkLabel">Cache Images</label>
                            <div class="form-check">
                                <input type="checkbox" name="cacheEnabled" class="form-check-input" id="cacheEnabled" value="1" <?php if ($cacheEnabled) echo " checked"?>>
                                <label class="form-check-label" for="cacheEnabled"></label>
                            </div>
                        </div>
                    </div>
            </div>

            <hr class="mb-4">

            <!-- Server Configuration -->
            <h4 class="mb-3"><a name="Server"></a>Server Configuration</h4>
            <input class="btn btn-secondary showhideconfigButton" type="button" value="Show">
            <div class="showhideconfig">
                <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                    <div class="mb-3">
                        <div class="form-alignment input-group">
                            <label for="plexServer">Plex Server IP:&nbsp;</label>
                            <input type="text" class="fieldInfo-ipaddress form-control" id="plexServer" name="plexServer" maxlength="15"
                                placeholder="Plex Server IP" value="<?php echo $plexServer; ?>" required>
                            <div class="invalid-feedback" style="width: 100%;">
                                A Plex server IP address is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-alignment input-group" id="token_view">
                            <label for="plexToken">Plex Token: <a
                                        href="https://support.plex.tv/hc/en-us/articles/204059436-Finding-your-account-token-X-Plex-Token"
                                        target=_blank><span class="badge badge-primary">?</span></a>&nbsp;</label>
                            <input type="password" class="fieldInfo-token form-control" id="plexToken" name="plexToken"
                                placeholder="Plex Token" value="<?php echo $plexToken; ?>" required>
                                &nbsp;
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button" id="token_view_btn" onclick="tokenView()">Show</button>
                            </span>
                            <div class="invalid-feedback" style="width: 100%;">
                                A Plex token is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-alignment input-group">
                        <label for="plexServerMovieSection">Plex Movie Sections <small>(Comma Separated with no Spaces)</small>:&nbsp;</label>
                            <input type="text" class="fieldInfo-medium form-control" id="plexServerMovieSection"
                                name="plexServerMovieSection" placeholder="Plex Movie Sections"
                                value="<?php echo $plexServerMovieSection; ?>" required>
                            <div class="invalid-feedback" style="width: 100%;">
                                At least one Plex movie sections is required.
                            </div>
                        </div>
                    </div>
            </div>

            <hr class="mb-4">

            <!-- Client Configuration -->
            <h4 class="mb-3"><a name="Client"></a>Client Configuration</h4>
            <input class="btn btn-secondary showhideconfigButton" type="button" value="Show">
            <div class="showhideconfig">
                <div class="mb-3">

                    <div class="form-alignment input-group">
                    <label for="plexClient">Plex Client IP: &nbsp;</label>
                        <input type="text" class="fieldInfo-ipaddress form-control" id="plexClient" name="plexClient" maxlength="15"
                            placeholder="Plex Client IP" value="<?php echo $plexClient; ?>" required>
                        <div class="invalid-feedback" style="width: 100%;">
                            A Plex client IP address is required.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-alignment input-group">
                        <label for="plexClient">Plex Client Name: &nbsp;</label>
                        <input type="text" class="fieldInfo-xlarge form-control" id="plexClientName" name="plexClientName"
                            placeholder="Plex Client Name" value="<?php echo $plexClientName; ?>">
                    </div>
                </div>
            </div>

            <hr class="mb-4">

            <!-- Coming Soon Configuration  -->
            <h4 class="mb-3"><a name="ComingSoon"></a>Coming Soon Configuration</h4>
            <input class="btn btn-secondary showhideconfigButton" type="button" value="Show">
            <div class="showhideconfig">
                <hr class="internalconfigbreak">

                <div class="mb-3">
                    <div class="form-alignment input-group">
                        <label for="comingSoonShowSelection">Show Movies: &nbsp;</label>
                        <select class="fieldInfo-select custom-select d-block w-100" id="comingSoonShowSelection"
                                name="comingSoonShowSelection">
                            <option value="unwatched" <?php if ($comingSoonShowSelection == 'unwatched') {
                                echo "selected";
                            } ?>>Unwatched
                            </option>
                            <option value="all" <?php if ($comingSoonShowSelection == 'all') {
                                echo "selected";
                            } ?>>All
                            </option>
                            <option value="recentlyAdded" <?php if ($comingSoonShowSelection == 'recentlyAdded') {
                                echo "selected";
                            } ?>>Recently Added
                            </option>
                            <option value="newest" <?php if ($comingSoonShowSelection == 'newest') {
                                echo "selected";
                            } ?>>Newest
                            </option>
                        </select>
                    </div>
                </div>

                <hr class="internalconfigbreak">

                <div class="mb-3">
                    <label for="comingSoonTop" class="checkLabel">Top Text Option:</label>
                    <div class="input-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="comingSoonTop" id="csb1" value="title"<?php if($comingSoonTop == 'title' || $comingSoonTop == '') echo " checked"?> onChange="comingSoonTopSelected()">
                            <label class="form-check-label" for="inlineRadio1">Title</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="comingSoonTop" id="csb2" value="summary"<?php if($comingSoonTop == 'summary') echo " checked"?> onChange="comingSoonTopSelected()">
                            <label class="form-check-label" for="inlineRadio2">Summary</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="comingSoonTop" id="csb3" value="tagline"<?php if($comingSoonTop == 'tagline') echo " checked"?> onChange="comingSoonTopSelected()">
                            <label class="form-check-label" for="inlineRadio2">Tagline</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="comingSoonTop" id="csb4" value="custom"<?php if($comingSoonTop == 'custom') echo " checked"?> onChange="comingSoonTopSelected()">
                            <label class="form-check-label" for="inlineRadio3">Custom</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="comingSoonTopText">Custom Top Text</label>
                    <span class="text-muted"><small>(Optional)</small>:</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="comingSoonTopText" name="comingSoonTopText"
                            placeholder="Coming Soon Top Text" value="<?php echo $comingSoonTopText; ?>" readonly="readonly">
                    </div>
                </div>

                <script>
                    $(function(){
                        //First call for the load
                        comingSoonTopSelected();

                        //Second call for change event
                        $("input[type=radio]").change( comingSoonTopSelected );
                    });

                    function comingSoonTopSelected() {
                        // readonly: input can't be modified
                        // disabled: input has no form function
                        var result = document.querySelector('input[name="comingSoonTop"]:checked').value;
                        if(result=="custom") {
                            // document.getElementById("comingSoonTopText").setAttribute('disabled', true);
                            document.getElementById("comingSoonTopText").removeAttribute('readonly');
                        }
                        else {
                            document.getElementById("comingSoonTopText").setAttribute('readonly', true);
                            // document.getElementById("comingSoonTopText").removeAttribute('disabled');
                        }
                    }
                </script>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="comingSoonTopFontSize">Top Font Size:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="comingSoonTopFontSize"
                                name="comingSoonTopFontSize" value="<?php echo $comingSoonTopFontSize; ?>">
                            <div class="input-group-prepend">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="comingSoonTopFontColor">Top Font Color:</label>
                        <div class="input-group">
                            <input type="text" id="comingSoonTopFontColor" name="comingSoonTopFontColor"
                                class="form-control" data-position="bottom left"
                                value="<?php echo $comingSoonTopFontColor; ?>">
                        </div>
                    </div>
                </div>

                <script>
                    $(function () {
                        $('#comingSoonTopFontColor').colorpicker();
                        $('#comingSoonTopFontColor').on('colorpickerChange', function (event) {
                            $('.jumbotron').css('background-color', event.color.toString());
                        });
                    });
                </script>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="comingSoonTopFontOutlineSize">Top Font Outline Size:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="comingSoonTopFontOutlineSize"
                                name="comingSoonTopFontOutlineSize"
                                value="<?php echo $comingSoonTopFontOutlineSize; ?>">
                            <div class="input-group-prepend">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="comingSoonTopFontOutlineColor">Top Font Outline Color:</label>
                        <div class="input-group">
                            <input type="text" id="comingSoonTopFontOutlineColor"
                                name="comingSoonTopFontOutlineColor" class="form-control"
                                data-position="bottom left"
                                value="<?php echo $comingSoonTopFontOutlineColor; ?>">
                        </div>
                    </div>
                </div>

                <script>
                    $(function () {
                        $('#comingSoonTopFontOutlineColor').colorpicker();
                        $('#comingSoonTopFontOutlineColor').on('colorpickerChange', function (event) {
                            $('.jumbotron').css('background-color', event.color.toString());
                        });
                    });
                </script>

                <div class="mb-3">
                    <div class="input-group">
                        <label for="comingSoonTopAutoScale" class="checkLabel">Auto-scale top text</label>
                        <div class="form-check">
                            <input type="checkbox" name="comingSoonTopAutoScale" class="form-check-input" id="comingSoonTopAutoScale" value="1" <?php if ($comingSoonTopAutoScale) echo " checked"?>>
                        </div>
                    </div>
                </div>

                <hr class="internalconfigbreak">

                <div class="mb-3">
                    <label for="comingSoonBottom" class="checkLabel">Bottom Text Option:</label>
                    <div class="input-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="comingSoonBottom" id="csb1" value="title"<?php if($comingSoonBottom == 'title' || $comingSoonBottom == '') echo " checked"?> onChange="comingSoonBottomSelected()">
                            <label class="form-check-label" for="inlineRadio1">Title</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="comingSoonBottom" id="csb2" value="summary"<?php if($comingSoonBottom == 'summary') echo " checked"?> onChange="comingSoonBottomSelected()">
                            <label class="form-check-label" for="inlineRadio2">Summary</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="comingSoonBottom" id="csb3" value="tagline"<?php if($comingSoonBottom == 'tagline') echo " checked"?> onChange="comingSoonBottomSelected()">
                            <label class="form-check-label" for="inlineRadio2">Tagline</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="comingSoonBottom" id="csb4" value="custom"<?php if($comingSoonBottom == 'custom') echo " checked"?> onChange="comingSoonBottomSelected()">
                            <label class="form-check-label" for="inlineRadio3">Custom</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="comingSoonBottomText">Custom Bottom Text</label>
                    <span class="text-muted"><small>(Optional)</small>:</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="comingSoonBottomText"
                            name="comingSoonBottomText" placeholder="Coming Soon Bottom Text"
                            value="<?php echo $comingSoonBottomText; ?>" readonly="readonly">
                    </div>
                </div>

                <script>
                    $(function(){
                        //First call for the load
                        comingSoonBottomSelected();

                        //Second call for change event
                        $("input[type=radio]").change( comingSoonBottomSelected );
                    });

                    function comingSoonBottomSelected() {
                        // readonly: input can't be modified
                        // disabled: input has no form function
                        var result = document.querySelector('input[name="comingSoonBottom"]:checked').value;
                        if(result=="custom") {
                            // document.getElementById("comingSoonBottomText").setAttribute('disabled', true);
                            document.getElementById("comingSoonBottomText").removeAttribute('readonly');
                        }
                        else {
                            document.getElementById("comingSoonBottomText").setAttribute('readonly', true);
                            // document.getElementById("comingSoonBottomText").removeAttribute('disabled');
                        }
                    }
                </script>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="comingSoonBottomFontSize">Bottom Font Size:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="comingSoonBottomFontSize"
                                name="comingSoonBottomFontSize" value="<?php echo $comingSoonBottomFontSize; ?>">
                            <div class="input-group-prepend">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="comingSoonBottomFontColor">Bottom Font Color:</label>
                        <div class="input-group">
                            <input type="text" id="comingSoonBottomFontColor" name="comingSoonBottomFontColor"
                                class="form-control" data-position="bottom left"
                                value="<?php echo $comingSoonBottomFontColor; ?>">
                        </div>
                    </div>
                </div>

                <script>
                    $(function () {
                        $('#comingSoonBottomFontOutlineColor').colorpicker();
                        $('#comingSoonBottomFontOutlineColor').on('colorpickerChange', function (event) {
                            $('.jumbotron').css('background-color', event.color.toString());
                        });
                    });
                </script>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="comingSoonBottomFontOutlineSize">Bottom Font Outline Size:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="comingSoonBottomFontOutlineSize"
                                name="comingSoonBottomFontOutlineSize"
                                value="<?php echo $comingSoonBottomFontOutlineSize; ?>">
                            <div class="input-group-prepend">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="comingSoonBottomFontOutlineColor">Bottom Font Outline Color:</label>
                        <div class="input-group">
                            <input type="text" id="comingSoonBottomFontOutlineColor"
                                name="comingSoonBottomFontOutlineColor" class="form-control"
                                data-position="bottom left"
                                value="<?php echo $comingSoonBottomFontOutlineColor; ?>">
                        </div>
                    </div>

                    <script>
                        $(function () {
                            $('#comingSoonBottomFontColor').colorpicker();
                            $('#comingSoonBottomFontColor').on('colorpickerChange', function (event) {
                                $('.jumbotron').css('background-color', event.color.toString());
                            });
                        });
                    </script>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <label for="comingSoonBottomAutoScale" class="checkLabel">Auto-scale bottom text</label>
                        <div class="form-check">
                            <input type="checkbox" name="comingSoonBottomAutoScale" class="form-check-input" id="comingSoonBottomAutoScale" value="1" <?php if ($comingSoonBottomAutoScale) echo " checked"?>>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="mb-4">

            <!-- Now Showing Configuration -->
            <h4 class="mb-3"><a name="NowShowing"></a>Now Showing Configuration</h4>
            <input class="btn btn-secondary showhideconfigButton" type="button" value="Show">
            <div class="showhideconfig">
                <hr class="internalconfigbreak">

                <div class="mb-3">
                    <label for="nowShowingTop" class="checkLabel">Top Text Option:</label>
                    <div class="input-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="nowShowingTop" id="csb1" value="title"<?php if($nowShowingTop == 'title' || $nowShowingTop == '') echo " checked"?> onChange="nowShowingTopSelected()">
                            <label class="form-check-label" for="inlineRadio1">Title</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="nowShowingTop" id="csb2" value="summary"<?php if($nowShowingTop == 'summary') echo " checked"?> onChange="nowShowingTopSelected()">
                            <label class="form-check-label" for="inlineRadio2">Summary</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="nowShowingTop" id="csb3" value="tagline"<?php if($nowShowingTop == 'tagline') echo " checked"?> onChange="nowShowingTopSelected()">
                            <label class="form-check-label" for="inlineRadio2">Tagline</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="nowShowingTop" id="csb4" value="custom"<?php if($nowShowingTop == 'custom') echo " checked"?> onChange="nowShowingTopSelected()">
                            <label class="form-check-label" for="inlineRadio3">Custom</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="nowShowingTopText">Custom Top Text</label>
                    <span class="text-muted"><small>(Optional)</small>:</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="nowShowingTopText" name="nowShowingTopText"
                            placeholder="Now Showing Top Text" value="<?php echo $nowShowingTopText; ?>" readonly="readonly">
                    </div>
                </div>

                <script>
                    $(function(){
                        //First call for the load
                        nowShowingTopSelected();

                        //Second call for change event
                        $("input[type=radio]").change( nowShowingTopSelected );
                    });

                    function nowShowingTopSelected() {
                        // readonly: input can't be modified
                        // disabled: input has no form function
                        var result = document.querySelector('input[name="nowShowingTop"]:checked').value;
                        if(result=="custom") {
                            // document.getElementById("nowShowingTopText").setAttribute('disabled', true);
                            document.getElementById("nowShowingTopText").removeAttribute('readonly');
                        }
                        else {
                            document.getElementById("nowShowingTopText").setAttribute('readonly', true);
                            // document.getElementById("nowShowingTopText").removeAttribute('disabled');
                        }
                    }
                </script>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nowShowingTopFontSize">Top Font Size:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nowShowingTopFontSize"
                                name="nowShowingTopFontSize" value="<?php echo $nowShowingTopFontSize; ?>">
                            <div class="input-group-prepend">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="nowShowingTopFontColor">Top Font Color:</label>
                        <div class="input-group">
                            <input type="text" id="nowShowingTopFontColor" name="nowShowingTopFontColor"
                                class="form-control" data-position="bottom left"
                                value="<?php echo $nowShowingTopFontColor; ?>">
                        </div>
                    </div>
                </div>

                <script>
                    $(function () {
                        $('#nowShowingTopFontColor').colorpicker();
                        $('#nowShowingTopFontColor').on('colorpickerChange', function (event) {
                            $('.jumbotron').css('background-color', event.color.toString());
                        });
                    });
                </script>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nowShowingTopFontOutlineSize">Top Font Outline Size:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nowShowingTopFontOutlineSize"
                                name="nowShowingTopFontOutlineSize"
                                value="<?php echo $nowShowingTopFontOutlineSize; ?>">
                            <div class="input-group-prepend">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="nowShowingTopFontOutlineColor">Top Font Outline Color:</label>
                        <div class="input-group">
                            <input type="text" id="nowShowingTopFontOutlineColor"
                                name="nowShowingTopFontOutlineColor" class="form-control"
                                data-position="bottom left"
                                value="<?php echo $nowShowingTopFontOutlineColor; ?>">
                        </div>
                    </div>
                </div>

                <script>
                    $(function () {
                        $('#nowShowingTopFontOutlineColor').colorpicker();
                        $('#nowShowingTopFontOutlineColor').on('colorpickerChange', function (event) {
                            $('.jumbotron').css('background-color', event.color.toString());
                        });
                    });
                </script>

                <div class="mb-3">
                    <div class="input-group">
                        <label for="nowShowingTopAutoScale" class="checkLabel">Auto-scale top text</label>
                        <div class="form-check">
                            <input type="checkbox" name="nowShowingTopAutoScale" class="form-check-input" id="nowShowingTopAutoScale" value="1" <?php if ($nowShowingTopAutoScale) echo " checked"?>>
                        </div>
                    </div>
                </div>

                <hr class="internalconfigbreak">

                <div class="mb-3">
                    <label for="nowShowingBottom" class="checkLabel">Bottom Text Option:</label>
                    <div class="input-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="nowShowingBottom" id="csb1" value="title"<?php if($nowShowingBottom == 'title' || $nowShowingBottom == '') echo " checked"?> onChange="nowShowingBottomSelected()">
                            <label class="form-check-label" for="inlineRadio1">Title</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="nowShowingBottom" id="csb2" value="summary"<?php if($nowShowingBottom == 'summary') echo " checked"?> onChange="nowShowingBottomSelected()">
                            <label class="form-check-label" for="inlineRadio2">Summary</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="nowShowingBottom" id="csb3" value="tagline"<?php if($nowShowingBottom == 'tagline') echo " checked"?> onChange="nowShowingBottomSelected()">
                            <label class="form-check-label" for="inlineRadio2">Tagline</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="nowShowingBottom" id="csb4" value="custom"<?php if($nowShowingBottom == 'custom') echo " checked"?> onChange="nowShowingBottomSelected()">
                            <label class="form-check-label" for="inlineRadio3">Custom</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="nowShowingBottomText">Custom Bottom Text</label>
                    <span class="text-muted"><small>(Optional)</small>:</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="nowShowingBottomText"
                            name="nowShowingBottomText" placeholder="Now Showing Bottom Text"
                            value="<?php echo $nowShowingBottomText; ?>" readonly="readonly">
                    </div>
                </div>

                <script>
                    $(function(){
                        //First call for the load
                        nowShowingBottomSelected();

                        //Second call for change event
                        $("input[type=radio]").change( nowShowingBottomSelected );
                    });

                    function nowShowingBottomSelected() {
                        // readonly: input can't be modified
                        // disabled: input has no form function
                        var result = document.querySelector('input[name="nowShowingBottom"]:checked').value;
                        if(result=="custom") {
                            // document.getElementById("nowShowingBottomText").setAttribute('disabled', true);
                            document.getElementById("nowShowingBottomText").removeAttribute('readonly');
                        }
                        else {
                            document.getElementById("nowShowingBottomText").setAttribute('readonly', true);
                            // document.getElementById("nowShowingBottomText").removeAttribute('disabled');
                        }
                    }
                </script>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nowShowingBottomFontSize">Bottom Font Size:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nowShowingBottomFontSize"
                                name="nowShowingBottomFontSize" value="<?php echo $nowShowingBottomFontSize; ?>">
                            <div class="input-group-prepend">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="nowShowingBottomFontColor">Bottom Font Color:</label>
                        <div class="input-group">
                            <input type="text" id="nowShowingBottomFontColor" name="nowShowingBottomFontColor"
                                class="form-control" data-position="bottom left"
                                value="<?php echo $nowShowingBottomFontColor; ?>">
                        </div>
                    </div>
                </div>

                <script>
                    $(function () {
                        $('#nowShowingBottomFontColor').colorpicker();
                        $('#nowShowingBottomFontColor').on('colorpickerChange', function (event) {
                            $('.jumbotron').css('background-color', event.color.toString());
                        });
                    });
                </script>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nowShowingBottomFontOutlineSize">Bottom Font Outline Size:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nowShowingBottomFontOutlineSize"
                                name="nowShowingBottomFontOutlineSize"
                                value="<?php echo $nowShowingBottomFontOutlineSize; ?>">
                            <div class="input-group-prepend">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="nowShowingBottomFontOutlineColor">Bottom Font Outline Color:</label>
                        <div class="input-group">
                            <input type="text" id="nowShowingBottomFontOutlineColor"
                                name="nowShowingBottomFontOutlineColor" class="form-control"
                                data-position="bottom left"
                                value="<?php echo $nowShowingBottomFontOutlineColor; ?>">
                        </div>
                    </div>

                    <script>
                        $(function () {
                            $('#nowShowingBottomFontOutlineColor').colorpicker();
                            $('#nowShowingBottomFontOutlineColor').on('colorpickerChange', function (event) {
                                $('.jumbotron').css('background-color', event.color.toString());
                            });
                        });
                    </script>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <label for="nowShowingBottomAutoScale" class="checkLabel">Auto-scale bottom text</label>
                        <div class="form-check">
                            <input type="checkbox" name="nowShowingBottomAutoScale" class="form-check-input" id="nowShowingBottomAutoScale" value="1" <?php if ($nowShowingBottomAutoScale) echo " checked"?>>
                        </div>
                    </div>
                </div>

                <hr class="internalconfigbreak">

                <div class="mb-3">
                    <div class="form-alignment input-group">
                        <label for="pmpDisplayProgress">Progress Bar: &nbsp;</label>
                        <select class="fieldInfo-select custom-select d-block w-100" id="pmpDisplayProgress" name="pmpDisplayProgress">
                            <option value="Disabled" <?php if ($pmpDisplayProgress == 'Disabled') {
                                echo "selected";
                            } ?>>Disabled
                            </option>
                            <option value="Enabled" <?php if ($pmpDisplayProgress == 'Enabled') {
                                echo "selected";
                            } ?>>Enabled
                            </option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="pmpDisplayProgressSize">Progress Bar Height:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="pmpDisplayProgressSize"
                                name="pmpDisplayProgressSize" value="<?php echo $pmpDisplayProgressSize; ?>">
                            <div class="input-group-prepend">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="pmpDisplayProgressColor">Progress Bar Color:</label>
                        <div class="input-group">
                            <input type="text" id="pmpDisplayProgressColor" name="pmpDisplayProgressColor"
                                class="form-control" data-position="bottom left"
                                value="<?php echo $pmpDisplayProgressColor; ?>">
                        </div>
                    </div>

                    <script>
                        $(function () {
                            $('#pmpDisplayProgressColor').colorpicker();
                            $('#pmpDisplayProgressColor').on('colorpickerChange', function (event) {
                                $('.jumbotron').css('background-color', event.color.toString());
                            });
                        });
                    </script>
                </div>
            </div>

            <hr class="mb-4">

            <!-- Custom Images Configuration -->
            <h4 class="mb-3"><a name="CustomImages"></a>Custom Images Configuration</h4>
            <input class="btn btn-secondary showhideconfigButton" type="button" value="Show">
            <div class="showhideconfig">
                <hr class="internalconfigbreak">

                <div class="mb-3">
                    <label for="customImageUpload">Custom Image Upload:</label>
                    <span class="text-muted"></span></label>
                    <div class="input-group">
                        <input type="file" class="form-control" id="customImageUpload" name="customImageUpload"
                                value="">
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-alignment input-group">
                        <label for="customImageEnabled">Custom Image State: &nbsp;&nbsp;</label>
                        <select class="fieldInfo-select custom-select d-block w-100" id="customImageEnabled" name="customImageEnabled">
                            <option value="Disabled" <?php if ($customImageEnabled == 'Disabled') {
                                echo "selected";
                            } ?>>Disabled
                            </option>
                            <option value="Enabled" <?php if ($customImageEnabled == 'Enabled') {
                                echo "selected";
                            } ?>>Enabled
                            </option>
                        </select>
                    </div>
                </div>

                <div class=" mb-3">
                    <div class="form-alignment input-group">
                        <label for="customTopFontSize">Custom Image Select: &nbsp;</label>
                        <select class="fieldInfo-select custom-select d-block w-100" id="customImage" name="customImage">
                            <option value="" <?php if ($customImage == '') {
                                echo "selected";
                            } ?>>None
                            </option>
                            <?php
                            $path = "cache/custom";
                            $files = array_diff(scandir($path), array('.', '..'));
                            foreach ($files as $file) {
                                echo "<option value='$file'";
                                if ($customImage == $file) {
                                    echo "selected";
                                }
                                echo ">$file</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <hr class="internalconfigbreak">

                <div class="mb-3">
                    <label for="customTopText">Custom Top Text</label>
                    <span class="text-muted"><small>(Optional)</small>:</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="customTopText" name="customTopText"
                                placeholder="Custom Image Top Text" value="<?php echo $customTopText; ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="customTopFontSize">Top Font Size:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="customTopFontSize" name="customTopFontSize"
                                    value="<?php echo $customTopFontSize; ?>">
                            <div class="input-group-prepend">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="customTopFontColor">Top Font Color:</label>
                        <div class="input-group">
                            <input type="text" id="customTopFontColor" name="customTopFontColor"
                                    class="form-control" data-position="bottom left"
                                    value="<?php echo $customTopFontColor; ?>">
                        </div>
                    </div>
                </div>

                <script>
                    $(function () {
                        $('#customTopFontColor').colorpicker();
                        $('#customTopFontColor').on('colorpickerChange', function (event) {
                            $('.jumbotron').css('background-color', event.color.toString());
                        });
                    });
                </script>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="customTopFontOutlineSize">Top Font Outline Size:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="customTopFontOutlineSize"
                                    name="customTopFontOutlineSize" value="<?php echo $customTopFontOutlineSize; ?>">
                            <div class="input-group-prepend">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="customTopFontOutlineColor">Top Font Outline Color:</label>
                        <div class="input-group">
                            <input type="text" id="customTopFontOutlineColor" name="customTopFontOutlineColor"
                                    class="form-control" data-position="bottom left"
                                    value="<?php echo $customTopFontOutlineColor; ?>">
                        </div>
                    </div>
                </div>

                <script>
                    $(function () {
                        $('#customTopFontOutlineColor').colorpicker();
                        $('#customTopFontOutlineColor').on('colorpickerChange', function (event) {
                            $('.jumbotron').css('background-color', event.color.toString());
                        });
                    });
                </script>

                <hr class="internalconfigbreak">

                <div class="mb-3">
                    <label for="customBottomText">Custom Bottom Text</label>
                    <span class="text-muted"><small>(Optional)</small>:</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="customBottomText" name="customBottomText"
                                placeholder="Coming Soon Top Text" value="<?php echo $customBottomText; ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="customBottomFontSize">Bottom Font Size:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="customBottomFontSize"
                                    name="customBottomFontSize" value="<?php echo $customBottomFontSize; ?>">
                            <div class="input-group-prepend">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="customBottomFontColor">Bottom Font Color:</label>
                        <div class="input-group">
                            <input type="text" id="customBottomFontColor" name="customBottomFontColor"
                                    class="form-control" data-position="bottom left"
                                    value="<?php echo $customBottomFontColor; ?>">
                        </div>
                    </div>
                </div>

                <script>
                    $(function () {
                        $('#customBottomFontColor').colorpicker();
                        $('#customBottomFontColor').on('colorpickerChange', function (event) {
                            $('.jumbotron').css('background-color', event.color.toString());
                        });
                    });
                </script>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="customBottomFontOutlineSize">Bottom Font Outline Size:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="customBottomFontOutlineSize"
                                    name="customBottomFontOutlineSize" value="<?php echo $customBottomFontOutlineSize; ?>">
                            <div class="input-group-prepend">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="customBottomFontOutlineColor">Bottom Font Outline Color:</label>
                        <div class="input-group">
                            <input type="text" id="customBottomFontOutlineColor" name="customBottomFontOutlineColor"
                                    class="form-control" data-position="bottom left"
                                    value="<?php echo $customBottomFontOutlineColor; ?>">
                        </div>
                    </div>
                </div>

                <script>
                    $(function () {
                        $('#customBottomFontOutlineColor').colorpicker();
                        $('#customBottomFontOutlineColor').on('colorpickerChange', function (event) {
                            $('.jumbotron').css('background-color', event.color.toString());
                        });
                    });
                </script>
            </div>

            <hr class="mb-4">

            <button name="saveConfig" class="btn btn-primary btn-lg btn-block" type="submit" value="saveConfig">
                Update Settings
            </button>
            </form>
        </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="https://github.com/MattsShack/Plex-Movie-Poster-Display"
                                            target="_blank">GitHub</a></li>
            <li class="list-inline-item"><a href="https://www.mattsshack.com/plex-movie-poster-display/"
                                            target="_blank">Support</a></li>
        </ul>
    </footer>
</div>

<script>
    function passwordView() {
        event.preventDefault();
        if ($('#password_view input').attr("type") == "text") {
            document.getElementById('password_view_btn').innerHTML = "Show";
            $('#password_view input').attr('type', 'password');
        } else if ($('#password_view input').attr("type") == "password") {
            $('#password_view input').attr('type', 'text');
            document.getElementById('password_view_btn').innerHTML = "Hide";
        }
    }

    function tokenView() {
        event.preventDefault();
        if ($('#token_view input').attr("type") == "text") {
            document.getElementById('token_view_btn').innerHTML = "Show";
            $('#token_view input').attr('type', 'password');
        } else if ($('#token_view input').attr("type") == "password") {
            $('#token_view input').attr('type', 'text');
            document.getElementById('token_view_btn').innerHTML = "Hide";
        }
    }
</script>

</body>
</html>
