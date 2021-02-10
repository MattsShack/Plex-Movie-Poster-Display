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

?>