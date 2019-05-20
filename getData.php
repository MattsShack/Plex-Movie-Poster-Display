<?php
  //For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
  include 'config.php';
  include 'status.php';
  $results = Array();
  $movies = Array();

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

  //Display Custom Image if Enabled
  if ($customImageEnabled == "Enabled") {
    $title = "<br /><p style='font-size: " .  $customTopFontSize . "px; color : " . $customTopFontColor  . "; -webkit-text-stroke: " . $customTopFontOutlineSize . "px " .  $customTopFontOutlineColor . ";'> $customTopText </p>";
    $display = "<img src='cache/custom/$customImage' style='width: 100%'>";
    $info = "<br /><p style='font-size: " . $customBottomFontSize  . "px; color : " . $customBottomFontColor . ";'> $customBottomText </p>";

    $results['top'] = "$title";
    $results['middle'] = "$display";
    $results['bottom'] = "$info";

  } else {

    function getProgress($dur, $off) {
      //Display Time Played And Time Left - Contributed by Alexander Feyaerts
      //Modified to display progress bar
      //$dur = $clients['duration'];
      $durint = (int)$dur;
      $time = $durint / 1000;
      $days = floor($time / (24*60*60));
      $hours = floor(($time - ($days*24*60*60)) / (60*60));
      $minutes = floor(($time - ($days*24*60*60)-($hours*60*60)) / 60);
      $seconds = ($time - ($days*24*60*60) - ($hours*60*60) - ($minutes*60)) % 60;
      $playtime = sprintf("%02d:%02d:%02d",$hours,$minutes,$seconds);

      //$off = $clients['viewOffset'];
      $offint = (int)$off;
      $timeoff = $offint / 1000;
      $daysoff = floor($timeoff / (24*60*60));
      $hoursoff = floor(($timeoff - ($daysoff*24*60*60)) / (60*60));
      $minutesoff = floor(($timeoff - ($daysoff*24*60*60)-($hoursoff*60*60)) / 60);
      $secondsoff = ($timeoff - ($daysoff*24*60*60) - ($hoursoff*60*60) - ($minutesoff*60)) % 60;
      $offset = sprintf("%02d:%02d:%02d",$hoursoff,$minutesoff,$secondsoff);

      $percentComplete = ($timeoff / $time) * 100;
      return $percentComplete;
    }

    function updateStatus($lastNowShowing,$fontSize,$fontColor) {
      //Update Status
      $myfile = fopen("status.php", "w") or die("Unable to open file!");
      $newStatus = "
<?php
  \$lastNowShowing = '$lastNowShowing';
  \$lastNowShowingBottomFontSize = '$fontSize';
  \$lastNowShowingBottomFontColor = '$fontColor';
?>";

      fwrite($myfile, $newStatus);
      fclose($myfile);
    }

    //Plex Module Connect to Plex
    $url     = 'http://'.$plexServer.':32400/status/sessions?X-Plex-Token='.$plexToken.'';
    $getxml  = file_get_contents($url);
    $xml     = simplexml_load_string($getxml) or die("feed not loading");
    $client  = 'false';
    $title   = NULL;
    $display = NULL;
    $info    = NULL;
    if ($xml['size'] != '0') {
      foreach ($xml->Video as $clients) {
        if(strstr($clients->Player['address'], $plexClient)) {

          //Now Showing Sections
          if(strstr($clients['type'], "movie")) {
            $art = $clients['thumb'];
          } elseif (strstr($clients['type'], "episode")) {
            $art = $clients['grandparentThumb'];
          }

          if ($art != NULL) {
            $poster = explode("/", $art);
            $poster = trim($poster[count($poster) - 1], '/');
            $filename = 'cache/posters/' . $poster;
            $addAt = $clients['addedAt'];

            $client = "true";

            //Check if image is in local cache.
            if (file_exists($filename)) {
              //Future Code Coming
              } else {
                file_put_contents("cache/posters/$poster", fopen("http://$plexServer:32400$art?X-Plex-Token=$plexToken", 'r'));
              }

            //Progrss Bar
            if ($pmpDisplayProgress == 'Enabled') {
              $percentComplete = getProgress($clients['duration'], $clients['viewOffset']);
              $progressBar = "<div class='progress' style='height : " . $pmpDisplayProgressSize . "px;'><div class='progress-bar' role='progressbar' style='width: " . $percentComplete . "%; background-color : " . $pmpDisplayProgressColor . ";' aria-valuenow='" . $percentComplete . "' aria-valuemin='0' aria-valuemax='100'></div></div> ";
            } else {
              $progressBar = NULL;
            }

            $title = "<br/><p style='font-size: " .  $nowShowingTopFontSize . "px; color : " . $nowShowingTopFontColor  . "; -webkit-text-stroke: " . $nowShowingTopFontOutlineSize . "px " .  $nowShowingTopFontOutlineColor . ";'> $nowShowingTopText </p> $progressBar";
            $display = "<img src='cache/posters/$poster' style='width: 100%'>";

            $results['top'] = "$title";
            $results['middle'] = "$display";

            //Check if same Movie / TV Show is still playing and adjust scrolling.
            if ((($lastNowShowing != $addAt) || ($lastNowShowingBottomFontSize != $nowShowingBottomFontSize) || ($lastNowShowingBottomFontColor != $nowShowingBottomFontColor)) && ($pmpBottomScroll == 'Enabled')) {
              $info = "" . $scrollPrepend . "<p style='font-size: " . $nowShowingBottomFontSize  . "px; color : " . $nowShowingBottomFontColor . ";'>" . $clients['title'] . ": " . $clients['summary'] . "</p>" . $scrollAppend . "";
              $results['top'] = "$title";
              $results['middle'] = "$display";
              $results['bottom'] = "$info";

              updateStatus($addAt,$nowShowingBottomFontSize,$nowShowingBottomFontColor);
            } elseif ($pmpBottomScroll == 'Disabled') {
              $info = "<p style='font-size: " . $nowShowingBottomFontSize  . "px; color : " . $nowShowingBottomFontColor . ";'>" . $clients['title'] . ": " . $clients['summary'] . "</p>";
              $results['top'] = "$title";
              $results['middle'] = "$display";
              $results['bottom'] = "$info";

              updateStatus(NULL,NULL,NULL);
            }
	  }
        }
      }
    }

    //Coming Soon (If Nothing is Playing)
    if ($client != 'true') {

      //Clean Up Cache Dir (Files Older than 24 hours)
      $cachePath = 'cache/posters/';
      if ($handle = opendir($cachePath)) {
        while (false !== ($file = readdir($handle))) {
          if ($file != "." && $file != ".." && ((time()-filectime($cachePath.$file)) > 86400)) {
            unlink($cachePath.$file);
          }
        }
      }

      //Clean Up Status
      updateStatus(NULL,NULL,NULL);

      //Multi Movie Section Support
      $plexServerMovieSections = explode(",", $plexServerMovieSection);
      $useSection = rand(0, count($plexServerMovieSections) -1);

      $title = "<br /><p style='font-size: " .  $comingSoonTopFontSize . "px; color : " . $comingSoonTopFontColor  . "; -webkit-text-stroke: " . $comingSoonTopFontOutlineSize . "px " .  $comingSoonTopFontOutlineColor . ";'> $comingSoonTopText </p>";

      $MoviesURL = 'http://'.$plexServer.':32400/library/sections/' . $plexServerMovieSections[$useSection] . '/' . $comingSoonShowSelection . '?X-Plex-Token='.$plexToken.'';
      $getMovies  = file_get_contents($MoviesURL);
      $xmlMovies = simplexml_load_string($getMovies) or die("feed not loading");
      $countMovies = count($xmlMovies);
      if ($countMovies > '0') {
        foreach ($xmlMovies->Video as $movie) {
          $movies[] = strip_tags($movie['title']);
        }
        $random_keys = array_rand($movies,1);
        $showMovie = $movies[$random_keys];
        foreach ($xmlMovies->Video as $movie) {
          if(strstr($movie['title'], $showMovie)) {
            $art = $movie['thumb'];
            $poster = explode("/", $art);
            $poster = trim($poster[count($poster) - 1], '/');
            $filename = 'cache/posters/' . $poster;

           if (file_exists($filename)) {
             //Future Code Coming
           } else {
             file_put_contents("cache/posters/$poster", fopen("http://$plexServer:32400$art?X-Plex-Token=$plexToken", 'r'));
           }

           $display = "<img src='cache/posters/$poster' style='width: 100%'>";
         }
       }
     }
     $info = "<br /><p style='font-size: " . $comingSoonBottomFontSize  . "px; color : " . $comingSoonBottomFontColor . ";'> $comingSoonBottomText </p>";

     $results['top'] = "$title";
     $results['middle'] = "$display";
     $results['bottom'] = "$info";
    }
  }

 echo json_encode($results);
?>
