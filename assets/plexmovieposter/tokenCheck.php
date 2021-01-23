<?php
if ($plexToken == NULL) {
  header("Refresh:0; url=settings/server.php");
  die();
}
