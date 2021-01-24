<?php
session_start();
if ($_SESSION['username'] == NULL) {
  header("Refresh:0; url=login.php");
  
  // $returnPage = "general.php";
  // header("Refresh:0; url=login.php?returnPage=$returnPage");
  die();
}
