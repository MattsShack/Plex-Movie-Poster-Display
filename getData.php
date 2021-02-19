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
// $mediaArt_ShowTVThumb = "show";
// $mediaArt_ShowTVThumb = "season";

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
                $mediaArt_ShowTVThumb = $nowShowingShowTVThumb;

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
                        plex_metadata_title($mediaArt_ShowTVThumb);
                        plex_metadata_summary($mediaArt_ShowTVThumb);
                        plex_metadata_tagline($mediaArt_ShowTVThumb);
                        plex_metadata_art($mediaArt_ShowTVThumb);
                        plex_metadata_thumb($mediaArt_ShowTVThumb);
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

        $topSelection = $comingSoonTop;
        $autoScaleTop = $comingSoonTopAutoScale;
        $topColor = $comingSoonTopFontColor;
        $topSize = $comingSoonTopFontSize;
        $topFontEnabled = $comingSoonTopFontEnabled;
        $topFontID = $comingSoonTopFontID;

        $bottomSelection = $comingSoonBottom;
        $autoScaleBottom = $comingSoonBottomAutoScale;
        $bottomColor = $comingSoonBottomFontColor;
        $bottomSize = $comingSoonBottomFontSize;
        $bottomFontEnabled = $comingSoonBottomFontEnabled;
        $bottomFontID = $comingSoonBottomFontID;

        $mediaArt_Status = $comingSoonBackgroundArt;
        // $mediaArt_ShowTVThumb = $comingSoonShowTVThumb;
        $mediaArt_ShowTVThumb = "episode";

        plex_variable_presets(); // FUTURE USE

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
            $moviesCount = count($movies);
            pmp_Logging("getMediaURL", "Coming Soon (Movies) COUNT: $moviesCount");

            if ($moviesCount > '0') {
                foreach ($xmlMedia->Video as $clients) {
                    if (strstr($clients['title'], $showMedia)) {
                        $checkTitle = $clients['title'];
                        pmp_Logging("getMediaURL", "Coming Soon (Movies): $checkTitle");
                        plex_metadata_title("movie");
                        plex_metadata_summary("movie");
                        plex_metadata_tagline("movie");
                        plex_metadata_art("movie");
                        plex_metadata_thumb("movie");
                    }
                }
            }

            // TV Shows
            foreach ($xmlMedia->Directory as $show) {
                $shows[] = strip_tags($show['title']);

            }
            $random_keys = array_rand($shows, 1);
            $showMedia = $shows[$random_keys];
            $showsCount = count($shows);
            pmp_Logging("getMediaURL", "Coming Soon (TV Show) COUNT: $showsCount");

            if ($showsCount > '0') {
                foreach ($xmlMedia->Directory as $clients) {
                    if (strstr($clients['title'], $showMedia)) {
                        $checkTitle = $clients['title'];
                        pmp_Logging("getMediaURL", "Coming Soon (TV Show): $checkTitle");
                        plex_metadata_title($mediaArt_ShowTVThumb);
                        plex_metadata_summary($mediaArt_ShowTVThumb);
                        plex_metadata_tagline($mediaArt_ShowTVThumb);
                        plex_metadata_art($mediaArt_ShowTVThumb);
                        plex_metadata_thumb($mediaArt_ShowTVThumb);
                    }
                }
            }

        }
    }
}

// If we're not using custom images, check if we need to cache art from Plex
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
