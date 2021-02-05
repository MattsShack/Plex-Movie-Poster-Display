<?php

function fixupSize($bytes) {
    //Fixup Size Calculations

    $places = '2';
    $size = array('B', 'KB', 'MB', 'GB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$places}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

function GeneralCache($destination = "../cache/posters/", $cacheField = "posterCount") {
    //Count Items in Cache
    
    if (!file_exists($destination)) {
        mkdir($destination, 0777, true);
    }

    $posters = scandir("$destination");
    $GLOBALS[$cacheField] = count($posters) - 2;
    if ($GLOBALS[$cacheField] < 0) {
        $GLOBALS[$cacheField] = 0;
    }
}

function PosterCache($destination = "../cache/posters/", $cacheField = "posterCount") {
    //Count Items in Posters

    if (!file_exists($destination)) {
        mkdir($destination, 0777, true);
    }

    $posters = scandir("$destination");
    $GLOBALS[$cacheField] = count($posters) - 2;
    if ($GLOBALS[$cacheField] < 0) {
        $GLOBALS[$cacheField] = 0;
    }
}

function PosterCacheClear($destination = "../cache/posters/") {
    //Clear Poster Cache Directory

    if (!file_exists($destination)) {
        mkdir($destination, 0777, true);
    }

    $files = glob("$destination/*");
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
}

function CustomCache($destination = "../cache/custom/", $cacheField = "customCount") {
    //Count Items in Custom Images

    if (!file_exists($destination)) {
        mkdir($destination, 0777, true);
    }

    $custom = scandir("$destination");
    $GLOBALS[$cacheField] = count($custom) - 2;
    if ($GLOBALS[$cacheField] < 0) {
        $GLOBALS[$cacheField] = 0;
    }
}

function CustomCacheClear($destination = "../cache/custom/") {
    //Clear Custom Cache Directory

    if (!file_exists($destination)) {
        mkdir($destination, 0777, true);
    }

    $files = glob("$destination/*");
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
}

function CustomFontCache($destination = "../cache/fonts/", $cacheField = "customFontCount") {
    //Count Items in Custom Font Cache Directory

    if (!file_exists($destination)) {
        mkdir($destination, 0777, true);
    }

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

function CustomFontCacheClear($destination = "../cache/fonts/") {
    //Clear Custom Font Cache Directory

    if (!file_exists($destination)) {
        mkdir($destination, 0777, true);
    }

    $files = glob("$destination/*");
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
}

?>