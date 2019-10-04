<?php
//For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
include 'config.php';
include 'status.php';
$results = Array();
$movies = Array();
ob_start();
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

//Display Custom Image if Enabled
if ($customImageEnabled == "Enabled") {
    $title = "<span style='font-size: ${customTopFontSize}px; color : ${customTopFontColor}; -webkit-text-stroke: ${customTopFontOutlineSize}px ${customTopFontOutlineColor};'> $customTopText </span>";
    $display = "url('cache/custom/$customImage')";
    $bottomLine = "<span class='userText' style='font-size: ${customBottomFontSize} px; color: ${customBottomFontColor};'>${customBottomText}</span>";
} else {
    //Plex Module Connect to Plex
    $url = "http://$plexServer:32400/status/sessions?X-Plex-Token=$plexToken";
    $getXml = file_get_contents($url);
    $xml = simplexml_load_string($getXml) or die("feed not loading");
    $client = false;
    if ($xml['size'] != '0') {
        foreach ($xml->Video as $clients) {
            $art = false;
            if (strstr($clients->Player['address'], $plexClient)) {
                //Now Showing Sections
                if (strstr($clients['type'], "movie")) {
                    $art = $clients['thumb'];
                } elseif (strstr($clients['type'], "episode")) {
                    $art = $clients['grandparentThumb'];
                }

                if ($art) {
                    if ($cacheEnabled) {
                        $poster = explode("/", $art);
                        $poster = trim($poster[count($poster) - 1], '/');
                        $filename = 'cache/posters/' . $poster;
                        $addAt = $clients['addedAt'];
                        $client = true;
                        //Check if image is in local cache.
                        if (file_exists($filename)) {
                            //Future Code Coming
                        } else {
                            file_put_contents("cache/posters/$poster", fopen("http://$plexServer:32400$art?X-Plex-Token=$plexToken", 'r'));
                        }
                        $display = "url('cache/posters/$poster')";
                    } else {
                        $display = "url('http://$plexServer:32400$art?X-Plex-Token=$plexToken')";
                    }

                    //Progress Bar
                    if ($pmpDisplayProgress == 'Enabled') {
                        $percentComplete = (((int)$clients['duration'] / 1000) / ((int)$clients['viewOffset'] / 1000)) * 100;
                        $progressBar = "<div class='progress' style='height : " . $pmpDisplayProgressSize . "px;'><div class='progress-bar' role='progressbar' style='width: " . $percentComplete . "%; background-color : " . $pmpDisplayProgressColor . ";' aria-valuenow='" . $percentComplete . "' aria-valuemin='0' aria-valuemax='100'></div></div> ";
                    } else {
                        $progressBar = NULL;
                    }
                    $topStyle = "font-size: ${nowShowingTopFontSize}px; color: ${nowShowingTopFontColor}; -webkit-text-stroke: ${nowShowingTopFontOutlineSize}px ${nowShowingTopFontOutlineColor};";
                    $title = "<div><span class='userText' style='$topStyle'> $nowShowingTopText </span></div> $progressBar";

                    $mediaTitle = $clients['title'];
                    $mediaSummary = $clients['summary'];

                    // Prepend and append are "" if scroll is disabled, so we don't need all that stuff
                    $bottomStyle = "color: ${nowShowingBottomFontColor};";
                    if (!$nowShowingBottomAutoScale) $bottomStyle .= "font-size: ${nowShowingBottomFontSize}px;";
                    $bottomLine = "$scrollPrepend<div><span class='userText' style='$bottomStyle'>${mediaTitle}:${mediaSummary}</span></div>$scrollAppend";
                    //Check if same Movie / TV Show is still playing and adjust scrolling.
                    updateStatus(($lastNowShowing != $addAt) ? $addAt : "");
                }
            }
        }
    }

    //Coming Soon (If Nothing is Playing)
    if (!$client) {
        //Clean Up Status
        updateStatus();

        //Multi Movie Section Support
        $plexServerMovieSections = explode(",", $plexServerMovieSection);
        $useSection = rand(0, count($plexServerMovieSections) - 1);
        $topStyle = "font-size: ${comingSoonTopFontSize}px; color: ${comingSoonTopFontColor}; -webkit-text-stroke: ${comingSoonTopFontOutlineSize}px ${comingSoonTopFontOutlineColor};";
        $title = "<div><span class='userText' style='$topStyle'> $comingSoonTopText </span></div>";
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
                    if ($cacheEnabled) {
                        $poster = explode("/", $art);
                        $poster = trim($poster[count($poster) - 1], '/');
                        $filename = 'cache/posters/' . $poster;
                        if (file_exists($filename)) {
                            //Future Code Coming
                        } else {
                            file_put_contents("cache/posters/$poster", fopen("http://$plexServer:32400$art?X-Plex-Token=$plexToken", 'r'));
                        }
                        $display = "url('cache/posters/$poster')";
                    } else {
                        $display = "url('http://$plexServer:32400$art?X-Plex-Token=$plexToken')";
                    }

                    $bottomStyle = "color: ${comingSoonBottomFontColor};";
                    if (!$comingSoonBottomAutoScale) $bottomStyle .= "font-size: ${comingSoonBottomFontSize}px;";
                    if ($showComingSoonInfo) {
                        $bottomLine = "$scrollPrepend<div><span class='userText' style='$bottomStyle'>${mediaTagline}</span></div>$scrollAppend";
                    } else {
                        $bottomLine = "$scrollPrepend<div><span class='userText' style='$bottomStyle'>${comingSoonBottomText}</span></div>$scrollAppend";
                    }
                }
            }
        }
    }
}

$results['top'] = $title;
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