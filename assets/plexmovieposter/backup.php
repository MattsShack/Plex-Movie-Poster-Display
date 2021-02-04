<?php
include "importExportLib.php";

// This file is meant to be a headless action of the backup of the fully Plex movie poster Configuration
// Build a full backup system
// include config.php
// fonts
// Use date/time for file  name (included)
// file ext .pmp (works with zip ext)

// ToDos: 
//  - Fix issue when the cache folder does not exist

$rootDir = "../../";

$d = date("Y-m-d");
echo "Date: $d <br>";

$exportFileName = "PlexMoviePosterBackup_$d.pmp";
echo "Backup File: $exportFileName";

$source = "cache/fonts";
$source_FullName = join('/', array(trim($rootDir, '/'), trim($source, '/')));
print "<br>Source (In): $source_FullName <br>";

$destination = "cache/archive";
$destination_FullName = join('/', array(trim($rootDir, '/'), trim($destination, '/')));
print "<br>Destination (In): $destination_FullName <br>";

exportFiles($source_FullName, $destination_FullName, $exportFileName, "pmp", FALSE);

echo "<br>Download Backup: <a href=\"$destination_FullName/$exportFileName\">Here</a>";

