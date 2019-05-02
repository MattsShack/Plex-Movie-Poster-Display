<?php
  session_start();
  if ($_SESSION['username'] == NULL) {
    header("Refresh:0; url=login.php");
    die();
  }
?>

