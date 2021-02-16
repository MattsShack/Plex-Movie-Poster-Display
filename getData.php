<?php
//For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
include 'config.php';
include 'status.php';
include 'assets/plexmovieposter/tools.php';
include 'assets/plexmovieposter/CacheLib.php';
include 'assets/plexmovieposter/PlexLib.php';

// Security Work Around (quick fix)
include 'getPoster.php';

$results = Array();
$movies = Array();
$shows = Array();
// $TVCoverArt_Play = "show";
// $TVCoverArt_Play = "season";

ob_start();
$data = [];
//Setup Scrolling Text Using jQuery Marquee (https://www.jqueryscript.net/animation/Text-Scrolling-Plugin-for-jQuery-Marquee.html)
if ($pmpBottomScroll == 'Enabled') {
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
    $scrollPrepend = "";
    $scrollAppend = "";
}

// -------------------------
// Poster Cache
$cachePath = $pmpPosterDir;
GeneralCache_Prep($cachePath, TRUE);
// -------------------------

// -------------------------
// Art Cache
$cacheArtPath = $pmpArtDir;
GeneralCache_Prep($cacheArtPath, TRUE);
// -------------------------

// -------------------------
// Custom Cache
$customPath = $pmpCustomDir;
GeneralCache_Prep($customPath, FALSE);
// -------------------------

// Let's be lazy
$title = "";
$mediaThumb_Display = "";
$mediaArt_Display = "";
$mediaArt_Status = "";
$isPlaying = false;

$mediaTitle = "";
$mediaSummary = "";
$mediaTagline = "";

$topSelection = false;
$topLine = "";
$topText = "";
$topSize = "";
$topColor = "";
$topCustom = "";
$topFontEnabled = false;
$topFontID = "";
$autoScaleTop = false;
$scrollTop = false;

$bottomSelection = false;
$bottomLine = "";
$bottomText = "";
$bottomSize = "";
$bottomColor = "";
$bottomCustom = "";
$bottomFontEnabled = false;
$bottomFontID = "";
$autoScaleBottom = false;
$scrollBottom = false;

// Setting SSL Prefix
if ($plexServerSSL) {
    $URLScheme = "https";
    $plexServer = $plexServerDirect;
}
else {
    $URLScheme = "http";
}

//Display Custom Image if Enabled
if ($customImageEnabled == "Enabled") {
    $data['type'] = 'custom';
    $topSize = $customTopFontSize;
    $topColor = $customTopFontColor;
    $bottomSize = $customBottomFontSize;
    $bottomColor = $customBottomFontColor;
    $topFontEnabled = $customTopFontEnabled;
    $topFontID = $customTopFontID;
    $bottomFontEnabled = $customBottomFontEnabled;
    $bottomFontID = $customBottomFontID;
    $topText = $customTopText;
    $bottomText = $customBottomText;
    $topSelection = $nowShowingTop;
    $bottomSelection = $nowShowingBottom;
    $mediaThumb_Display = "url('$customPath/$customImage')";
    $mediaArt_Display = "url('$customPath/$customImage')";
    $topStrokeColor = $customTopFontOutlineColor;
    $topStrokeSize = $customTopFontOutlineSize;
    $bottomStrokeColor = $customBottomFontOutlineColor;
    $bottomStrokeSize = $customBottomFontOutlineSize;
} else {
    // Plex Module Connect to Plex
    // $url = "http://$plexServer:32400/status/sessions?X-Plex-Token=$plexToken";
    $url = "$URLScheme://$plexServer:32400/status/sessions?X-Plex-Token=$plexToken";
    pmp_Logging("getMediaURL", "Session URL: $url");
    // Store this for debugging
    $data['sessionUrl'] = $url;
    $data['plexClient'] = $plexClient;
    $data['plexClientName'] = $plexClientName;
    $getXml = file_get_contents($url);

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
            // If this matches our client IP or name, gather data
            if (strstr($clients->Player['address'], $plexClient) || strstr($clients->Player['title'], $plexClientName)) {
                $isPlaying = true;
                $autoScaleTop = $nowShowingTopAutoScale;
                $autoScaleBottom = $nowShowingBottomAutoScale;
                $topSelection = $nowShowingTop;
                $bottomSelection = $nowShowingBottom;
                $data['hasClient1'] = true;

                $topSize = $nowShowingTopFontSize;
                $topColor = $nowShowingTopFontColor;
                $bottomSize = $nowShowingBottomFontSize;
                $bottomColor = $nowShowingBottomFontColor;

                $topFontEnabled = $nowShowingTopFontEnabled;
                $topFontID = $nowShowingTopFontID;

                $bottomFontEnabled = $nowShowingBottomFontEnabled;
                $bottomFontID = $nowShowingBottomFontID;

                $mediaArt_Status = $nowShowingBackgroundArt;
                $TVCoverArt_Play = $nowShowingShowTVThumb;

                $mediaTitle = $clients['title']; // Default
                $mediaTagline = $clients['tagline']; // Default
                $mediaSummary = $clients['summary']; // Default
                $mediaArt = $clients['art']; // Default
                $mediaThumb = $clients['thumb']; // Default

                // (strstr($clients['type'], "movie") // Notes for validation

                switch ($clients['type']) {
                    case "movie":
                        plex_metadata_title("movie");
                        plex_metadata_summary("movie");
                        plex_metadata_tagline("movie");
                        plex_metadata_art("movie");
                        plex_metadata_thumb("movie");
                        break;
                    case "episode":
                        plex_metadata_title($TVCoverArt_Play);
                        plex_metadata_summary($TVCoverArt_Play);
                        plex_metadata_tagline($TVCoverArt_Play);
                        plex_metadata_art($TVCoverArt_Play);
                        plex_metadata_thumb($TVCoverArt_Play);
                        break;
                    case "track":
                        plex_metadata_title("track");
                        plex_metadata_summary("track");
                        plex_metadata_tagline("track");
                        plex_metadata_art("track");
                        plex_metadata_thumb("track");
                        break;
                    default:
                        plex_metadata_title("movie");
                        plex_metadata_summary("movie");
                        plex_metadata_tagline("movie");
                        plex_metadata_art("movie");
                        plex_metadata_thumb("movie");
                }

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
        $autoScaleBottom = $comingSoonBottomAutoScale;
        $autoScaleTop = $comingSoonTopAutoScale;
        $topColor = $comingSoonTopFontColor;
        $topSize = $comingSoonTopFontSize;
        $bottomColor = $comingSoonBottomFontColor;
        $bottomSize = $comingSoonBottomFontSize;
        $topSelection = $comingSoonTop;
        $bottomSelection = $comingSoonBottom;

        $topFontEnabled = $comingSoonTopFontEnabled;
        $topFontID = $comingSoonTopFontID;
        $bottomFontEnabled = $comingSoonBottomFontEnabled;
        $bottomFontID = $comingSoonBottomFontID;

        $mediaArt_Status = $comingSoonBackgroundArt;

        //Multi Movie Section Support
        plex_random_media(1); // Scan Libraries for Media

        if ($viewGroup == "track") {
            unset($plexServerMovieSections[$useSection]);
            $plexServerMovieSection = implode(",", $plexServerMovieSections);
            pmp_Logging("getMediaURL", "Library (Array - Updated): $plexServerMovieSection");

            plex_random_media(2);
        }

        $countMedia = count($xmlMedia);
        if ($countMedia > '0') {
            // Movies
            foreach ($xmlMedia->Video as $movie) {
                $movies[] = strip_tags($movie['title']);
            }
            $random_keys = array_rand($movies, 1);
            $showMedia = $movies[$random_keys];

            foreach ($xmlMedia->Video as $clients) {
                if (strstr($clients['title'], $showMedia)) {
                    plex_metadata_title("movie");
                    plex_metadata_summary("movie");
                    plex_metadata_tagline("movie");
                    plex_metadata_art("movie");
                    plex_metadata_thumb("movie");
                }
            }

            // TV Shows
            foreach ($xmlMedia->Directory as $show) {
                $shows[] = strip_tags($show['title']);
            }
            $random_keys = array_rand($shows, 1);
            $showMedia = $shows[$random_keys];

            foreach ($xmlMedia->Directory as $clients) {
                if (strstr($clients['title'], $showMedia)) {
                    plex_metadata_title($TVCoverArt_Play);
                    plex_metadata_summary($TVCoverArt_Play);
                    plex_metadata_tagline($TVCoverArt_Play);
                    plex_metadata_art($TVCoverArt_Play);
                    plex_metadata_thumb($TVCoverArt_Play);
                }
            }
        }
    }
}

// If we're not using custom images, check if we need to cache art from Plex
// Otherwise, necessary values are set at the top
if ($customImageEnabled != "Enabled") {
    // Check to see if we should cache our art
    if ($cacheEnabled) {
        // Media Thumb (Poster) - Future: Move into function
        $mediaThumb_ID = explode("/", $mediaThumb);
        $mediaThumb_ID = trim($mediaThumb_ID[count($mediaThumb_ID) - 1], '/');

        if (!isset($mediaThumb_MetadataID) || trim($mediaThumb_MetadataID) === '') {
            $mediaThumb_CacheFileName = $mediaThumb_ID;
        } else {
            $mediaThumb_CacheFileName = $mediaThumb_ID . "_" . $mediaThumb_MetadataID;
        }
        // $mediaThumb_CacheFullName = $cachePath . $mediaThumb_CacheFileName;
        $mediaThumb_CacheFullName = join('/', array(trim($cachePath, '/'), trim($mediaThumb_CacheFileName, '/')));
        pmp_Logging("getCacheFile", "Cache File @ Output (mediaThumb) - $mediaThumb_CacheFullName");

        $mediaThumb_URL = "$URLScheme://$plexServer:32400$mediaThumb?X-Plex-Token=$plexToken";
        pmp_Logging("getMediaThumb", "$mediaThumb_ID ($cachePath) - $mediaThumb_URL");

        // There's nothing else to do here, just save it
        if (!file_exists($mediaThumb_CacheFullName)) {
            file_put_contents("$mediaThumb_CacheFullName", fopen("$mediaThumb_URL", 'r'));
        }

        $mediaThumb_CacheURL = $mediaThumb_CacheFullName;

        // $mediaThumb_Display = "url('$mediaThumb_CacheURL')"; // Unsecure URL
        $mediaThumb_Display = "url('data:image/jpeg;base64,".getCachePoster($mediaThumb_CacheURL)."')"; // Secure URL
        // pmp_Logging("getMediaThumb", "mediaThumb (Display - Secure) - $mediaThumb_Display"); // DO NOT LOG SECURE URL - DATA UNUSABLE AND LOGS BECOME UNREADABLE

        // Media Art (Background) - Future: Move into function
        $mediaArt_ID = explode("/", $mediaArt);
        $mediaArt_ID = trim($mediaArt_ID[count($mediaArt_ID) - 1], '/');

        if (isset($mediaArt_ID) && trim($mediaArt_ID) != '') {
            if (!isset($mediaArt_MetadataID) || trim($mediaArt_MetadataID) === '') {
                $mediaArt_CacheFileName = $mediaArt_ID;
            } else {
                $mediaArt_CacheFileName = $mediaArt_ID . "_" . $mediaArt_MetadataID;
            }
            $mediaArt_CacheFullName = join('/', array(trim($cacheArtPath, '/'), trim($mediaArt_CacheFileName, '/')));
            pmp_Logging("getCacheFile", "Cache File @ Output (mediaArt) - $mediaArt_CacheFullName");

            $mediaArt_URL = "$URLScheme://$plexServer:32400$mediaArt?X-Plex-Token=$plexToken";
            pmp_Logging("getMediaArt", "$mediaArt_ID ($cacheArtPath) - $mediaArt_URL");

            // There's nothing else to do here, just save it
            if (!file_exists($mediaArt_CacheFullName)) {
                file_put_contents("$mediaArt_CacheFullName", fopen("$mediaArt_URL", 'r'));
            }

            $mediaArt_CacheURL = $mediaArt_CacheFullName;

            // $mediaArt_Display = "url('$mediaArt_CacheURL')"; // Unsecure URL
            $mediaArt_Display = "url('data:image/jpeg;base64,".getCachePoster($mediaArt_CacheURL)."')"; // Secure URL
            // pmp_Logging("getMediaArt", "mediaArt (Display - Secure) - $mediaArt_Display"); // DO NOT LOG SECURE URL - DATA UNUSABLE AND LOGS BECOME UNREADABLE
        }
    } else {
        // $mediaThumb_Display = "url('$URLScheme://$plexServer:32400$mediaThumb?X-Plex-Token=$plexToken')"; // Unsecure URL
        $mediaThumb_Display = "url('data:image/jpeg;base64,".getPoster($mediaThumb)."')"; // Secure URL
        // pmp_Logging("getMediaThumb", "mediaThumb (Display - Secure) - $mediaThumb_Display"); // DO NOT LOG SECURE URL - DATA UNUSABLE AND LOGS BECOME UNREADABLE

        // $mediaArt_Display = "url('$URLScheme://$plexServer:32400$mediaArt?X-Plex-Token=$plexToken')"; // Unsecure URL
        $mediaArt_Display = "url('data:image/jpeg;base64,".getPoster($mediaArt)."')"; // Secure URL
        // pmp_Logging("getMediaArt", "mediaArt (Display - Secure) - $mediaArt_Display"); // DO NOT LOG SECURE URL - DATA UNUSABLE AND LOGS BECOME UNREADABLE
    }

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

$topStyle = "color: ${topColor}; -webkit-text-stroke: ${topStrokeSize}px ${topStrokeColor};";
if ($topFontEnabled) $topStyle .= " font-family: '$topFontID';";
if (!$autoScaleTop) $topStyle .= " font-size: ${topSize}px;";
$topLine = "<div><span class='userText' style=\"$topStyle\">${topText}</span></div>"; // Missing: Scroll Append?

$bottomStyle = "color: ${bottomColor}; -webkit-text-stroke: ${bottomStrokeSize}px ${bottomStrokeColor};";
if ($bottomFontEnabled) $bottomStyle .= " font-family: '$bottomFontID';";
if (!$autoScaleBottom) $bottomStyle .= " font-size: ${bottomSize}px;";
$bottomLine = "$scrollPrepend<div><span class='userText' style=\"$bottomStyle\">${bottomText}</span></div>$scrollAppend";

$results = [];
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
