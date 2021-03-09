<?php
include '../../config.php';

echo "Generate Links: <br>";

// https://{IP or URL}:32400/library/sections/{Library Code}/$LibScan?X-Plex-Token={TOKEN HERE}


echo "Unwatched: ";
$LibScan = "unwatched";
// https://{IP or URL}:32400/library/sections/{Library Code}/$LibScan?X-Plex-Token={TOKEN HERE}


echo "All: ";
$LibScan = "all";
// https://{IP or URL}:32400/library/sections/{Library Code}/$LibScan?X-Plex-Token={TOKEN HERE}


echo "Newest: ";
$LibScan = "newest";
// https://{IP or URL}:32400/library/sections/{Library Code}/$LibScan?X-Plex-Token={TOKEN HERE}


echo "Recently Added: ";
$LibScan = "recentlyAdded";
// https://{IP or URL}:32400/library/sections/{Library Code}/$LibScan?X-Plex-Token={TOKEN HERE}


?>