<?php
//For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
include 'config.php';
include 'status.php';
include 'assets/plexmovieposter/tools.php';
include 'assets/plexmovieposter/CacheLib.php';

// Security Work Around (quick fix)
include 'getPoster.php';

$results = Array();
$movies = Array();
$shows = Array();
// $TVCoverArt_Play = "show";
$TVCoverArt_Play = "season";

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
    // Store this for debugging
    $data['sessionUrl'] = $url;
    $data['plexClient'] = $plexClient;
    $data['plexClientName'] = $plexClientName;
    $getXml = file_get_contents($url);
    $xml = simplexml_load_string($getXml) or die("feed not loading");
    $isPlaying = false;
    if ($xml['size'] != '0') {
        $data['hasXml'] = true;
        foreach ($xml->Video as $clients) {
            // If this matches our client IP or name, gather data
            if (strstr($clients->Player['address'], $plexClient) || strstr($clients->Player['title'], $plexClientName)) {
                $isPlaying = true;
                $autoScaleTop = $nowShowingTopAutoScale;
                $autoScaleBottom = $nowShowingBottomAutoScale;
                $topSelection = $nowShowingTop;
                $bottomSelection = $nowShowingBottom;
                $data['hasClient1'] = true;
                $mediaTitle = $clients['title'];
                $mediaSummary = $clients['summary'];
                $mediaTagline = $clients['tagline'];
                $topSize = $nowShowingTopFontSize;
                $topColor = $nowShowingTopFontColor;
                $bottomSize = $nowShowingBottomFontSize;
                $bottomColor = $nowShowingBottomFontColor;

                $topFontEnabled = $nowShowingTopFontEnabled;
                $topFontID = $nowShowingTopFontID;

                $bottomFontEnabled = $nowShowingBottomFontEnabled;
                $bottomFontID = $nowShowingBottomFontID;

                $mediaArt_Status = $nowShowingBackgroundArt;
                //Now Showing Sections
                if (strstr($clients['type'], "movie")) {
                    $mediaThumb = $clients['thumb']; // Poster Art
                    $mediaArt = $clients['art']; // Background Art
                } elseif (strstr($clients['type'], "episode")) {
                    if ($TVCoverArt_Play == "show") {
                        $mediaThumb = $clients['grandparentThumb']; // Show Cover Art
                    }
                    elseif ($TVCoverArt_Play == "season") {
                        $mediaThumb = $clients['parentThumb']; // Season Cover Art
                    }
                    else {
                        $mediaThumb = $clients['grandparentThumb']; // Show Cover Art
                    }
                    $mediaArt = $clients['art']; // Background Art
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
        $plexServerMovieSections = explode(",", $plexServerMovieSection);
        $useSection = rand(0, count($plexServerMovieSections) - 1);
        // $MoviesURL = 'http://' . $plexServer . ':32400/library/sections/' . $plexServerMovieSections[$useSection] . '/' . $comingSoonShowSelection . '?X-Plex-Token=' . $plexToken . '';
        $MoviesURL = $URLScheme . '://' . $plexServer . ':32400/library/sections/' . $plexServerMovieSections[$useSection] . '/' . $comingSoonShowSelection . '?X-Plex-Token=' . $plexToken . '';
        $getMovies = file_get_contents($MoviesURL);
        $xmlMedia = simplexml_load_string($getMovies) or die("feed not loading");
        $countMovies = count($xmlMedia);
        if ($countMovies > '0') {
            // Movies
            foreach ($xmlMedia->Video as $movie) {
                $movies[] = strip_tags($movie['title']);
            }
            $random_keys = array_rand($movies, 1);
            $showMedia = $movies[$random_keys];
            foreach ($xmlMedia->Video as $movie) {
                if (strstr($movie['title'], $showMedia)) {
                    $mediaThumb = $movie['thumb']; // Poster Art
                    $mediaTitle = $movie['title'];
                    $mediaSummary = $movie['summary'];
                    $mediaTagline = $movie['tagline'];
                    $mediaArt = $movie['art']; // Background Art
                }
            }
            // TV Shows
            foreach ($xmlMedia->Directory as $show) {
                $shows[] = strip_tags($show['title']);
            }
            $random_keys = array_rand($shows, 1);
            $showMedia = $shows[$random_keys];
            foreach ($xmlMedia->Directory as $show) {
                if (strstr($show['title'], $showMedia)) {
                    $mediaThumb = $show['thumb']; // Poster Art
                    $mediaTitle = $show['title'];
                    $mediaSummary = $show['summary'];
                    $mediaTagline = $show['tagline']; // TV Shows do not contain tagline
                    $mediaArt = $show['art']; // Background Art
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
        $mediaThumb_ID = explode("/", $mediaThumb);
        $mediaThumb_ID = trim($mediaThumb_ID[count($mediaThumb_ID) - 1], '/');
        $filename = $cachePath . $mediaThumb_ID;
        $mediaThumb_URL = "$URLScheme://$plexServer:32400$mediaThumb?X-Plex-Token=$plexToken";
        // There's nothing else to do here, just save it
        if (!file_exists($filename)) {
            file_put_contents("$cachePath/$mediaThumb_ID", fopen("$mediaThumb_URL", 'r'));  // Not using getPoster function and using older un-secure function
        }
        $mediaThumb_Display = "url('$cachePath/$mediaThumb_ID')";
        pmp_Logging("getMediaThumb", "$mediaThumb_ID ($cachePath) - $mediaThumb_URL");

        $mediaArt_ID = explode("/", $mediaArt);
        $mediaArt_ID = trim($mediaArt_ID[count($mediaArt_ID) - 1], '/');
        $filename = $cacheArtPath . $mediaArt_ID;
        $mediaArt_URL = "$URLScheme://$plexServer:32400$mediaArt?X-Plex-Token=$plexToken";
        // There's nothing else to do here, just save it
        if (!file_exists($filename)) {
            file_put_contents("$cacheArtPath/$mediaArt_ID", fopen("$mediaArt_URL", 'r'));  // Not using getPoster function and using older un-secure function
        }
        $mediaArt_Display = "url('$cacheArtPath/$mediaArt_ID')";
        pmp_Logging("getMediaArt", "$mediaArt_ID ($cacheArtPath) - $mediaArt_URL");

    } else {
        $mediaThumb_Display = "url('data:image/jpeg;base64,".getPoster($mediaThumb)."')";
        // $mediaThumb_Display = "url('$URLScheme://$plexServer:32400$mediaThumb?X-Plex-Token=$plexToken')";
        if (empty($mediaThumb_Display)) {
            $mediaThumb_Display = "url('$URLScheme://$plexServer:32400$mediaThumb?X-Plex-Token=$plexToken')";
        }

        $mediaArt_Display = "url('data:image/jpeg;base64,".getPoster($mediaArt)."')";
        if (empty($mediaArt_Display)) {
            $mediaArt_Display = "url('$URLScheme://$plexServer:32400$mediaArt?X-Plex-Token=$plexToken')";
        }
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
