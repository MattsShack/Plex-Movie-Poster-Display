<?php 
  include_once('loginCheck.php');

  //Clear Poster Cache Directory
  if(!empty($_POST[clearPosterCache])) {
    $files = glob('cache/posters/*');
    foreach($files as $file) {
      if(is_file($file)) {
        unlink($file);
      }
    }
  }

  //Clear Custom Cache Directory
  if(!empty($_POST[clearCustomCache])) {
    $files = glob('cache/custom/*');
    foreach($files as $file) {
      if(is_file($file)) {
        unlink($file);
      }
    }
  }

  if (!empty($_POST[saveConfig])) {
    //Custom Image Upload
    if(!empty($_FILES[customImageUpload])) {
      $uploaddir = 'cache/custom/';
      $uploadfile = $uploaddir . basename($_FILES['customImageUpload']['name']);

      if (move_uploaded_file($_FILES['customImageUpload']['tmp_name'], $uploadfile)) {
      } else {
        $uploadfile = $_POST[customImageUpload];
      }
    }

    //Define Config File
    $myfile = fopen("config.php", "w") or die("Unable to open file!");

    //FixUP POST Data 
    $_POST = array_map("stripslashes", $_POST);

    //Create New Config
    $newConfig = "
<?php
  //PMPD Config
  \$pmpUsername = 'admin';
  \$pmpPassword = 'password1';
  \$pmpClearImageCache = 'Yes'; //Default Yes
  \$pmpImageSpeed = '30'; //Default 30 Seconds
  \$pmpPosterDir = 'cache/posters/'; //Default cache/posters/
  \$pmpCustomDir = 'cache/custom/'; //Default cache/custom/


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

  //Now Showing Config
  \$nowShowingTopText = '$_POST[nowShowingTopText]';
  \$nowShowingTopFontSize = '$_POST[nowShowingTopFontSize]'; //Default 55
  \$nowShowingTopFontColor = '$_POST[nowShowingTopFontColor]'; //Default Yellow
  \$nowShowingTopFontOutlineSize = '$_POST[nowShowingTopFontOutlineSize]'; //Default 2
  \$nowShowingTopFontOutlineColor = '$_POST[nowShowingTopFontOutlineColor]'; //Default Yellow
  \$nowShowingBottomFontSize = '$_POST[nowShowingBottomFontSize]'; //Default 25
  \$nowShowingBottomFontColor = '$_POST[nowShowingBottomFontColor]'; //Default #FFFFFF (White)

  //Misc
  \$pmpDisplayCounter = 'Disabled'; //Default Disabled
  \$pmpDisplayClock = 'Disabled'; //Default Disabled
?>";

    echo  $newConfig;
    fwrite($myfile, $newConfig);
    fclose($myfile);
    $update = "1";
  }

  include_once('config.php');

  //Count Items in Posters
  $posters = scandir('cache/posters');
  $posterCount = count($posters)-2;

  //Count Items in Custom Images
  $custom = scandir('cache/custom');
  $customCount = count($custom)-2;

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="www.mattsshack.com">

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
        <p class="small">Please allow 60 seconds for display to update with changes.</p>
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
              <span class="text-muted"><?php echo disk_free_space("/"); ?></span>
            </li>
          </ul>

        </div>

        <div class="col-md-8 order-md-1">

          <h4 class="mb-3">Server Configuration</h4>
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

            <h4 class="mb-3">Client Configuration</h4>
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

            <h4 class="mb-3">Coming Soon Configuration</h4>
            <div class="mb-3">
              <label for="comingSoonTopText">Coming Soon Top Text</label>
              <span class="text-muted">(Optional)</span></label>
              <div class="input-group">
                <input type="text" class="form-control" id="comingSoonTopText" name="comingSoonTopText" placeholder="Coming Soon Top Text" value="<?php echo $comingSoonTopText; ?>">
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="comingSoonTopFontSize">Coming Soon Top Font Size</label>
                <select class="custom-select d-block w-100" id="comingSoonTopFontSize" name="comingSoonTopFontSize">
                  <option value="15" <?php if($comingSoonTopFontSize == '15'){ echo "selected"; } ?>>15px</option>
                  <option value="20" <?php if($comingSoonTopFontSize == '20'){ echo "selected"; } ?>>20px</option>
                  <option value="25" <?php if($comingSoonTopFontSize == '25'){ echo "selected"; } ?>>25px</option>
                  <option value="30" <?php if($comingSoonTopFontSize == '30'){ echo "selected"; } ?>>30px</option>
                  <option value="35" <?php if($comingSoonTopFontSize == '35'){ echo "selected"; } ?>>35px</option>
                  <option value="40" <?php if($comingSoonTopFontSize == '40'){ echo "selected"; } ?>>40px</option>
                  <option value="45" <?php if($comingSoonTopFontSize == '45'){ echo "selected"; } ?>>45px</option>
                  <option value="50" <?php if($comingSoonTopFontSize == '50'){ echo "selected"; } ?>>50px</option>
                  <option value="55" <?php if($comingSoonTopFontSize == '55'){ echo "selected"; } ?>>55px</option>
                  <option value="60" <?php if($comingSoonTopFontSize == '60'){ echo "selected"; } ?>>60px</option>
                </select>
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
                <select class="custom-select d-block w-100" id="comingSoonTopFontOutlineSize" name="comingSoonTopFontOutlineSize">
                  <option value="0" <?php if($comingSoonTopFontOutlineSize == '0'){ echo "selected"; } ?>>No Outline</option>
                  <option value="1" <?php if($comingSoonTopFontOutlineSize == '1'){ echo "selected"; } ?>>1px</option>
                  <option value="2" <?php if($comingSoonTopFontOutlineSize == '2'){ echo "selected"; } ?>>2px</option>
                  <option value="3" <?php if($comingSoonTopFontOutlineSize == '3'){ echo "selected"; } ?>>3px</option>
                  <option value="4" <?php if($comingSoonTopFontOutlineSize == '4'){ echo "selected"; } ?>>4px</option>
                  <option value="5" <?php if($comingSoonTopFontOutlineSize == '5'){ echo "selected"; } ?>>5px</option>
                </select>
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
              <span class="text-muted">(Optional)</span></label>
              <div class="input-group">
                <input type="text" class="form-control" id="comingSoonBottomText" name="comingSoonBottomText" placeholder="Coming Soon Bottom Text" value="<?php echo $comingSoonBottomText; ?>">
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="comingSoonBottomFontSize">Coming Soon Bottom Font Size</label>
                <select class="custom-select d-block w-100" id="comingSoonBottomFontSize" name="comingSoonBottomFontSize">
                  <option value="15" <?php if($comingSoonBottomFontSize == '15'){ echo "selected"; } ?>>15px</option>
                  <option value="20" <?php if($comingSoonBottomFontSize == '20'){ echo "selected"; } ?>>20px</option>
                  <option value="25" <?php if($comingSoonBottomFontSize == '25'){ echo "selected"; } ?>>25px</option>
                  <option value="30" <?php if($comingSoonBottomFontSize == '30'){ echo "selected"; } ?>>30px</option>
                  <option value="35" <?php if($comingSoonBottomFontSize == '35'){ echo "selected"; } ?>>35px</option>
                  <option value="40" <?php if($comingSoonBottomFontSize == '40'){ echo "selected"; } ?>>40px</option>
                  <option value="45" <?php if($comingSoonBottomFontSize == '45'){ echo "selected"; } ?>>45px</option>
                  <option value="50" <?php if($comingSoonBottomFontSize == '50'){ echo "selected"; } ?>>50px</option>
                  <option value="55" <?php if($comingSoonBottomFontSize == '55'){ echo "selected"; } ?>>55px</option>
                  <option value="60" <?php if($comingSoonBottomFontSize == '60'){ echo "selected"; } ?>>60px</option>
                </select>
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

            <h4 class="mb-3">Now Showing Configuration</h4>
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
                <select class="custom-select d-block w-100" id="nowShowingTopFontSize" name="nowShowingTopFontSize">
                  <option value="15" <?php if($nowShowingTopFontSize == '15'){ echo "selected"; } ?>>15px</option>
                  <option value="20" <?php if($nowShowingTopFontSize == '20'){ echo "selected"; } ?>>20px</option>
                  <option value="25" <?php if($nowShowingTopFontSize == '25'){ echo "selected"; } ?>>25px</option>
                  <option value="30" <?php if($nowShowingTopFontSize == '30'){ echo "selected"; } ?>>30px</option>
                  <option value="35" <?php if($nowShowingTopFontSize == '35'){ echo "selected"; } ?>>35px</option>
                  <option value="40" <?php if($nowShowingTopFontSize == '40'){ echo "selected"; } ?>>40px</option>
                  <option value="45" <?php if($nowShowingTopFontSize == '45'){ echo "selected"; } ?>>45px</option>
                  <option value="50" <?php if($nowShowingTopFontSize == '50'){ echo "selected"; } ?>>50px</option>
                  <option value="55" <?php if($nowShowingTopFontSize == '55'){ echo "selected"; } ?>>55px</option>
                  <option value="60" <?php if($nowShowingTopFontSize == '60'){ echo "selected"; } ?>>60px</option>
                </select>
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
                <select class="custom-select d-block w-100" id="nowShowingTopFontOutlineSize" name="nowShowingTopFontOutlineSize">
                  <option value="0" <?php if($nowShowingTopFontOutlineSize == '0'){ echo "selected"; } ?>>No Outline</option>
                  <option value="1" <?php if($nowShowingTopFontOutlineSize == '1'){ echo "selected"; } ?>>1px</option>
                  <option value="2" <?php if($nowShowingTopFontOutlineSize == '2'){ echo "selected"; } ?>>2px</option>
                  <option value="3" <?php if($nowShowingTopFontOutlineSize == '3'){ echo "selected"; } ?>>3px</option>
                  <option value="4" <?php if($nowShowingTopFontOutlineSize == '4'){ echo "selected"; } ?>>4px</option>
                  <option value="5" <?php if($nowShowingTopFontOutlineSize == '5'){ echo "selected"; } ?>>5px</option>
                </select>
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
                <select class="custom-select d-block w-100" id="nowShowingBottomFontSize" name="nowShowingBottomFontSize">
                  <option value="15" <?php if($nowShowingBottomFontSize == '15'){ echo "selected"; } ?>>15px</option>
                  <option value="20" <?php if($nowShowingBottomFontSize == '20'){ echo "selected"; } ?>>20px</option>
                  <option value="25" <?php if($nowShowingBottomFontSize == '25'){ echo "selected"; } ?>>25px</option>
                  <option value="30" <?php if($nowShowingBottomFontSize == '30'){ echo "selected"; } ?>>30px</option>
                  <option value="35" <?php if($nowShowingBottomFontSize == '35'){ echo "selected"; } ?>>35px</option>
                  <option value="40" <?php if($nowShowingBottomFontSize == '40'){ echo "selected"; } ?>>40px</option>
                  <option value="45" <?php if($nowShowingBottomFontSize == '45'){ echo "selected"; } ?>>45px</option>
                  <option value="50" <?php if($nowShowingBottomFontSize == '50'){ echo "selected"; } ?>>50px</option>
                  <option value="55" <?php if($nowShowingBottomFontSize == '55'){ echo "selected"; } ?>>55px</option>
                  <option value="60" <?php if($nowShowingBottomFontSize == '60'){ echo "selected"; } ?>>60px</option>
                </select>
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

            <hr class="mb-4">

            <h4 class="mb-3">Custom Image Configuration</h4>

            <div class="mb-3">
              <label for="customImageUpload">Custom Image Upload</label>
              <span class="text-muted"></span></label>
              <div class="input-group">
                <input type="file" class="form-control" id="customImageUpload" name="customImageUpload">
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
                <select class="custom-select d-block w-100" id="customTopFontSize" name="customTopFontSize">
                  <option value="15" <?php if($customTopFontSize == '15'){ echo "selected"; } ?>>15px</option>
                  <option value="20" <?php if($customTopFontSize == '20'){ echo "selected"; } ?>>20px</option>
                  <option value="25" <?php if($customTopFontSize == '25'){ echo "selected"; } ?>>25px</option>
                  <option value="30" <?php if($customTopFontSize == '30'){ echo "selected"; } ?>>30px</option>
                  <option value="35" <?php if($customTopFontSize == '35'){ echo "selected"; } ?>>35px</option>
                  <option value="40" <?php if($customTopFontSize == '40'){ echo "selected"; } ?>>40px</option>
                  <option value="45" <?php if($customTopFontSize == '45'){ echo "selected"; } ?>>45px</option>
                  <option value="50" <?php if($customTopFontSize == '50'){ echo "selected"; } ?>>50px</option>
                  <option value="55" <?php if($customTopFontSize == '55'){ echo "selected"; } ?>>55px</option>
                  <option value="60" <?php if($customTopFontSize == '60'){ echo "selected"; } ?>>60px</option>
                </select>
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
                <select class="custom-select d-block w-100" id="customTopFontOutlineSize" name="customTopFontOutlineSize">
                  <option value="0" <?php if($customTopFontOutlineSize == '0'){ echo "selected"; } ?>>No Outline</option>
                  <option value="1" <?php if($customTopFontOutlineSize == '1'){ echo "selected"; } ?>>1px</option>
                  <option value="2" <?php if($customTopFontOutlineSize == '2'){ echo "selected"; } ?>>2px</option>
                  <option value="3" <?php if($customTopFontOutlineSize == '3'){ echo "selected"; } ?>>3px</option>
                  <option value="4" <?php if($customTopFontOutlineSize == '4'){ echo "selected"; } ?>>4px</option>
                  <option value="5" <?php if($customTopFontOutlineSize == '5'){ echo "selected"; } ?>>5px</option>
                </select>
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
                <select class="custom-select d-block w-100" id="customBottomFontSize" name="customBottomFontSize">
                  <option value="15" <?php if($customBottomFontSize == '15'){ echo "selected"; } ?>>15px</option>
                  <option value="20" <?php if($customBottomFontSize == '20'){ echo "selected"; } ?>>20px</option>
                  <option value="25" <?php if($customBottomFontSize == '25'){ echo "selected"; } ?>>25px</option>
                  <option value="30" <?php if($customBottomFontSize == '30'){ echo "selected"; } ?>>30px</option>
                  <option value="35" <?php if($customBottomFontSize == '35'){ echo "selected"; } ?>>35px</option>
                  <option value="40" <?php if($customBottomFontSize == '40'){ echo "selected"; } ?>>40px</option>
                  <option value="45" <?php if($customBottomFontSize == '45'){ echo "selected"; } ?>>45px</option>
                  <option value="50" <?php if($customBottomFontSize == '50'){ echo "selected"; } ?>>50px</option>
                  <option value="55" <?php if($customBottomFontSize == '55'){ echo "selected"; } ?>>55px</option>
                  <option value="60" <?php if($customBottomFontSize == '60'){ echo "selected"; } ?>>60px</option>
                </select>
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
          <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
      </footer>
    </div>

</html>