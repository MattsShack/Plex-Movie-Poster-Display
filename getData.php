<?php
//For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
include 'config.php';
include 'status.php';

// Security Work Around (quick fix)
include 'getPoster.php';

$results = Array();
$movies = Array();
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

//Clean Up Cache Dir (Files Older than 24 hours)
$cachePath = 'cache/posters/';
if ($handle = opendir($cachePath)) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != ".." && ((time() - filectime($cachePath . $file)) > 86400)) {
            unlink($cachePath . $file);
        }
    }
}

// Let's be lazy
$title = "";
$display = "";
$bottomLine = "";
$topLine = "";
$isPlaying = false;
$mediaTitle = "";
$mediaSummary = "";
$mediaTagline = "";
$topText = "";
$topCustom = "";
$bottomText = "";
$bottomCustom = "";
$topColor = "";
$bottomColor = "";
$topSize = "";
$bottomSize = "";
$autoScaleBottom = false;
$autoScaleTop = false;
$scrollBottom = false;
$topSelection = false;
$bottomSelection = false;

//Display Custom Image if Enabled
if ($customImageEnabled == "Enabled") {
    $data['type'] = 'custom';
    $topSize = $customTopFontSize;
    $topColor = $customTopFontColor;
    $bottomSize = $customBottomFontSize;
    $bottomColor = $customBottomFontColor;
    $topText = $customTopText;
    $bottomText = $customBottomText;
    $topSelection = $nowShowingTop;
    $bottomSelection = $nowShowingBottom;
    $display = "url('cache/custom/$customImage')";
    $topStrokeColor = $customTopFontOutlineColor;
    $topStrokeSize = $customTopFontOutlineSize;
    $bottomStrokeColor = $customBottomFontOutlineColor;
    $bottomStrokeSize = $customBottomFontOutlineSize;
} else {
    // Plex Module Connect to Plex
    $url = "http://$plexServer:32400/status/sessions?X-Plex-Token=$plexToken";
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
            $art = false;
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
                //Now Showing Sections
                if (strstr($clients['type'], "movie")) {
                    $art = $clients['thumb'];
                } elseif (strstr($clients['type'], "episode")) {
                    $art = $clients['grandparentThumb'];
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

        //Multi Movie Section Support
        $plexServerMovieSections = explode(",", $plexServerMovieSection);
        $useSection = rand(0, count($plexServerMovieSections) - 1);
        $MoviesURL = 'http://' . $plexServer . ':32400/library/sections/' . $plexServerMovieSections[$useSection] . '/' . $comingSoonShowSelection . '?X-Plex-Token=' . $plexToken . '';
        $getMovies = file_get_contents($MoviesURL);
        $xmlMovies = simplexml_load_string($getMovies) or die("feed not loading");
        $countMovies = count($xmlMovies);
        if ($countMovies > '0') {
            foreach ($xmlMovies->Video as $movie) {
                $movies[] = strip_tags($movie['title']);
            }
            $random_keys = array_rand($movies, 1);
            $showMovie = $movies[$random_keys];
            foreach ($xmlMovies->Video as $movie) {
                if (strstr($movie['title'], $showMovie)) {
                    $art = $movie['thumb'];
                    $mediaTitle = $movie['title'];
                    $mediaSummary = $movie['summary'];
                    $mediaTagline = $movie['tagline'];
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
        $poster = explode("/", $art);
        $poster = trim($poster[count($poster) - 1], '/');
        $filename = 'cache/posters/' . $poster;
        // There's nothing else to do here, just save it
        if (!file_exists($filename)) {
            file_put_contents("cache/posters/$poster", fopen("http://$plexServer:32400$art?X-Plex-Token=$plexToken", 'r'));
        }
        $display = "url('cache/posters/$poster')";
    } else {
        $display = "url('data:image/jpeg;base64,".getPoster($art)."')";
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
    $topStrokeSize = $isPlaying ? $comingSoonTopFontOutlineSize : $nowShowingTopFontOutlineSize;
    $topStrokeColor = $isPlaying ? $comingSoonTopFontOutlineColor : $nowShowingTopFontOutlineColor;
    $bottomStrokeSize = $isPlaying ? $comingSoonBottomFontOutlineSize : $nowShowingBottomFontOutlineSize;
    $bottomStrokeColor = $isPlaying ? $comingSoonBottomFontOutlineColor : $nowShowingBottomFontOutlineColor;
}

$topStyle = "color: ${topColor}; -webkit-text-stroke: ${topStrokeSize}px ${topStrokeColor};";
if (!$autoScaleTop) $topStyle .= "font-size: ${topSize}px;";
$topLine = "<div><span class='userText' style='$topStyle'> $topText</span></div>";

$bottomStyle = "color: ${bottomColor};";
if (!$autoScaleBottom) $bottomStyle .= "font-size: ${bottomSize}px;";
$bottomLine = "$scrollPrepend<div><span class='userText' style='$bottomStyle'>${bottomText}</span></div>$scrollAppend";

$results = [];
$results['top'] = $topLine . $progressBar;
$results['middle'] = $display;
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
