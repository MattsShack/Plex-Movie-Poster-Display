<?php
  include 'config.php';
  $results = Array();
  $movies = Array();

  #Display Custom Image if Enabled
  if ($customImageEnabled == "Enabled") {
    $title = "<br /><p style='font-size: " .  $customTopFontSize . "px; color : " . $customTopFontColor  . "; -webkit-text-stroke: " . $customTopFontOutlineSize . "px " .  $customTopFontOutlineColor . ";'> $customTopText </p>";
    $display = "<img src='cache/custom/$customImage' style='width: 100%'>";
    $info = "<br /><p style='font-size: " . $customBottomFontSize  . "px; color : " . $customBottomFontColor . ";'> $customBottomText </p>";
  } else {

    #Plex Module Connect to Plex
    $url     = 'http://'.$plexServer.':32400/status/sessions?X-Plex-Token='.$plexToken.'';
    $getxml  = file_get_contents($url);
    $xml     = simplexml_load_string($getxml) or die("feed not loading");
    $title   = NULL;
    $display = NULL;
    $info    = NULL;
    if ($xml['size'] != '0') {
      foreach ($xml->Video as $clients) {
        if(strstr($clients->Player['address'], $plexClient)) {

          #Now Showing Sections
          #If Client is playing a Movie
          if(strstr($clients['type'], "movie")) {
            $art = $clients['thumb'];
            $poster = explode("/", $art);
            $poster = trim($poster[count($poster) - 1], '/');
            $filename = 'cache/posters/' . $poster;

            #Display Time Played And Time Left - Contributed by Alexander Feyaerts
            $dur = $clients['duration'];
            $durint = (int)$dur;
            $time = $durint / 1000;
            $days = floor($time / (24*60*60));
            $hours = floor(($time - ($days*24*60*60)) / (60*60));
            $minutes = floor(($time - ($days*24*60*60)-($hours*60*60)) / 60);
            $seconds = ($time - ($days*24*60*60) - ($hours*60*60) - ($minutes*60)) % 60;
            $playtime = sprintf("%02d:%02d:%02d",$hours,$minutes,$seconds);

            $off = $clients['viewOffset'];
            $offint = (int)$off;
            $timeoff = $offint / 1000;
            $daysoff = floor($timeoff / (24*60*60));
            $hoursoff = floor(($timeoff - ($daysoff*24*60*60)) / (60*60));
            $minutesoff = floor(($timeoff - ($daysoff*24*60*60)-($hoursoff*60*60)) / 60);
            $secondsoff = ($timeoff - ($daysoff*24*60*60) - ($hoursoff*60*60) - ($minutesoff*60)) % 60;
            $offset = sprintf("%02d:%02d:%02d",$hoursoff,$minutesoff,$secondsoff);

            #Check if file is local if not cache.
            if (file_exists($filename)) {
              #Future Code Coming
            } else {
              file_put_contents("cache/posters/$poster", fopen("http://$plexServer:32400$art?X-Plex-Token=$plexToken", 'r'));
            }
            $title = "<br /><p style='font-size: " .  $nowShowingTopFontSize . "px; color : " . $nowShowingTopFontColor  . "; -webkit-text-stroke: " . $nowShowingTopFontOutlineSize . "px " .  $nowShowingTopFontOutlineColor . ";'> $nowShowingTopText </p>";
            $display = "<img src='cache/posters/$poster' style='width: 100%'>";
            $info = "<p style='font-size: " . $nowShowingBottomFontSize  . "px; color : " . $nowShowingBottomFontColor . ";'>" . $clients['summary'] . "</p>";
	  }

          #If Client is playing a TV Show
          if(strstr($clients['type'], "episode")) {
            $art = $clients['grandparentThumb'];
            $poster = explode("/", $art);
            $poster = trim($poster[count($poster) - 1], '/');
            $filename = 'cache/posters/' . $poster;

            #Check if file is local if not cache.
            if (file_exists($filename)) {
              #Future Code Coming
            } else {
              file_put_contents("cache/posters/$poster", fopen("http://$plexServer:32400$art?X-Plex-Token=$plexToken", 'r'));
            }

            $title = "<br /><p style='font-size: " .  $nowShowingTopFontSize . "px; color : " . $nowShowingTopFontColor  . "; -webkit-text-stroke: " . $nowShowingTopFontOutlineSize . "px " .  $nowShowingTopFontOutlineColor . ";'> $nowShowingTopText </p>";
            $display = "<img src='cache/posters/$poster' style='width: 100%'>";
            $info = "<p style='font-size: " . $nowShowingBottomFontSize  . "px; color : " . $nowShowingBottomFontColor . ";'>Episode: " . $clients['title'] . " - " . $clients['summary'] . "</p>";
          }
        }
      }
    }

    #Coming Soon (If Nothing is Playing)
    if ($display == NULL) {

      #Clean Up Cache Dir (Files Older than 24 hours)
      $cachePath = 'cache/posters/';
      if ($handle = opendir($cachePath)) {
        while (false !== ($file = readdir($handle))) {
          if ((time()-filectime($cachePath.$file)) > 86400) {
            unlink($cachePath.$file);
          }
        }
      }

      #First Attempt at Multi Movie Section Support
      $plexServerMovieSections = explode(",", $plexServerMovieSection);
      $useSection = rand(0, count($plexServerMovieSections) -1);

      $title = "<br /><p style='font-size: " .  $comingSoonTopFontSize . "px; color : " . $comingSoonTopFontColor  . "; -webkit-text-stroke: " . $comingSoonTopFontOutlineSize . "px " .  $comingSoonTopFontOutlineColor . ";'> $comingSoonTopText </p>";

      $UnWatchedMoviesURL = 'http://'.$plexServer.':32400/library/sections/' . $plexServerMovieSections[$useSection] . '/unwatched?X-Plex-Token='.$plexToken.'';
      $getMovies  = file_get_contents($UnWatchedMoviesURL);
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
             #Future Code Coming
           } else {
             file_put_contents("cache/posters/$poster", fopen("http://$plexServer:32400$art?X-Plex-Token=$plexToken", 'r'));
           }

           $display = "<img src='cache/posters/$poster' style='width: 100%'>";
         }
       }
     }
 
     $info = "<br /><p style='font-size: " . $comingSoonBottomFontSize  . "px; color : " . $comingSoonBottomFontColor . ";'> $comingSoonBottomText </p>";
    }
  }

  #Display
  $results['top'] = "$title";
  $results['middle'] = "$display";
  $results['bottom'] = "$info";
  echo json_encode($results);
?>