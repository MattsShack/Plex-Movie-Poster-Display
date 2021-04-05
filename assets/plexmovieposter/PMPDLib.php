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
    global $RefreshSpeed, $BackgroundArtMode, $FullScreenArtMode, $title;
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

        $BackgroundArtMode = FALSE; // Variables - Legacy
        $PMPDDisplay['BackgroundArtMode'] = FALSE; // Variables - Future

        $FullScreenArtMode = FALSE; // Variables - Legacy
        $PMPDDisplay['FullScreenArtMode'] = FALSE; // Variables - Future

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
    global $data, $PMPDDisplay;
    global $pmpCustomDir;
    global $customRefreshSpeed, $customImage, $customPath, $customBackgroundArt, $customFullScreenArt;
    global $customTopText, $customTopFontSize, $customTopFontColor, $customTopFontOutlineSize, $customTopFontOutlineColor, $customTopFontEnabled, $customTopFontID;
    global $customBottomText, $customBottomFontSize, $customBottomFontColor, $customBottomFontOutlineSize, $customBottomFontOutlineColor, $customBottomFontEnabled, $customBottomFontID;

    // Global Variables - Output
    global $RefreshSpeed, $mediaThumb_Display, $mediaArt_Display, $mediaArt_Status, $FullScreenArtMode;
    global $topText, $topSize, $topColor, $topStrokeSize, $topStrokeColor, $topFontEnabled, $topFontID;
    global $bottomText, $bottomSize, $bottomColor, $bottomStrokeSize, $bottomStrokeColor, $bottomFontEnabled, $bottomFontID;

    // Business Logic
    $data['type'] = 'custom';

    if (!empty($customRefreshSpeed)) {
        $RefreshSpeed = $customRefreshSpeed;
        $PMPDDisplay['RefreshSpeed'] = $customRefreshSpeed;
    }

    // $topSelection = $nowShowingTop;
    $topText = $customTopText;
    $PMPDDisplay['topText'] = $customTopText;

    $topSize = $customTopFontSize;
    $PMPDDisplay['topSize'] = $customTopFontSize;

    $topColor = $customTopFontColor;
    $PMPDDisplay['topColor'] = $customTopFontColor;

    $topStrokeSize = $customTopFontOutlineSize;
    $PMPDDisplay['topStrokeSize'] = $customTopFontOutlineSize;

    $topStrokeColor = $customTopFontOutlineColor;
    $PMPDDisplay['topStrokeColor'] = $customTopFontOutlineColor;

    $topFontEnabled = $customTopFontEnabled;
    $PMPDDisplay['topFontEnabled'] = $customTopFontEnabled;

    $topFontID = $customTopFontID;
    $PMPDDisplay['topFontID'] = $customTopFontID;

    // $bottomSelection = $nowShowingBottom;
    $bottomText = $customBottomText;
    $PMPDDisplay['bottomText'] = $customBottomText;

    $bottomSize = $customBottomFontSize;
    $PMPDDisplay['bottomSize'] = $customBottomFontSize;

    $bottomColor = $customBottomFontColor;
    $PMPDDisplay['bottomColor'] = $customBottomFontColor;

    $bottomStrokeSize = $customBottomFontOutlineSize;
    $PMPDDisplay['bottomStrokeSize'] = $customBottomFontOutlineSize;

    $bottomStrokeColor = $customBottomFontOutlineColor;
    $PMPDDisplay['bottomStrokeColor'] = $customBottomFontOutlineColor;

    $bottomFontEnabled = $customBottomFontEnabled;
    $PMPDDisplay['bottomFontEnabled'] = $customBottomFontEnabled;

    $bottomFontID = $customBottomFontID;
    $PMPDDisplay['bottomFontID'] = $customBottomFontID;

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
        $PMPDDisplay['mediaThumb_Display'] = "url('$customImage')";
    }
    else {
        $mediaThumb_Display = "url('$customPath/$customImage')";
        $PMPDDisplay['mediaThumb_Display'] = "url('$customPath/$customImage')";
    }

    if ($Validate_IMGPath == TRUE) {
        $mediaArt_Display = "url('$customImage')";
        $PMPDDisplay['mediaArt_Display'] = "url('$customImage')";
    }
    else {
        $mediaArt_Display = "url('$customPath/$customImage')";
        $PMPDDisplay['mediaArt_Display'] = "url('$customPath/$customImage')";
    }

    $mediaArt_Status = $customBackgroundArt;
    $PMPDDisplay['mediaArt_Status'] = $customBackgroundArt;

    $FullScreenArtMode = $customFullScreenArt;
    $PMPDDisplay['FullScreenArtMode'] = $customFullScreenArt;
}

function SetFullScreenMode($SetMode = FALSE) {
    // Global Variables - Input
    global $PMPDDisplay;
    global $mediaArt_Status, $mediaThumb_Display;

    // Global Variables - Output
    global $FullScreenArtMode;
    global $topText, $bottomText;

    if ($SetMode == TRUE) {
        $mediaArt_Display = $mediaThumb_Display;
        $PMPDDisplay['mediaArt_Display'] = $mediaThumb_Display;

        $FullScreenArtMode = TRUE;
        $PMPDDisplay['FullScreenArtMode'] = TRUE;
    }
}

function PMPD_DisplayMediaInfo() {
    // Global Variables - Input
    global $mediaContentRating, $mediaVideoCodec, $mediaVideoResolution, $mediaAudioCodec, $mediaAudioChannelLayout;
    global $bottomSize;
    
    // Global Variables - Output
    global $bottomLine;

    $iconPath = "assets/plexmovieposter/images/icons/mediaInfo";

    $title = "PRESENTED IN";

    // https://www.spectrum.net/support/tv/tv-and-movie-ratings-descriptions/

    $iconChangeID = "2021-03-31";

    switch ($mediaContentRating) {
        case "N/A":
            $contentRatingProfile = "$iconPath/Rated-NA.png?$iconChangeID";
            break;
        case "TV-Y":
            $contentRatingProfile = "$iconPath/Rated-TVY.png?$iconChangeID";
            break;
        case "TV-Y7":
            $contentRatingProfile = "$iconPath/Rated-TVY7.png?$iconChangeID";
            break;
        case "TV-Y7 FV":
            $contentRatingProfile = "$iconPath/Rated-TVY7FV.png?$iconChangeID";
            break;
        case "G":
            $contentRatingProfile = "$iconPath/Rated-G.png?$iconChangeID";
            break;
        case "TV-G":
            $contentRatingProfile = "$iconPath/Rated-TVG.png?$iconChangeID";
            break;
        case "PG":
            $contentRatingProfile = "$iconPath/Rated-PG.png?$iconChangeID";
            break;
        case "TV-PG":
            $contentRatingProfile = "$iconPath/Rated-TVPG.png?$iconChangeID";
            break;
        case "PG-13":
            $contentRatingProfile = "$iconPath/Rated-PG13.png?$iconChangeID";
            break;
        case "TV-14":
            $contentRatingProfile = "$iconPath/Rated-TV14.png?$iconChangeID";
            break;
        case "R":
            $contentRatingProfile = "$iconPath/Rated-R.png?$iconChangeID";
            break;
        case "TV-MA":
            $contentRatingProfile = "$iconPath/Rated-TVMA.png?$iconChangeID";
            break;
        case "NC-17":
            $contentRatingProfile = "$iconPath/Rated-NC17.png?$iconChangeID";
            break;
        case "XXX":
            $contentRatingProfile = "$iconPath/Rated-XXX.png?$iconChangeID";
            break;
        default:
            $contentRatingProfile = "$iconPath/Rated-NA.png?$iconChangeID";
            break;
    }

    if ($contentRatingProfile != "") {
        $contentRatingProfile = "<img  src=\"$contentRatingProfile\">";
    }

    switch ($mediaVideoResolution)  {
        case "N/A":
            $videoResolutionProfile = "";
            break;
        case "sd":
            $videoResolutionProfile = "$iconPath/Res-SD.png?$iconChangeID";
            break;
        case "720":
            $videoResolutionProfile = "$iconPath/Res-HD720.png?$iconChangeID";
            break;
        case "720p":
            $videoResolutionProfile = "$iconPath/Res-HD720.png?$iconChangeID";
            break;
        case "1080":
            $videoResolutionProfile = "$iconPath/Res-HD1080.png?$iconChangeID";
            break;
        case "1080p":
            $videoResolutionProfile = "$iconPath/Res-HD1080.png?$iconChangeID";
            break;
        case "4k":
            $videoResolutionProfile = "$iconPath/Res-UHD4K.png?$iconChangeID";
            break;
        case "8k":
            $videoResolutionProfile = "$iconPath/Res-UHD8K.png?$iconChangeID";
            break;
        default:
            $videoResolutionProfile = "";
            break;
    }
    
    if ($videoResolutionProfile != "") {
        $videoResolutionProfile = "<img src=\"$videoResolutionProfile\">";
    }

    switch ($mediaVideoCodec)  {
        case "N/A":
            $videoCodecProfile = "";
            break;
        case "h264":
            $videoCodecProfile = "";
            break;
        case "mpeg4":
            $videoCodecProfile = "";
            break;
        case "hevc":
            $videoCodecProfile = "";
            break;
        default:
            $videoCodecProfile = "";
            break;
    }

    if ($videoCodecProfile != "") {
        $videoCodecProfile = "<img src=\"$videoCodecProfile\">";
    }

    switch ($mediaAudioCodec)  {
        case "N/A":
            $audioCodecProfile = "";
            break;
        case "aac":
            $audioCodecProfile = "";
            break;
        case "ac3":
            $audioCodecProfile = "";
            break;
        case "eac3":
            $audioCodecProfile = "";
            break;
        case "dca":
            $audioCodecProfile = "";
            break;
        case "dca-ma":
            $audioCodecProfile = "";
            break;
        case "mp3":
            $audioCodecProfile = "";
            break;
        case "opus":
            $audioCodecProfile = "";
            break;
        default:
            $audioCodecProfile = "";
            break;
    }
    
    if ($audioCodecProfile != "") {
        $audioCodecProfile = "<img src=\"$audioCodecProfile\">";
    }

    switch ($mediaAudioChannelLayout)  {
        case "N/A":
            $audioChannelLayoutProfile = "";
            break;
        case "mono":
            $audioChannelLayoutProfile = "$iconPath/Sound-Mono.png?$iconChangeID";
            break;
        case "stereo":
            $audioChannelLayoutProfile = "$iconPath/Sound-2.0.png?$iconChangeID";
            break;
        // case "5.1":
        case (preg_match('/5.1.*/', $mediaAudioChannelLayout) ? TRUE : FALSE):
            $audioChannelLayoutProfile = "$iconPath/Sound-5.1.png?$iconChangeID";
            break;
        case "7.1":
            $audioChannelLayoutProfile = "$iconPath/Dolby_TRUEHD71.png?$iconChangeID";
            break;
        default:
            $audioCodecProfile = "";
            break;
    }
    
    if ($audioChannelLayoutProfile != "") {
        $audioChannelLayoutProfile = "<img src=\"$audioChannelLayoutProfile\">";
    }

    $profileHeader = "";
    $titleProfile = "<div class=\"showMetadata\" style=\"font-size:${bottomSize}px\">$title<p><p>";

    $profileFooter = "</div>";

    $mediaProfiles = $videoResolutionProfile . $videoCodecProfile . $audioChannelLayoutProfile . $contentRatingProfile;

    $masterProfile = "$profileHeader $titleProfile $mediaProfiles $profileFooter";

    $bottomLine = $masterProfile;
}

function PMPD_SetResults() {

    // Global Variables - Input
    global $PMPDDisplay;
    global $topLine, $progressBar, $mediaThumb_Display, $mediaArt_Status, $mediaArt_Display, $bottomLine;
    global $RefreshSpeed;

    // Global Variables - Output
    global $results;

    // Business Logic
    $results = [];

    $results['refreshSpeed'] = ($RefreshSpeed);
    $results['fullScreenMode'] = $PMPDDisplay['FullScreenArtMode'] ; // Future Use (Issue #48)

    if ($PMPDDisplay['FullScreenArtMode'] == TRUE) {
        $results['top'] = "";
        $results['middle'] = "";
        $results['mediaArt'] = $PMPDDisplay['mediaArt_Display'];
        $results['bottom'] = "";
    }
    else {
        $results['top'] = $topLine . $progressBar;
        $results['middle'] = $mediaThumb_Display;

        if ($mediaArt_Status) {
            $results['mediaArt'] = $mediaArt_Display;
        } else {
            $results['mediaArt'] = "";
        }

        $results['bottom'] = $bottomLine;
    }
}
?>