<?php

function fixupSize($bytes) {
    //Fixup Size Calculations

    $places = '2';
    $size = array('B', 'KB', 'MB', 'GB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$places}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

function GeneralCache_Count($destination = "../cache/posters/", $cacheField = "posterCount", $ScanSubDir = TRUE) {
    //Count Items in Cache

    // Create Ignore List (including fonts_custom.css, placeholder.txt)

    $ignoreDirs = array('');
    $ignoreFiles = array('fonts_custom.css','placeholder.txt');

    GeneralCache_Create($destination, "GeneralCache_Count");

    $fileCount = 0;

    if ($ScanSubDir == TRUE) {
        // Multi Level
        $dir_iterator = new RecursiveDirectoryIterator("$destination");
        $files = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);

        foreach($files as $file) {
            if (is_file($file)) {
                $file_parts = pathinfo($file);
                // if (preg_match("{[tT][tT][fF]}",$file_parts['extension'])) {
                    if (in_array(substr($file, strrpos($file, '/')+1), $ignoreFiles)) {
                        // Ignored File
                    }
                    else {
                        $fileCount = $fileCount + 1;
                    }
                // }
            }
        }
    }
    else {
        // Single Level
        $items = scandir("$destination");
        $fileCount = count($items) - 2;
    }

    $GLOBALS[$cacheField] = $fileCount;
    if ($GLOBALS[$cacheField] < 0) {
        $GLOBALS[$cacheField] = 0;
    }
}

function GeneralCache_Create($destination = "../cache/", $FeedFunction = "N/A") {
    // Generate the Cache Directory if it does not exist.

    if ($destination != "") {
        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }
    }
    else {
        echo "Invalid path provided by: $FeedFunction <br>";
    }
}

function GeneralCache_Prep($destination = "../cache/", $Clear_24H = FALSE) {
    echo "Debug (GeneralCache_Prep): $destination <br>";

    GeneralCache_Create($destination, "GeneralCache_Prep");
    GeneralCache_Clear_Placeholder($destination);

    if($Clear_24H == TRUE) {
        GeneralCache_Clear_24H($destination);
    }
}

function GeneralCache_Clear_Placeholder($destination) {
    // Clean Up placeholder files in cache folder.
    $placeHolderFile = "placeholder.txt";

    if ($destination != "") {
        if (file_exists("$destination/$placeHolderFile")) {
            unlink("$destination/$placeHolderFile");
        }
    }
}

function GeneralCache_Clear_24H($destination) {
    // Clean Up Cache Dir (Files Older than 24 hours)

    pmp_Logging("getCacheFile", "24hr Cache Clear: $destination");

    $ExpTime = "86400"; // 24hrs (X hrs. * 60 min. * 60 sec.)

    if ($destination != "") {
        if ($handle = opendir($destination)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && ((time() - filectime($destination . $file)) > $ExpTime)) {
                    unlink($destination . $file);
                }
            }
        }
    }
}

function GeneralCacheClear($destination = "../cache/posters/", $ScanSubDir = TRUE) {
    //Clear Cache Directory

    // Global Variables - Input
    global $pmpPosterDir, $pmpArtDir, $pmpCustomDir, $pmpFontDir, $pmpLogDir;

    switch ($destination) {
        case "poster":
            $destination = "../$pmpPosterDir";
            break;
        case "art":
            $destination = "../$pmpArtDir";
            break;
        case "custom":
            $destination = "../$pmpCustomDir";
            break;
        case "font":
            $destination = "../$pmpFontDir";
            break;
        case "log":
            $destination = "../$pmpLogDir";
            break;
        default:
            $destination = "../$pmpPosterDir";
            break;
    }

    GeneralCache_Create($destination, "GeneralCacheClear");

    if ($ScanSubDir == TRUE) {
        // Multi Level Search
        $dir_iterator = new RecursiveDirectoryIterator("$destination");
        $iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);
        // could use CHILD_FIRST if you so wish

        foreach ($iterator as $file) {
            $file_parts = pathinfo($file);
            $dirPath = $file_parts['dirname'];
            $dirPath = realpath($dirPath);

            // if (is_file($file)) {
            //     pmp_Logging("getCacheFile", "Removing Item ($destination): $file");
            //     unlink($file);
            // }

            if (is_dir($dirPath)) {
                $objects = scandir($dirPath);
                foreach ($objects as $object) {
                    if ($object != "." && $object != "..") {
                        if (is_dir($dirPath. DIRECTORY_SEPARATOR .$object) && !is_link($dirPath."/".$object)) {
                            pmp_Logging("getCacheFile", "\tPurge empty cache directory".$dirPath. DIRECTORY_SEPARATOR .$object );
                            rmdir($dirPath. DIRECTORY_SEPARATOR .$object);
                        }
                        else {
                            pmp_Logging("getCacheFile", "\tPurge files from cache directory ($destination).".$dirPath. DIRECTORY_SEPARATOR .$object);
                            unlink($dirPath. DIRECTORY_SEPARATOR .$object);
                        }
                    }
                }
                rmdir($fontPath);
            }
        }
    }
    else {
        // Single Level Search
        $files = glob("$destination/*");
        foreach ($files as $file) {
            if (is_file($file)) {
                pmp_Logging("getCacheFile", "Removing Image ($destination): $file");
                unlink($file);
            }
        }
    }
}

function CacheInfo_Display($MiniStatus = FALSE) {
    global $posterCount, $customCount, $customFontCount, $logCount, $BGArtCount;

    GeneralCache_Count("../cache/posters/", "posterCount");
    GeneralCache_Count("../cache/art/", "BGArtCount");
    GeneralCache_Count("../cache/custom/", "customCount");
    GeneralCache_Count("../cache/fonts/", "customFontCount");
    GeneralCache_Count("../cache/logs/", "logCount");

    $cacheFreeSpace = fixupSize(disk_free_space("/"));

    if ($MiniStatus == TRUE) {
        $tblClass = "StatsShort";
    }
    else {
        $tblClass = "StatsLong";
    }

    echo "<table class=\"$tblClass\">";

    CacheInfo_Display_ROW("Posters:","$posterCount","Items in cache/posters","clearPosterCache",TRUE, $MiniStatus);
    CacheInfo_Display_ROW("Background Art:","$BGArtCount","Items in cache/art","clearArtCache",TRUE, $MiniStatus);
    CacheInfo_Display_ROW("Custom Images:","$customCount","Items in cache/custom","clearCustomCache",TRUE, $MiniStatus);
    CacheInfo_Display_ROW("Custom Fonts:","$customFontCount","Items in cache/fonts","clearFontCache",TRUE, $MiniStatus);
    CacheInfo_Display_ROW("Custom Logs:","$logCount","Items in cache/logs","clearLogCache",TRUE, $MiniStatus);
    CacheInfo_Display_ROW("Free Space:","$cacheFreeSpace","Free space on /","",FALSE, $MiniStatus);

    echo "</table>\n";
}

function CacheInfo_Display_ROW($Title, $Value, $Help, $btnID, $btnStatus = TRUE, $MiniStatus = FALSE){

    $Display_Title = $Title;
    $Display_Value = $Value;

    if ($MiniStatus == TRUE) {
        $Display_Help = "";
        $btnID = "";
        $trClass = "StatsShort";
        $tdClass = "StatsShort";
        $tdBtnCol = FALSE;
    }
    else {
        $Display_Help = $Help;
        $btnID = $btnID;
        $trClass = "";
        $tdClass = "";
        $tdBtnCol = TRUE;
    }

    if ($btnStatus == TRUE) {
        $btnActionStatus = "";
    }
    else {
        $btnActionStatus = "disabled";
    }

    echo "<tr class=\"$trClass\">\n";

    echo "<td class=\"$tdClass\">\n";
    echo "$Display_Title\n";

        if ($Display_Help != "") {
            echo "<p class=\"help-block\">\n";
            echo "  <small class=\"text-muted\">$Display_Help</small>\n";
            echo "</p>\n";
        }
    echo "</td>\n";

    echo "<td class=\"$tdClass StatsVal\">\n";
    echo "$Display_Value\n";
    echo "</td>\n";

    if ($tdBtnCol == TRUE) {
        echo "<td class=\"$tdClass\">\n";
            if ($btnID != "") {
                echo "<form method=\"post\" class=\"needs-validation\" novalidate >\n";
                echo "  <button name=\"$btnID\" id=\"$btnID\" type=\"submit\" class=\"btn btn-danger btn-sm\" value=\"$btnID\" $btnActionStatus>\n";
                echo "      Clear Cache\n";
                echo "  </button>\n";
                echo "</form>\n";
            }
        echo "</td>\n";
    }

    echo "</tr>\n";
}

function CacheConfig_Display() {
    // Global Variables - Input
    global $pmpPosterDir, $pmpPosterDir_24hExp;
    global $pmpArtDir, $pmpArtDir_24hExp;
    global $pmpCustomDir, $pmpCustomDir_24hExp;
    global $pmpFontDir, $pmpFontDir_24hExp;
    global $pmpLogDir, $pmpLogDir_24hExp;

    $tblClass = "";

    echo "<table class=\"$tblClass\">";

    CacheConfig_Display_ROW("Posters:",TRUE,"pmpPosterDir","$pmpPosterDir","pmpPosterDir_24hExp","$pmpPosterDir_24hExp","cache/posters/");
    CacheConfig_Display_ROW("Background Art:",TRUE,"pmpArtDir","$pmpArtDir","pmpArtDir_24hExp","$pmpArtDir_24hExp","cache/art/");
    CacheConfig_Display_ROW("Custom Images:",TRUE,"pmpCustomDir","$pmpCustomDir","pmpCustomDir_24hExp","$pmpCustomDir_24hExp","cache/custom/");
    CacheConfig_Display_ROW("Custom Fonts:",TRUE,"pmpFontDir","$pmpFontDir","pmpFontDir_24hExp","$pmpFontDir_24hExp","cache/fonts/");
    CacheConfig_Display_ROW("Custom Logs:",TRUE,"pmpLogDir","$pmpLogDir","pmpLogDir_24hExp","$pmpLogDir_24hExp","cache/logs/");

    echo "</table>\n";
}

function CacheConfig_Display_ROW($Title, $Help, $InputField, $InputValue, $InputFieldExp, $InputValueExp,$InputPlaceholder){

    $Display_Title = $Title;
    $Display_Help_Title = "Location for $InputValue";
    $tdClass = "";

    echo "<tr class=\"$trClass\">\n";
    echo "<td class=\"$tdClass\">\n";

    echo "$Display_Title\n";

    if ($Display_Help_Title != "") {
        echo "<p class=\"help-block\">\n";
        echo "  $Display_Help_Title\n";
        echo "</p>\n";
    }

    echo "</td>\n";
    echo "<td class=\"$tdClass StatsVal\">\n";

    echo "<input type=\"text\" id=\"$InputField\" name=\"$InputField\" class=\"form-control fieldInfo-large form-inline\" placeholder=\"$InputPlaceholder\" value=\"$InputValue\" required>";

    echo "</td>\n";
    echo "<td class=\"$tdClass\">\n";

    if ($InputValueExp == TRUE) {
        $CheckBoxStatus = "checked";
    }
    else {
        $CheckBoxStatus = "";
    }

    echo "24hr Expire: &nbsp\n";
    echo "<label class=\"switch\">";
    echo "<input type=\"checkbox\" name=\"$InputFieldExp\" id=\"$InputFieldExp\" value=\"1\" $CheckBoxStatus>\n";
    echo "<span class=\"slider round\"></span>";
    echo "</label>";
    echo "\n";
    echo "<p class=\"help-block\">\n";
    echo "24hr expiration for files in this path.\n";
    echo "</p>\n";

    echo "</td>\n";
    echo "</tr>\n";
}

function CacheValidate() {
    // Global Variables - Input
    global $pmpPosterDir, $pmpPosterDir_24hExp;
    global $pmpArtDir, $pmpArtDir_24hExp;
    global $pmpCustomDir, $pmpCustomDir_24hExp;
    global $pmpFontDir, $pmpFontDir_24hExp;
    global $pmpLogDir, $pmpLogDir_24hExp;

    // Global Variables - Output
    global $cachePath, $cacheArtPath, $customPath, $FontPath, $LogPath;

    // Poster Cache
    $cachePath = $pmpPosterDir;
    echo "Creating: $cachePath <br>";
    GeneralCache_Prep($cachePath, $pmpPosterDir_24hExp);

    // Art Cache
    $cacheArtPath = $pmpArtDir;
    echo "Creating: $cacheArtPath <br>";
    GeneralCache_Prep($cacheArtPath, $pmpArtDir_24hExp);

    // Custom Cache
    $customPath = $pmpCustomDir;
    echo "Creating: $customPath <br>";
    GeneralCache_Prep($customPath, $pmpCustomDir_24hExp);

    // Font Cache
    $FontPath = $pmpFontDir;
    echo "Creating: $FontPath <br>";
    GeneralCache_Prep($FontPath, $pmpFontDir_24hExp);

    // Log Cache
    $LogPath = $pmpLogDir;
    echo "Creating: $LogPath <br>";
    GeneralCache_Prep($LogPath, $pmpLogDir_24hExp);
}

?>