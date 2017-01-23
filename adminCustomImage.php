<?php if (!empty($_POST)) {

  $uploaddir = 'cache/';
  $uploadfile = $uploaddir . basename($_FILES['newCustomImage']['name']);

  if (move_uploaded_file($_FILES['newCustomImage']['tmp_name'], $uploadfile)) {
    echo "OK";
  } else {
    $uploadfile = $_POST[customImage];
  }

  $myfile = fopen("config.php", "w") or die("Unable to open file!");

  //Hack to fix '... Need to fix this later.
  $_POST[comingSoonTopText] = str_replace("'", "\'", $_POST[comingSoonTopText]);
  $_POST[comingSoonBottomText] = str_replace("'", "\'", $_POST[comingSoonBottomText]);
  $_POST[nowShowingTopText] = str_replace("'", "\'", $_POST[nowShowingTopText]);

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

<h4><span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Custom Image</h4>

<?php if($update == "1") {
  echo "<div class='alert alert-info'>Configuration File Updated.</div>";
} ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
  <input type="hidden" class="form-control" name="plexServer" value="<?php echo "$plexServer"; ?>">
  <input type="hidden" class="form-control" name="plexToken" value="<?php echo "$plexToken"; ?>">
  <input type="hidden" class="form-control" name="plexServerMovieSection" value="<?php echo "$plexServerMovieSection"; ?>">
  <input type="hidden" class="form-control" name="plexClient" value="<?php echo "$plexClient"; ?>">
  <input type="hidden" class="form-control" name="comingSoonTopText" value="<?php echo "$comingSoonTopText"; ?>">
  <input type="hidden" class="form-control" name="comingSoonBottomText" value="<?php echo "$comingSoonBottomText"; ?>">
  <input type="hidden" class="form-control" name="nowShowingTopText" value="<?php echo "$nowShowingTopText"; ?>">        
  <input type="hidden" class="form-control" name="customImage" value="<?php echo "$customImage"; ?>">

  <?php  if ($customImageEnabled == "Yes") { ?>
    <div class="form-group">
    <label class="control-label col-sm-2">Current Image: </label>
    <div class="col-sm-10">
      <img src="<?php echo $customImage; ?>" width='304' height='236'>
    </div>
  </div>
  <?php } ?>


  <div class="form-group">
    <label class="control-label col-sm-2">Enable: </label>
    <div class="col-sm-10">
      <select class="form-control" name="customImageEnabled">
        <option value="No"  <?php if ($customImageEnabled == "No") { echo "selected"; } ?> >No</option>
        <option value="Yes" <?php if ($customImageEnabled == "Yes") { echo "selected"; } ?> >Yes</option>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2">Upload New Image: </label>
    <div class="col-sm-10">
      <input type="file" class="form-control" name="newCustomImage">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input class="btn btn-primary" type="submit" value="Save" name='submit' />
    </div>
  </div>

</form>

<?php include_once('assets/footer.php'); ?>
