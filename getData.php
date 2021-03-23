<?php
//For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
include 'config.php';
include 'status.php';
include 'assets/plexmovieposter/tools.php';
include 'assets/plexmovieposter/CacheLib.php';
include 'assets/plexmovieposter/PMPDLib.php';
include 'assets/plexmovieposter/PlexLib.php';
include 'assets/plexmovieposter/getPoster.php';

$results = Array();
$mediaArr = Array();

ob_start();
$data = [];

CacheValidate();  // Validate all defined Cache folders and settings.
getData_PreLoad(); // Setup default variables that will be required throughout the process.

plex_server_Settings(); // Server setting for PLEX interaction.

//Display Custom Image if Enabled
if ($customImageEnabled == "Enabled") {
    CustomImage_getData(); // Moved all actions to a function in the PMPDLib.php file.
} else {
    // Plex Module Connect to Plex Server

    // Store this for debugging
    $data['sessionUrl'] = $plexServerURL;
    pmp_Logging("getMediaURL", "Session URL: " . $data['sessionUrl']);

    $data['plexClient'] = $plexClient;
    $data['plexClientName'] = $plexClientName;
    $getXml = file_get_contents($plexServerURL);

    $xml = simplexml_load_string($getXml) or die("feed not loading");
    $isPlaying = false;
    if ($xml['size'] != '0') {
        $data['hasXml'] = true;

        if ($xml->Video) {
            $mediaType = "Video";
        }
        if ($xml->Track) {
            $mediaType = "Track";
        }

        foreach ($xml->$mediaType as $clients) {
            plex_isPlaying_dataProcess();

            // If this matches our client IP or name, gather data
            if (in_array($PLEX_PlayerAddress, $PLEX_Client_ARR) || in_array($PLEX_PlayerAddress, $PLEX_ClientName_ARR)) {
                // Mode
                    $isPlaying = true;
                    $data['hasClient1'] = true;

                // PMPD Settings
                    $autoScaleTop = $nowShowingTopAutoScale;
                    $topSelection = $nowShowingTop;
                    $topSize = $nowShowingTopFontSize;
                    $topColor = $nowShowingTopFontColor;
                    $topFontEnabled = $nowShowingTopFontEnabled;
                    $topFontID = $nowShowingTopFontID;

                    $autoScaleBottom = $nowShowingBottomAutoScale;
                    $bottomSelection = $nowShowingBottom;
                    $bottomSize = $nowShowingBottomFontSize;
                    $bottomColor = $nowShowingBottomFontColor;
                    $bottomFontEnabled = $nowShowingBottomFontEnabled;
                    $bottomFontID = $nowShowingBottomFontID;

                    $mediaArt_Status = $nowShowingBackgroundArt;
                    $mediaArt_ShowTVThumb = $nowShowingShowTVThumb;

                    if (!empty($nowShowingRefreshSpeed)) {
                        $RefreshSpeed = $nowShowingRefreshSpeed;
                    }

                    //Setup Scrolling Text Using jQuery Marquee (https://www.jqueryscript.net/animation/Text-Scrolling-Plugin-for-jQuery-Marquee.html)
                    if ($nowShowingBottomScroll == 'Enabled') {
                        $bottomScroll = TRUE;
                        $scrollPrepend = "<div class='marquee' style='height: 100%'>";
                        $scrollAppend = "</div>
                        <script>
                            $(function(){
                            $('.marquee').marquee({
                                allowCss3Support: true,
                                css3easing: 'linear',
                                delayBeforeStart: 2000,
                                duration: 8000,
                                direction: 'up',
                                gap: 20,
                                startVisible: true
                            });
                            });
                        </script>";
                    } else {
                        $bottomScroll = FALSE;
                        $scrollPrepend = "";
                        $scrollAppend = "";
                    }

                $mediaTitle = $clients['title']; // Default
                $mediaTagline = $clients['tagline']; // Default
                $mediaSummary = $clients['summary']; // Default
                $mediaArt = $clients['art']; // Default
                $mediaThumb = $clients['thumb']; // Default

                // (strstr($clients['type'], "movie") // Notes for validation
                $viewGroup = $clients['type'];

                plex_metadata_viewGroup();

                plex_metadata_PROCESS();

                //Progress Bar
                if ($pmpDisplayProgress == 'Enabled') {
                    $progress_duration = ((int)$clients['duration'] / 1000);
                    $progress_viewOffset = ((int)$clients['viewOffset'] / 1000);

                    $percentComplete = (((int)$clients['viewOffset'] / 1000) / ((int)$clients['duration'] / 1000)) * 100;
                    $progressBar = "<div class='progress' style='height : " . $pmpDisplayProgressSize . "px;'><div class='progress-bar' role='progressbar' style='width: " . $percentComplete . "%; background-color : " . $pmpDisplayProgressColor . ";' aria-valuenow='" . $percentComplete . "' aria-valuemin='0' aria-valuemax='100'></div></div> ";
                } else {
                    $progressBar = NULL;
                }
            }
        }
    }

    $data['isPlaying'] = $isPlaying;
    //Coming Soon (If Nothing is Playing)
    if (!$isPlaying) {
        //Clean Up Status
        updateStatus();

        // PMPD Settings
            $autoScaleTop = $comingSoonTopAutoScale;
            $topSelection = $comingSoonTop;
            $topSize = $comingSoonTopFontSize;
            $topColor = $comingSoonTopFontColor;
            $topFontEnabled = $comingSoonTopFontEnabled;
            $topFontID = $comingSoonTopFontID;

            $autoScaleBottom = $comingSoonBottomAutoScale;
            $bottomSelection = $comingSoonBottom;
            $bottomSize = $comingSoonBottomFontSize;
            $bottomColor = $comingSoonBottomFontColor;
            $bottomFontEnabled = $comingSoonBottomFontEnabled;
            $bottomFontID = $comingSoonBottomFontID;

            $mediaArt_Status = $comingSoonBackgroundArt;
            $mediaArt_ShowTVThumb = $comingSoonShowTVThumb;

            if (!empty($comingSoonRefreshSpeed)) {
                $RefreshSpeed = $comingSoonRefreshSpeed;
            }

            //Setup Scrolling Text Using jQuery Marquee (https://www.jqueryscript.net/animation/Text-Scrolling-Plugin-for-jQuery-Marquee.html)
            if ($comingSoonBottomScroll == 'Enabled') {
                $bottomScroll = TRUE;
                $scrollPrepend = "<div class='marquee' style='height: 100%'>";
                $scrollAppend = "</div>
                <script>
                    $(function(){
                    $('.marquee').marquee({
                        allowCss3Support: true,
                        css3easing: 'linear',
                        delayBeforeStart: 2000,
                        duration: 8000,
                        direction: 'up',
                        gap: 20,
                        startVisible: true
                    });
                    });
                </script>";
            } else {
                $bottomScroll = FALSE;
                $scrollPrepend = "";
                $scrollAppend = "";
            }

        plex_variable_presets(); // FUTURE USE

        //Multi Movie Section Support
        plex_random_media(1); // Scan Libraries for Media

        if ($viewGroup == "track") {
            // Future: Possible add music to display if using "all" and maybe "Recently Added" or "Newest"
            unset($plexServerMovieSections[$useSection]);
            $plexServerMovieSection = implode(",", $plexServerMovieSections);
            pmp_Logging("getMediaURL", "Library (Array - Updated): $plexServerMovieSection");

            plex_random_media(2);
        }

        $countMedia = count($xmlMedia);
        if ($countMedia > '0') {

            plex_metadata_viewGroup();

            // Media
            foreach ($xmlMedia->$elementType as $mediaElement) {
                $mediaArr[] = strip_tags($mediaElement['title']);
            }
            $random_keys = array_rand($mediaArr, 1);
            $showMedia = $mediaArr[$random_keys];
            $mediaArrCount = count($mediaArr);
            pmp_Logging("getMediaURL", "Coming Soon ($mediaType_Display) COUNT: $mediaArrCount");

            if ($mediaArrCount > '0') {
                foreach ($xmlMedia->$elementType as $clients) {
                    if (strstr($clients['title'], $showMedia)) {
                        $checkTitle = $clients['title'];
                        pmp_Logging("getMediaURL", "Coming Soon ($mediaType_Display): $checkTitle");

                        plex_metadata_PROCESS();
                    }
                }
            }

        }
    }
}

// If we're not using custom images, check if we need to cache art from PLEX
// Otherwise, necessary values are set at the top
if ($customImageEnabled != "Enabled") {
    // Check to see if we should cache our art

    // Media Thumb (Poster)
    plex_getMedia_thumb();

    // Media Art (Background)
    plex_getMedia_art();

    // Figure out which text goes where
    switch($topSelection) {
        case 'title': $topText = $mediaTitle;break;
        case 'summary': $topText = $mediaSummary;break;
        case 'tagline': $topText = $mediaTagline;break;
        case 'custom': $topText = $isPlaying ? $nowShowingTopText : $comingSoonTopText;break;
    }

    switch($bottomSelection) {
        case 'title': $bottomText = $mediaTitle;break;
        case 'summary': $bottomText = $mediaSummary;break;
        case 'tagline': $bottomText = $mediaTagline;break;
        case 'custom': $bottomText = $isPlaying ? $nowShowingBottomText : $comingSoonBottomText;break;
    }

    // Set our stroke size and color for top and bottom
    if ($isPlaying) {
        $topStrokeSize = $nowShowingTopFontOutlineSize;
        $topStrokeColor = $nowShowingTopFontOutlineColor;
        $bottomStrokeSize = $nowShowingBottomFontOutlineSize;
        $bottomStrokeColor = $nowShowingBottomFontOutlineColor;
    } else {
        $topStrokeSize = $comingSoonTopFontOutlineSize;
        $topStrokeColor = $comingSoonTopFontOutlineColor;
        $bottomStrokeSize = $comingSoonBottomFontOutlineSize;
        $bottomStrokeColor = $comingSoonBottomFontOutlineColor;
    }
}

// --------------------------------------------------
// Settings: Top
    $topStyle = "color: ${topColor}; -webkit-text-stroke: ${topStrokeSize}px ${topStrokeColor};";

    if ($topFontEnabled == TRUE && $topFontID != "None") {
        $topStyle .= " font-family: '$topFontID';";
    }

    if (!$autoScaleTop) {
        $topStyle .= " font-size: ${topSize}px;";
    }

    if ($topScroll == TRUE) {
        $topCSSClass = "marqueeDisplay";
    }
    else {
        $topCSSClass = "userText";
    }

    $topLine = "<div><span class='$topCSSClass' style=\"$topStyle\">${topText}</span></div>"; // Missing: Scroll Append?
// --------------------------------------------------

// --------------------------------------------------
// Settings: Bottom
    $bottomStyle = "color: ${bottomColor}; -webkit-text-stroke: ${bottomStrokeSize}px ${bottomStrokeColor};";

    if ($bottomFontEnabled == TRUE && $bottomFontID != "None") {
        $bottomStyle .= " font-family: '$bottomFontID';";
    }

    if (!$autoScaleBottom) {
        $bottomStyle .= " font-size: ${bottomSize}px;";
    }

    if ($bottomScroll == TRUE) {
        $bottomCSSClass = "marqueeDisplay";
    }
    else {
        $bottomCSSClass = "userText";
    }

    $bottomLine = "$scrollPrepend<div><span class='$bottomCSSClass' style=\"$bottomStyle\">${bottomText}</span></div>$scrollAppend";
// --------------------------------------------------

updateStatusRefresh();

$results = [];
$results['refreshSpeed'] = ($RefreshSpeed);
$results['photoMode'] = $photoModeStatus ; // Future Use (Issue #48)

$results['top'] = $topLine . $progressBar;
$results['middle'] = $mediaThumb_Display;

if ($mediaArt_Status) {
    $results['mediaArt'] = $mediaArt_Display;
} else {
    $results['mediaArt'] = "";
}

$results['bottom'] = $bottomLine;
ob_end_clean();
echo json_encode($results);
die();

//Update Status
function updateStatus($lastNowShowing = "") {
    $myFile = fopen("status.php", "w") or die("Unable to open file!");
    fwrite($myFile, ' <?php $lastNowShowing = "' . $lastNowShowing. '";');
    fclose($myFile);
}

function updateStatusRefresh($lastNowShowing = "") {
    global $RefreshSpeed;

    $myFile = fopen("statusRefresh.php", "w") or die("Unable to open file!");
    fwrite($myFile, ' <?php $currentRefreshSpeed = "' . $RefreshSpeed. '";?>');
    fclose($myFile);
}