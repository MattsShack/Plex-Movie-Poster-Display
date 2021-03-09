<?php

function fixupSize($bytes) {
    //Fixup Size Calculations

    $places = '2';
    $size = array('B', 'KB', 'MB', 'GB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$places}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

function GeneralCache_Count($destination = "../cache/posters/", $cacheField = "posterCount") {
    //Count Items in Cache

    GeneralCache_Create($destination);

    $posters = scandir("$destination");
    $GLOBALS[$cacheField] = count($posters) - 2;
    if ($GLOBALS[$cacheField] < 0) {
        $GLOBALS[$cacheField] = 0;
    }
}

function GeneralCache_Create($destination = "../cache/") {
    // Generate the Cache Directory if it does not exist.

    if (!file_exists($destination)) {
        mkdir($destination, 0777, true);
    }
}

function GeneralCache_Prep($destination = "../cache/", $Clear_24H = FALSE) {
    GeneralCache_Create($destination);
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

function GeneralCache_Clear_24H ($destination) {
    // Clean Up Cache Dir (Files Older than 24 hours)

    if ($destination != "") {
        if ($handle = opendir($destination)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && ((time() - filectime($destination . $file)) > 86400)) {
                    unlink($destination . $file);
                }
            }
        }
    }
}

function PosterCacheCount($destination = "../cache/posters/", $cacheField = "posterCount") {
    //Count Items in Posters

    GeneralCache_Create($destination);

    $posters = scandir("$destination");
    $GLOBALS[$cacheField] = count($posters) - 2;
    if ($GLOBALS[$cacheField] < 0) {
        $GLOBALS[$cacheField] = 0;
    }
}

function PosterCacheClear($destination = "../cache/posters/") {
    //Clear Poster Cache Directory

    GeneralCache_Create($destination);

    $files = glob("$destination/*");
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
}

function CustomCacheCount($destination = "../cache/custom/", $cacheField = "customCount") {
    //Count Items in Custom Images

    GeneralCache_Create($destination);

    $custom = scandir("$destination");
    $GLOBALS[$cacheField] = count($custom) - 2;
    if ($GLOBALS[$cacheField] < 0) {
        $GLOBALS[$cacheField] = 0;
    }
}

function CustomCacheClear($destination = "../cache/custom/") {
    //Clear Custom Cache Directory

    GeneralCache_Create($destination);

    $files = glob("$destination/*");
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
}

function FontCacheCount($destination = "../cache/fonts/", $cacheField = "customFontCount") {
    //Count Items in Custom Font Cache Directory

    GeneralCache_Create($destination);

    $fileCount = 0;

    $dir_iterator = new RecursiveDirectoryIterator("$destination");
    $files = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);

    foreach($files as $file) {
        $file_parts = pathinfo($file);
        if (preg_match("{[tT][tT][fF]}",$file_parts['extension'])) {
            $fileCount = $fileCount + 1;
        }
    }

    $GLOBALS[$cacheField] = $fileCount;
    if ($GLOBALS[$cacheField] < 0) {
        $GLOBALS[$cacheField] = 0;
    }
}

function FontCacheClear($destination = "../cache/fonts/") {
    //Clear Custom Font Cache Directory

    GeneralCache_Create($destination);

    $files = glob("$destination/*");
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
}

function CacheInfo_Display($MiniStatus = FALSE) {
    global $posterCount, $customCount, $customFontCount;


    GeneralCache_Count("../cache/posters/", "posterCount");

    GeneralCache_Count("../cache/custom/", "customCount");
    FontCacheCount();

    $cacheFreeSpace = fixupSize(disk_free_space("/"));

    if ($MiniStatus == TRUE) {
        $tblClass = "StatsShort";
    }
    else {
        $tblClass = "StatsLong";
    }

    echo "<table class=\"$tblClass\">";

    CacheInfo_Display_ROW("Posters:","$posterCount","Items in cache/posters","clearPosterCache",TRUE, $MiniStatus);
    CacheInfo_Display_ROW("Custom Images:","$customCount","Items in cache/custom","clearCustomCache",TRUE, $MiniStatus);
    CacheInfo_Display_ROW("Custom Fonts:","$customFontCount","Items in cache/fonts","clearFontCache",FALSE, $MiniStatus);
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

?>