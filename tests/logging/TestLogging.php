<?php 
include '../../assets/plexmovieposter/tools.php';
include '../../assets/plexmovieposter/CacheLib.php';
$path = "../../cache/logs";

// -------------------------
// Log Cache
// $LogPath = $pmpLogDir;
$LogPath = $path;
echo "Creating: $LogPath <br>";
GeneralCache_Prep($LogPath, FALSE);
// -------------------------


pmp_Logging("getMediaThumb", "Test Logging");

// exit;

$files = array_diff(scandir($path), array('.', '..'));

foreach ($files as $file) {
    echo "$file <br>";
}

?>