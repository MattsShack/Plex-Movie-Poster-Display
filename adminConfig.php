<?php if (!empty($_POST)) {

  $myfile = fopen("config.php", "w") or die("Unable to open file!");

 //Hack to fix '... Need to fix this later.
  $_POST[comingSoonTopText]    = str_replace("'", "\'", $_POST[comingSoonTopText]);
  $_POST[comingSoonBottomText] = str_replace("'", "\'", $_POST[comingSoonBottomText]);
  $_POST[nowShowingTopText]    = str_replace("'", "\'", $_POST[nowShowingTopText]);
  $_POST[customTopText]        = str_replace("'", "\'", $_POST[customTopText]);
  $_POST[customBottomText]     = str_replace("'", "\'", $_POST[customBottomText]);

  $txt = "
    <?php
      //Server Configuration
      \$plexServer = '$_POST[plexServer]';
      \$plexToken = '$_POST[plexToken]';
      \$plexServerMovieSection = '$_POST[plexServerMovieSection]';
      \n//Cleint Configuration
      \$plexClient = '$_POST[plexClient]';
      \n//Custom Image
      \$customImageEnabled = '$_POST[customImageEnabled]';
      \$customImage = '$uploadfile';
      \$customTopText = '$_POST[customTopText]';
      \$customBottomText = '$_POST[customBottomText]';
      \n//Misc
      \$comingSoonTopText = '$_POST[comingSoonTopText]';
      \$comingSoonBottomText = '$_POST[comingSoonBottomText]';
      \$nowShowingTopText = '$_POST[nowShowingTopText]';
    ?>
  ";

  echo  $txt;
  fwrite($myfile, $txt);
  fclose($myfile);
  $update = "1";

} ?>

<?php include_once('config.php'); ?>
<?php include_once('assets/header.php'); ?>

        <h4><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Configuration</h4>

        <?php if($update == "1") {
          echo "<div class='alert alert-info'>Configuration File Updated.</div>";
        } ?>

        <form class="form-horizontal" method="post">
          <div class="form-group">
            <label class="control-label col-sm-2">Server IP: </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="plexServer" value="<?php echo "$plexServer"; ?>">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2"><a href="https://support.plex.tv/hc/en-us/articles/204059436-Finding-your-account-token-X-Plex-Token" target=_blank>
              <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a> X-Plex-Token: </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="plexToken" value="<?php echo "$plexToken"; ?>">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Movie Section: </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="plexServerMovieSection" value="<?php echo "$plexServerMovieSection"; ?>">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Client IP: </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="plexClient" value="<?php echo "$plexClient"; ?>">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-10">
              <input type="hidden" class="form-control" name="customImageEnabled" value="<?php echo "$customImageEnabled"; ?>">
              <input type="hidden" class="form-control" name="customImage" value="<?php echo "$customImage"; ?>">
              <input type="hidden" class="form-control" name="customTopText" value="<?php echo "$customTopText"; ?>">
              <input type="hidden" class="form-control" name="customBottomText" value="<?php echo "$customBottomText"; ?>">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Coming Soon Top: </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="comingSoonTopText" value="<?php echo "$comingSoonTopText"; ?>">
            </div>
          </div>
         
          <div class="form-group">
            <label class="control-label col-sm-2">Coming Soon Bottom: </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="comingSoonBottomText" value="<?php echo "$comingSoonBottomText"; ?>">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Now Showing Text: </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nowShowingTopText" value="<?php echo "$nowShowingTopText"; ?>">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <input class="btn btn-primary" type="submit" value="Save" name='submit' />
            </div>
          </div>

        </form>

<?php include_once('assets/footer.php'); ?>
