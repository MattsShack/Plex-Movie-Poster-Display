<?php

function getData_PreLoad() {
    // This function is to replace the presetting of variables that is at the top of the getData.php page
    // These will be eventually replaced by an object that is now set as $PMPDDisplay.  Each 'Legacy' variable should have a paired 'future' variable as part of the object.

    // Global Variables - Input
    // - None Defined

    // Global Variables - Output
    global $PMPDDisplay;

    global $isPlaying;
    global $mediaThumb_Display, $mediaArt_Status, $mediaArt_Display;
    global $RefreshSpeed, $photoModeStatus, $title;
    global $mediaTitle, $mediaSummary, $mediaTagline;
    global $topSelection, $topLine, $topCustom, $autoScaleTop, $topScroll;
    global $topText, $topSize, $topColor, $topStrokeSize, $topStrokeColor, $topFontEnabled, $topFontID;
    global $bottomSelection, $bottomLine, $bottomCustom, $autoScaleBottom, $bottomScroll;
    global $bottomText, $bottomSize, $bottomColor, $bottomStrokeSize, $bottomStrokeColor, $bottomFontEnabled, $bottomFontID;

    // Business Logic - Future
        $PMPDDisplay = []; // Variables - Future

    // Business Logic

    // Core Settings
        $isPlaying = false;

    // General Settings
        $mediaThumb_Display = ""; // Variables - Legacy
        $PMPDDisplay['mediaThumb_Display'] = ""; // Variables - Future

        $mediaArt_Status = ""; // Variables - Legacy
        $PMPDDisplay['mediaArt_Status'] = ""; // Variables - Future

        $mediaArt_Display = ""; // Variables - Legacy
        $PMPDDisplay['mediaArt_Display'] = ""; // Variables - Future

        $RefreshSpeed = 30; // Variables - Legacy
        $PMPDDisplay['RefreshSpeed'] = 30; // Variables - Future

        $photoModeStatus = FALSE; // Variables - Legacy
        $PMPDDisplay['photoModeStatus'] = FALSE; // Variables - Future

        $title = ""; // Variables - Legacy
        $PMPDDisplay['title'] = ""; // Variables - Future

    // Media Settings
        $mediaTitle = ""; // Variables - Legacy
        $PMPDDisplay['mediaTitle'] = ""; // Variables - Future

        $mediaSummary = ""; // Variables - Legacy
        $PMPDDisplay['mediaSummary'] = ""; // Variables - Future

        $mediaTagline = ""; // Variables - Legacy
        $PMPDDisplay['mediaTagline'] = ""; // Variables - Future

    // Top Settings
        $topSelection = FALSE; // Variables - Legacy
        $PMPDDisplay['topSelection'] = FALSE; // Variables - Future

        $topLine = ""; // Variables - Legacy
        $PMPDDisplay['topLine'] = ""; // Variables - Future

        $topCustom = ""; // Variables - Legacy
        $PMPDDisplay['topCustom'] = ""; // Variables - Future

        $autoScaleTop = FALSE; // Variables - Legacy
        $PMPDDisplay['autoScaleTop'] = FALSE; // Variables - Future

        $topScroll = FALSE; // Variables - Legacy
        $PMPDDisplay['topScroll'] = FALSE; // Variables - Future

        $topText = ""; // Variables - Legacy
        $PMPDDisplay['topText'] = ""; // Variables - Future

        $topSize = ""; // Variables - Legacy
        $PMPDDisplay['topSize'] = ""; // Variables - Future

        $topColor = ""; // Variables - Legacy
        $PMPDDisplay['topColor'] = ""; // Variables - Future

        $topStrokeSize = ""; // Variables - Legacy
        $PMPDDisplay['topStrokeSize'] = ""; // Variables - Future

        $topStrokeColor = ""; // Variables - Legacy
        $PMPDDisplay['topStrokeColor'] = ""; // Variables - Future

        $topFontEnabled = FALSE; // Variables - Legacy
        $PMPDDisplay['topFontEnabled'] = FALSE; // Variables - Future

        $topFontID = ""; // Variables - Legacy
        $PMPDDisplay['topFontID'] = ""; // Variables - Future

    // Bottom Settings
        $bottomSelection = FALSE; // Variables - Legacy
        $PMPDDisplay['bottomSelection'] = FALSE; // Variables - Future

        $bottomLine = ""; // Variables - Legacy
        $PMPDDisplay['bottomLine'] = ""; // Variables - Future

        $bottomCustom = ""; // Variables - Legacy
        $PMPDDisplay['bottomCustom'] = ""; // Variables - Future

        $autoScaleBottom = FALSE; // Variables - Legacy
        $PMPDDisplay['autoScaleBottom'] = FALSE; // Variables - Future

        $bottomScroll = FALSE; // Variables - Legacy
        $PMPDDisplay['bottomScroll'] = FALSE; // Variables - Future

        $bottomText = ""; // Variables - Legacy
        $PMPDDisplay['bottomText'] = ""; // Variables - Future

        $bottomSize = ""; // Variables - Legacy
        $PMPDDisplay['bottomSize'] = ""; // Variables - Future

        $bottomColor = ""; // Variables - Legacy
        $PMPDDisplay['bottomColor'] = ""; // Variables - Future

        $bottomStrokeSize = ""; // Variables - Legacy
        $PMPDDisplay['bottomStrokeSize'] = ""; // Variables - Future

        $bottomStrokeColor = ""; // Variables - Legacy
        $PMPDDisplay['bottomStrokeColor'] = ""; // Variables - Future

        $bottomFontEnabled = FALSE; // Variables - Legacy
        $PMPDDisplay['bottomFontEnabled'] = FALSE; // Variables - Future

        $bottomFontID = ""; // Variables - Legacy
        $PMPDDisplay['bottomFontID'] = ""; // Variables - Future
}

function CustomImage_getData() {
    // This function is to replace all the logic used in the getData.php for custom images on load.
    // TODO: Add Random Image support.  Sample code in the CustomImgTest.php file.

    // When moved to PHP 8.x use str_contains instead of strpos.

    // Global Variables - Input
    global $data;
    global $pmpCustomDir;
    global $customRefreshSpeed, $customImage, $customPath, $customBackgroundArt;
    global $customTopText, $customTopFontSize, $customTopFontColor, $customTopFontOutlineSize, $customTopFontOutlineColor, $customTopFontEnabled, $customTopFontID;
    global $customBottomText, $customBottomFontSize, $customBottomFontColor, $customBottomFontOutlineSize, $customBottomFontOutlineColor, $customBottomFontEnabled, $customBottomFontID;

    // Global Variables - Output
    global $RefreshSpeed, $mediaThumb_Display, $mediaArt_Display, $mediaArt_Status, $photoModeStatus;
    global $topText, $topSize, $topColor, $topStrokeSize, $topStrokeColor, $topFontEnabled, $topFontID;
    global $bottomText, $bottomSize, $bottomColor, $bottomStrokeSize, $bottomStrokeColor, $bottomFontEnabled, $bottomFontID;

    // Business Logic
    $data['type'] = 'custom';

    if (!empty($customRefreshSpeed)) {
        $RefreshSpeed = $customRefreshSpeed;
    }

    // $topSelection = $nowShowingTop;
    $topText = $customTopText;
    $topSize = $customTopFontSize;
    $topColor = $customTopFontColor;
    $topStrokeSize = $customTopFontOutlineSize;
    $topStrokeColor = $customTopFontOutlineColor;
    $topFontEnabled = $customTopFontEnabled;
    $topFontID = $customTopFontID;

    // $bottomSelection = $nowShowingBottom;
    $bottomText = $customBottomText;
    $bottomSize = $customBottomFontSize;
    $bottomColor = $customBottomFontColor;
    $bottomStrokeSize = $customBottomFontOutlineSize;
    $bottomStrokeColor = $customBottomFontOutlineColor;
    $bottomFontEnabled = $customBottomFontEnabled;
    $bottomFontID = $customBottomFontID;

    if ($customImage == "RANDOM") {
        $source = $pmpCustomDir;
        $mediaArr = array();

        $dir_iterator = new RecursiveDirectoryIterator("$source");
        $iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);

        foreach ($iterator as $file) {
            if (is_file($file)) {
                array_push($mediaArr, $file);
            }
        }

        $mediaCount = count($mediaArr);
        $random_keys = array_rand($mediaArr, 1);

        $image_Name = $mediaArr[$random_keys];

        pmp_Logging("PMPD_CustomImage", "RANDOM Image (PRE): $image_Name");

        $Validate_IMGPath = strpos(" $image_Name", "$source"); //strpos gets the position of the found string, if not found returns _NULL/FALSE

        if ($Validate_IMGPath == TRUE) {
            // $image_FullName = "$image_Name";
            $image_FullName = "../$image_Name";
            pmp_Logging("PMPD_CustomImage", "RANDOM Image (PROCESS A): $image_FullName");
        }
        else {
            $image_FullName = "$source/$image_Name";
            pmp_Logging("PMPD_CustomImage", "RANDOM Image (PROCESS B): $image_FullName");
        }

        pmp_Logging("PMPD_CustomImage", "RANDOM Image (POST): $image_FullName");
        $customImage = $image_FullName;
    }

    $Validate_IMGPath = strpos(" $customImage", "$customPath"); //strpos gets the position of the found string, if not found returns _NULL/FALSE

    if ($Validate_IMGPath == TRUE) {
        $mediaThumb_Display = "url('$customImage')";
    }
    else {
        $mediaThumb_Display = "url('$customPath/$customImage')";
    }

    if ($Validate_IMGPath == TRUE) {
        $mediaArt_Display = "url('$customImage')";
    }
    else {
        $mediaArt_Display = "url('$customPath/$customImage')";
    }

    $mediaArt_Status = $customBackgroundArt;

    if ($mediaArt_Status == TRUE) {
        $mediaThumb_Display = "";
        $photoModeStatus = TRUE;
    }
}

?>