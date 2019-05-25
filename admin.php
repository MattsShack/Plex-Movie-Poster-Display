<?php 
  //For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
  include_once('loginCheck.php');

  //Clear Poster Cache Directory
  if (!empty($_POST['clearPosterCache'])) {
    $files = glob('cache/posters/*');
    foreach($files as $file) {
      if(is_file($file)) {
        unlink($file);
      }
    }
  }

  //Clear Custom Cache Directory
  if (!empty($_POST['clearCustomCache'])) {
    $files = glob('cache/custom/*');
    foreach($files as $file) {
      if(is_file($file)) {
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
    $newConfig = "<?php
  //PMPD Config
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

  //Cleint Configuration
  \$plexClient = '$_POST[plexClient]';

  //Custom Image
  \$customImageEnabled = '$_POST[customImageEnabled]'; //Default Disabled
  \$customImage = '$_POST[customImage]';
  \$customTopText = '$_POST[customTopText]';
  \$customTopFontSize = '$_POST[customTopFontSize]'; //Default 55
  \$customTopFontColor = '$_POST[customTopFontColor]'; //Default #FFFFFF (White)
  \$customTopFontOutlineSize = '$_POST[customTopFontOutlineSize]'; //Default 2p
  \$customTopFontOutlineColor = '$_POST[customTopFontOutlineColor]'; //Default #FFFF00 (Yellow)
  \$customBottomText = '$_POST[customBottomText]';
  \$customBottomFontSize = '$_POST[customBottomFontSize]'; //Default 25
  \$customBottomFontColor = '$_POST[customBottomFontColor]'; //Default #FFFFFF (White)

  //Coming Soon Config
  \$comingSoonTopText = '$_POST[comingSoonTopText]';
  \$comingSoonTopFontSize = '$_POST[comingSoonTopFontSize]'; //Default 55
  \$comingSoonTopFontColor = '$_POST[comingSoonTopFontColor]'; //Default Yellow
  \$comingSoonTopFontOutlineColor = '$_POST[comingSoonTopFontOutlineColor]'; //Default Yellow
  \$comingSoonTopFontOutlineSize = '$_POST[comingSoonTopFontOutlineSize]'; //Default 2
  \$comingSoonBottomText = '$_POST[comingSoonBottomText]';
  \$comingSoonBottomFontSize = '$_POST[comingSoonBottomFontSize]'; //Default 55
  \$comingSoonBottomFontColor = '$_POST[comingSoonBottomFontColor]'; //Default #FFFFFF (White)
  \$comingSoonShowSelection = '$_POST[comingSoonShowSelection]'; //Default unwatched

  //Now Showing Config
  \$nowShowingTopText = '$_POST[nowShowingTopText]';
  \$nowShowingTopFontSize = '$_POST[nowShowingTopFontSize]'; //Default 55
  \$nowShowingTopFontColor = '$_POST[nowShowingTopFontColor]'; //Default Yellow
  \$nowShowingTopFontOutlineSize = '$_POST[nowShowingTopFontOutlineSize]'; //Default 2
  \$nowShowingTopFontOutlineColor = '$_POST[nowShowingTopFontOutlineColor]'; //Default Yellow
  \$nowShowingBottomFontSize = '$_POST[nowShowingBottomFontSize]'; //Default 25
  \$nowShowingBottomFontColor = '$_POST[nowShowingBottomFontColor]'; //Default #FFFFFF (White)

  //Misc
  \$pmpDisplayProgress = '$_POST[pmpDisplayProgress]'; //Default Disabled
  \$pmpDisplayProgressSize = '$_POST[pmpDisplayProgressSize]'; //Default 5
  \$pmpDisplayProgressColor = '$_POST[pmpDisplayProgressColor]'; //Default #FFF300
  \$pmpDisplayClock = 'Disabled'; //Default Disabled (FUTURE)
  \$pmpBottomScroll = '$_POST[pmpBottomScroll]'; //Default Disabled
  \$pmpBottomScrollSpeed = '1'; //Default 1 (FUTURE)
?>";

    echo $newConfig;
    fwrite($myfile, $newConfig);
    sleep(1);
    fclose($myfile);
    header("Location: admin.php");
  }

  //Count Items in Posters
  $posters = scandir('cache/posters');
  $posterCount = count($posters)-2;

  //Count Items in Custom Images
  $custom = scandir('cache/custom');
  $customCount = count($custom)-2;

  //Fixup Size Calculations
  function fixupSize($bytes){
    $places = '2';
    $size=array('B','KB','MB','GB');
    $factor=floor((strlen($bytes)-1)/3);
    return sprintf("%.{$places}f",$bytes/pow(1024,$factor)).@$size[$factor];
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
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

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
    <link href="assets/styles/default/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/default/form-validation.css">
  </head>

  <body class="bg-light">
    <div class="container">
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="assets/images/android-chrome-192x192.png" alt="" width="100" height="100">
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
                <button name="clearPosterCache" type="submit" class="btn btn-danger btn-sm" value="clearPosterCache">Clear</button>
              </form>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Custom Images</h6>
                <small class="text-muted">Items in cache/custom</small>
              </div>
              <span class="text-muted"><?php echo $customCount; ?></span>
              <form method="post" class="needs-validation" novalidate>
                <button name="clearCustomCache" type="submit" class="btn btn-danger btn-sm" value="clearCustomCache">Clear</button>
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
          <h4 class="mb-3"> <a name="Server"></a>Plex Movie Poster Display Config</h4>
          <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
            <div class="mb-3">
              <label for="pmpUsername">Username</label>
              <div class="input-group">
                <input type="text" class="form-control" id="pmpUsername" name="pmpUsername" placeholder="Username" value="<?php echo $pmpUsername; ?>" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Movie Poster Display Username.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="pmpPassword">Password</label>
              <div class="input-group" id="password_view">
                <input type="password" class="form-control" id="pmpPassword" name="pmpPassword" placeholder="Password" value="<?php echo $pmpPassword; ?>" required>
                <span class="input-group-btn">
                  <button class="btn btn-secondary" type="button" id="password_view_btn" onclick="passwordView()">Show</button>
                </span>
              </div>
            </div>

          <h4 class="mb-3"> <a name="Server"></a> Server Configuration</h4>
          <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
            <div class="mb-3">
              <label for="plexServer">Plex Server IP</label>
              <div class="input-group">
                <input type="text" class="form-control" id="plexServer" name="plexServer" placeholder="Plex Server IP" value="<?php echo $plexServer; ?>" required>
                <div class="invalid-feedback" style="width: 100%;">
                  A Plex server IP address is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="plexToken">Plex Token <a href="https://support.plex.tv/hc/en-us/articles/204059436-Finding-your-account-token-X-Plex-Token" target=_blank><span class="badge badge-primary">?</span></a> </label>
              <div class="input-group">
                <input type="text" class="form-control" id="plexToken" name="plexToken" placeholder="Plex Token" value="<?php echo $plexToken; ?>"required>
                <div class="invalid-feedback" style="width: 100%;">
                  A Plex token is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="plexServerMovieSection">Plex Movie Sections <small>( Comma Seperated with no Spaces )</small></label>
              <div class="input-group">
                <input type="text" class="form-control" id="plexServerMovieSection" name="plexServerMovieSection" placeholder="Plex Movie Sections" value="<?php echo $plexServerMovieSection; ?>" required>
                <div class="invalid-feedback" style="width: 100%;">
                  At least one Plex movie sections is required.
                </div>
              </div>
            </div>

            <hr class="mb-4">

            <h4 class="mb-3"> <a name="Client"></a> Client Configuration</h4>
            <div class="mb-3">
              <label for="plexClient">Plex Client IP</label>
              <div class="input-group">
                <input type="text" class="form-control" id="plexClient" name="plexClient" placeholder="Plex Client IP" value="<?php echo $plexClient; ?>" required>
                <div class="invalid-feedback" style="width: 100%;">
                  A Plex client IP address is required.
                </div>
              </div>
            </div>

            <hr class="mb-4">
            <h4 class="mb-3"> <a name="ComingSoon"></a> Coming Soon Configuration</h4>

            <div class="mb-3">
              <label for="comingSoonShowSelection">Show Movies</label>
              <select class="custom-select d-block w-100" id="comingSoonShowSelection" name="comingSoonShowSelection">
                <option value="unwatched" <?php if($comingSoonShowSelection == 'unwatched'){ echo "selected"; } ?>>UnWatched</option>
                <option value="all" <?php if($comingSoonShowSelection == 'all'){ echo "selected"; } ?>>All</option>
                <option value="recentlyAdded" <?php if($comingSoonShowSelection == 'recentlyAdded'){ echo "selected"; } ?>>Recently Added</option>
                <option value="newest" <?php if($comingSoonShowSelection == 'newest'){ echo "selected"; } ?>>Newest</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="pmpImageSpeed">Poster Transition Speed <small>( Seconds )</small></label>
              <div class="input-group">
                <input type="text" class="form-control" id="pmpImageSpeed" name="pmpImageSpeed" placeholder="Poster Transition Speed" value="<?php echo $pmpImageSpeed; ?>" required>
                <div class="input-group-prepend">
                  <div class="input-group-text">Seconds</div>
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="comingSoonTopText">Coming Soon Top Text</label>
              <div class="input-group">
                <input type="text" class="form-control" id="comingSoonTopText" name="comingSoonTopText" placeholder="Coming Soon Top Text" value="<?php echo $comingSoonTopText; ?>">
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="comingSoonTopFontSize">Coming Soon Top Font Size</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="comingSoonTopFontSize" name="comingSoonTopFontSize" value="<?php echo $comingSoonTopFontSize; ?>">
                  <div class="input-group-prepend">
                    <div class="input-group-text">px</div>
                  </div> 
               </div>
            </div>

            <div class="col-md-6 mb-3">
              <label for="comingSoonTopFontColor">Coming Soon Top Font Color</label>
                <div class="input-group">
                  <input type="text" id="comingSoonTopFontColor" name="comingSoonTopFontColor" class="form-control" data-position="bottom left" value="<?php echo $comingSoonTopFontColor; ?>">
                </div>
              </div>
            </div>

            <script>
              $(function () {
                $('#comingSoonTopFontColor').colorpicker();
                $('#comingSoonTopFontColor').on('colorpickerChange', function(event) {
                  $('.jumbotron').css('background-color', event.color.toString());
                });
              });
            </script>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="comingSoonTopFontOutlineSize">Coming Soon Top Font Outline Size</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="comingSoonTopFontOutlineSize" name="comingSoonTopFontOutlineSize" value="<?php echo $comingSoonTopFontOutlineSize; ?>">
                  <div class="input-group-prepend">
                    <div class="input-group-text">px</div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="comingSoonTopFontOutlineColor">Coming Soon Top Font Outline Color</label>
                <div class="input-group">
                  <input type="text" id="comingSoonTopFontOutlineColor" name="comingSoonTopFontOutlineColor" class="form-control" data-position="bottom left" value="<?php echo $comingSoonTopFontOutlineColor; ?>">
                </div>
              </div>
            </div>

            <script>
              $(function () {
                $('#comingSoonTopFontOutlineColor').colorpicker();
                $('#comingSoonTopFontOutlineColor').on('colorpickerChange', function(event) {
                  $('.jumbotron').css('background-color', event.color.toString());
                });
              });
            </script>

            <div class="mb-3">
              <label for="comingSoonBottomText">Coming Soon Bottom Text</label>
              <div class="input-group">
                <input type="text" class="form-control" id="comingSoonBottomText" name="comingSoonBottomText" placeholder="Coming Soon Bottom Text" value="<?php echo $comingSoonBottomText; ?>">
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="comingSoonBottomFontSize">Coming Soon Bottom Font Size</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="comingSoonBottomFontSize" name="comingSoonBottomFontSize" value="<?php echo $comingSoonBottomFontSize; ?>">
                  <div class="input-group-prepend">
                    <div class="input-group-text">px</div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="comingSoonBottomFontColor">Coming Soon Bottom Font Color</label>
                <div class="input-group">
                  <input type="text" id="comingSoonBottomFontColor" name="comingSoonBottomFontColor" class="form-control" data-position="bottom left" value="<?php echo $comingSoonBottomFontColor; ?>">
                </div>
              </div>
            </div>

            <script>
              $(function () {
                $('#comingSoonBottomFontColor').colorpicker();
                $('#comingSoonBottomFontColor').on('colorpickerChange', function(event) {
                  $('.jumbotron').css('background-color', event.color.toString());
                });
              });
            </script>

            <hr class="mb-4">

            <h4 class="mb-3"> <a name="NowShowing"></a> Now Showing Configuration</h4>
            <div class="mb-3">
              <label for="nowShowingTopText">Now Showing Top Text</label>
              <span class="text-muted">(Optional)</span></label>
              <div class="input-group">
                <input type="text" class="form-control" id="nowShowingTopText" name="nowShowingTopText" placeholder="Now Showing Top Text" value="<?php echo $nowShowingTopText; ?>">
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="nowShowingTopFontSize">Now Showing Top Font Size</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="nowShowingTopFontSize" name="nowShowingTopFontSize" value="<?php echo $nowShowingTopFontSize; ?>">
                  <div class="input-group-prepend">
                    <div class="input-group-text">px</div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="nowShowingTopFontColor">Now Showing Top Font Color</label>
                <div class="input-group">
                  <input type="text" id="nowShowingTopFontColor" name="nowShowingTopFontColor" class="form-control" data-position="bottom left" value="<?php echo $nowShowingTopFontColor; ?>">
                </div>
              </div>
            </div>

            <script>
              $(function () {
                $('#nowShowingTopFontColor').colorpicker();
                $('#nowShowingTopFontColor').on('colorpickerChange', function(event) {
                  $('.jumbotron').css('background-color', event.color.toString());
                });
              });
            </script>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="nowShowingTopFontOutlineSize">Now Showing Top Font Outline Size</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="nowShowingTopFontOutlineSize" name="nowShowingTopFontOutlineSize" value="<?php echo $nowShowingTopFontOutlineSize; ?>">
                  <div class="input-group-prepend">
                    <div class="input-group-text">px</div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="nowShowingTopFontOutlineColor">Now Showing Top Font Outline Color</label>
                <div class="input-group">
                  <input type="text" id="nowShowingTopFontOutlineColor" name="nowShowingTopFontOutlineColor" class="form-control" data-position="bottom left" value="<?php echo $nowShowingTopFontOutlineColor; ?>">
                </div>
              </div>
            </div>

            <script>
              $(function () {
                $('#nowShowingTopFontOutlineColor').colorpicker();
                $('#nowShowingTopFontOutlineColor').on('colorpickerChange', function(event) {
                  $('.jumbotron').css('background-color', event.color.toString());
                });
              });
            </script>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="nowShowingBottomFontSize">Now Showing Bottom Font Size</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="nowShowingBottomFontSize" name="nowShowingBottomFontSize" value="<?php echo $nowShowingBottomFontSize; ?>">
                  <div class="input-group-prepend">
                    <div class="input-group-text">px</div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="nowShowingBottomFontColor">Now Showing Bottom Font Color</label>
                <div class="input-group">
                  <input type="text" id="nowShowingBottomFontColor" name="nowShowingBottomFontColor" class="form-control" data-position="bottom left" value="<?php echo $nowShowingBottomFontColor; ?>">
                </div>
              </div>
            </div>

            <script>
              $(function () {
                $('#nowShowingBottomFontColor').colorpicker();
                $('#nowShowingBottomFontColor').on('colorpickerChange', function(event) {
                  $('.jumbotron').css('background-color', event.color.toString());
                });
              });
            </script>

            <div class="mb-3">
              <label for="pmpDisplayProgress">Progress Bar</label>
              <select class="custom-select d-block w-100" id="pmpDisplayProgress" name="pmpDisplayProgress">
                <option value="Disabled" <?php if($pmpDisplayProgress == 'Disabled'){ echo "selected"; } ?>>Disabled</option>
                <option value="Enabled"  <?php if($pmpDisplayProgress == 'Enabled'){ echo "selected"; } ?>>Enabled</option>
              </select>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="pmpDisplayProgressSize">Progress Bar Height</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="pmpDisplayProgressSize" name="pmpDisplayProgressSize" value="<?php echo $pmpDisplayProgressSize; ?>">
                  <div class="input-group-prepend">
                    <div class="input-group-text">px</div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="pmpDisplayProgressColor">Progress Bar Color</label>
                <div class="input-group">
                  <input type="text" id="pmpDisplayProgressColor" name="pmpDisplayProgressColor" class="form-control" data-position="bottom left" value="<?php echo $pmpDisplayProgressColor; ?>">
                </div>
              </div>
            </div>

            <script>
              $(function () {
                $('#pmpDisplayProgressColor').colorpicker();
                $('#pmpDisplayProgressColor').on('colorpickerChange', function(event) {
                  $('.jumbotron').css('background-color', event.color.toString());
                });
              });
            </script>

            <div class="mb-3">
              <label for="pmpBottomScroll">Scrolling Text </label>
              <select class="custom-select d-block w-100" id="pmpBottomScroll" name="pmpBottomScroll">
                <option value="Disabled" <?php if($pmpBottomScroll == 'Disabled'){ echo "selected"; } ?>>Disabled</option>
                <option value="Enabled"  <?php if($pmpBottomScroll == 'Enabled'){ echo "selected"; } ?>>Enabled</option>
              </select>
            </div>

            <hr class="mb-4">

            <h4 class="mb-3"> <a name="CustomImages"></a> Custom Images Configuration</h4>

            <div class="mb-3">
              <label for="customImageUpload">Custom Image Upload</label>
              <span class="text-muted"></span></label>
              <div class="input-group">
                <input type="file" class="form-control" id="customImageUpload" name="customImageUpload" value="">
              </div>
            </div>

            <div class="mb-3">
              <label for="customImageEnabled">Custom Image State</label>
              <select class="custom-select d-block w-100" id="customImageEnabled" name="customImageEnabled">
                <option value="Disabled" <?php if($customImageEnabled == 'Disabled'){ echo "selected"; } ?>>Disabled</option>
                <option value="Enabled"  <?php if($customImageEnabled == 'Enabled'){ echo "selected"; } ?>>Enabled</option>
              </select>
            </div>

            <div class=" mb-3">
              <label for="customTopFontSize">Custom Image Select</label>
              <select class="custom-select d-block w-100" id="customImage" name="customImage">
                <option value="" <?php if($customImage == ''){ echo "selected"; } ?>>None</option>
                <?php
                  $path = "cache/custom";
                  $files = array_diff(scandir($path), array('.', '..'));
                  foreach($files as $file) {
                    echo "<option value='$file'"; if($customImage == $file){ echo "selected"; } echo ">$file</option>";
                  }
                ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="customTopText">Custom Image Top Text</label>
              <span class="text-muted">(Optional)</span></label>
              <div class="input-group">
                <input type="text" class="form-control" id="customTopText" name="customTopText" placeholder="Custom Image Top Text" value="<?php echo $customTopText; ?>">
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="customTopFontSize">Custom Image Top Font Size</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="customTopFontSize" name="customTopFontSize" value="<?php echo $customTopFontSize; ?>">
                  <div class="input-group-prepend">
                    <div class="input-group-text">px</div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="customTopFontColor">Custom Image Top Font Color</label>
                <div class="input-group">
                  <input type="text" id="customTopFontColor" name="customTopFontColor" class="form-control" data-position="bottom left" value="<?php echo $customTopFontColor; ?>">
                </div>
              </div>
            </div>

            <script>
              $(function () {
                $('#customTopFontColor').colorpicker();
                $('#customTopFontColor').on('colorpickerChange', function(event) {
                  $('.jumbotron').css('background-color', event.color.toString());
                });
              });
            </script>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="customTopFontOutlineSize">Custom Image Top Font Outline Size</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="customTopFontOutlineSize" name="customTopFontOutlineSize" value="<?php echo $customTopFontOutlineSize; ?>">
                  <div class="input-group-prepend">
                    <div class="input-group-text">px</div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="customTopFontOutlineColor">Custom Image Top Font Outline Color</label>
                <div class="input-group">
                  <input type="text" id="customTopFontOutlineColor" name="customTopFontOutlineColor" class="form-control" data-position="bottom left" value="<?php echo $customTopFontOutlineColor; ?>">
                </div>
              </div>
            </div>

            <script>
              $(function () {
                $('#customTopFontOutlineColor').colorpicker();
                $('#customTopFontOutlineColor').on('colorpickerChange', function(event) {
                  $('.jumbotron').css('background-color', event.color.toString());
                });
              });
            </script>

            <div class="mb-3">
              <label for="customBottomText">Custom Image Bottom Text</label>
              <span class="text-muted">(Optional)</span></label>
              <div class="input-group">
                <input type="text" class="form-control" id="customBottomText" name="customBottomText" placeholder="Coming Soon Top Text" value="<?php echo $customBottomText; ?>">
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="customBottomFontSize">Custom Image Bottom  Font Size</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="customBottomFontSize" name="customBottomFontSize" value="<?php echo $customBottomFontSize; ?>">
                  <div class="input-group-prepend">
                    <div class="input-group-text">px</div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="customBottomFontColor">Custom Image Bottom Font Color</label>
                <div class="input-group">
                  <input type="text" id="customBottomFontColor" name="customBottomFontColor" class="form-control" data-position="bottom left" value="<?php echo $customBottomFontColor; ?>">
                </div>
              </div>
            </div>

            <script>
              $(function () {
                $('#customBottomFontColor').colorpicker();
                $('#customBottomFontColor').on('colorpickerChange', function(event) {
                  $('.jumbotron').css('background-color', event.color.toString());
                });
              });
            </script>

            <hr class="mb-4">
            <button name="saveConfig" class="btn btn-primary btn-lg btn-block" type="submit" value="saveConfig">Update Settings</button>
          </form>
        </div>
      </div>

      <footer class="my-5 pt-5 text-muted text-center text-small">
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Terms</a></li>
          <li class="list-inline-item"><a href="https://github.com/MattsShack/Plex-Movie-Poster-Display" target="_blank">GitHub</a></li>
          <li class="list-inline-item"><a href="https://www.mattsshack.com/plex-movie-poster-display/" target="_blank">Support</a></li>
        </ul>
      </footer>
    </div>

  <script>
    function passwordView() {
      event.preventDefault();
      if($('#password_view input').attr("type") == "text"){
        document.getElementById('password_view_btn').innerHTML = "Show";
        $('#password_view input').attr('type', 'password');
      }else if($('#password_view input').attr("type") == "password"){
        $('#password_view input').attr('type', 'text');
        document.getElementById('password_view_btn').innerHTML = "Hide";
      }
    }
  </script>

  </body>
</html>
