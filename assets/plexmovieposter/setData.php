<?php

function ghostData($configPage) {
    // TODO:
    // - Cleanup and set as an array and loop to simplify the processing of ghost data.
    include '../config.php';

    $formIndent = "\t\t\t\t\t\t\t\t\t";

    // echo 'GHOST BLOCK START';

    // Login PHP
    if ($configPage == "login.php") {
        $ghostField = "\n";
        echo $ghostField;

        $ghostField = "$formIndent<!-- Login PHP -->\n";
        echo $ghostField;

        // $ghostField = "$formIndent<input type=\"hidden\" id=\"returnPage\" name=\"returnPage\" value=\"$returnPage\">\n";
        // <?php echo $returnPage; /?/>
        // echo $ghostField;
    }

    // General PHP
    if ($configPage != "general.php" && $configPage != "login.php") {
        $ghostField = "\n";
        echo $ghostField;

        $ghostField = "$formIndent<!-- General PHP -->\n";
        echo $ghostField;
    }

    // Security PHP
    if ($configPage != "security.php" && $configPage != "login.php") {
        $ghostField = "\n";
        echo $ghostField;

        $ghostField = "$formIndent<!-- Security PHP -->\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"pmpUsername\" name=\"pmpUsername\" value=\"$pmpUsername\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"pmpPassword\" name=\"pmpPassword\" value=\"$pmpPassword\">\n";
        echo $ghostField;
    }

    // Common PHP
    if ($configPage != "common.php" && $configPage != "login.php") {
        $ghostField = "\n";
        echo $ghostField;

        $ghostField = "$formIndent<!-- Common PHP -->\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"pmpImageSpeed\" name=\"pmpImageSpeed\" value=\"$pmpImageSpeed\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"pmpBottomScroll\" name=\"pmpBottomScroll\" value=\"$pmpBottomScroll\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"cacheEnabled\" name=\"cacheEnabled\" value=\"$cacheEnabled\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"pmpPosterDir\" name=\"pmpPosterDir\" value=\"$pmpPosterDir\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"pmpPosterDir_24hExp\" name=\"pmpPosterDir_24hExp\" value=\"$pmpPosterDir_24hExp\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"pmpArtDir\" name=\"pmpArtDir\" value=\"$pmpArtDir\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"pmpArtDir_24hExp\" name=\"pmpArtDir_24hExp\" value=\"$pmpArtDir_24hExp\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"pmpCustomDir\" name=\"pmpCustomDir\" value=\"$pmpCustomDir\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"pmpCustomDir_24hExp\" name=\"pmpCustomDir_24hExp\" value=\"$pmpCustomDir_24hExp\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"pmpFontDir\" name=\"pmpFontDir\" value=\"$pmpFontDir\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"pmpFontDir_24hExp\" name=\"pmpFontDir_24hExp\" value=\"$pmpFontDir_24hExp\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"pmpLogDir\" name=\"pmpLogDir\" value=\"$pmpLogDir\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"pmpLogDir_24hExp\" name=\"pmpLogDir_24hExp\" value=\"$pmpLogDir_24hExp\">\n";
        echo $ghostField;
    }


    //PLEX PHP
    if ($configPage != "plex.php" && $configPage != "login.php") {
        $ghostField = "\n";
        echo $ghostField;

        $ghostField = "$formIndent<!-- PLEX PHP -->\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"plexServer\" name=\"plexServer\" value=\"$plexServer\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"plexServerDirect\" name=\"plexServerDirect\" value=\"$plexServerDirect\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"plexToken\" name=\"plexToken\" value=\"$plexToken\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"plexServerMovieSection\" name=\"plexServerMovieSection\" value=\"$plexServerMovieSection\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"plexServerSSL\" name=\"plexServerSSL\" value=\"$plexServerSSL\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"plexClient\" name=\"plexClient\" value=\"$plexClient\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"plexClientName\" name=\"plexClientName\" value=\"$plexClientName\">\n";
        echo $ghostField;
    }

    // Coming Soon PHP
    if ($configPage != "comingSoon.php" && $configPage != "login.php") {
        $ghostField = "\n";
        echo $ghostField;

        $ghostField = "$formIndent<!-- Coming Soon PHP -->\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonBackgroundArt\" name=\"comingSoonBackgroundArt\" value=\"$comingSoonBackgroundArt\">\n";
        echo $ghostField;
        
        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonFullScreenArt\" name=\"comingSoonFullScreenArt\" value=\"$comingSoonFullScreenArt\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonRefreshSpeed\" name=\"comingSoonRefreshSpeed\" value=\"$comingSoonRefreshSpeed\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonShowSelection\" name=\"comingSoonShowSelection\" value=\"$comingSoonShowSelection\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonShowTVThumb\" name=\"comingSoonShowTVThumb\" value=\"$comingSoonShowTVThumb\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonTop\" name=\"comingSoonTop\" value=\"$comingSoonTop\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonTopText\" name=\"comingSoonTopText\" value=\"$comingSoonTopText\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonTopFontSize\" name=\"comingSoonTopFontSize\" value=\"$comingSoonTopFontSize\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonTopFontColor\" name=\"comingSoonTopFontColor\" value=\"$comingSoonTopFontColor\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonTopFontEnabled\" name=\"comingSoonTopFontEnabled\" value=\"$comingSoonTopFontEnabled\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonTopFontID\" name=\"comingSoonTopFontID\" value=\"$comingSoonTopFontID\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonTopFontOutlineSize\" name=\"comingSoonTopFontOutlineSize\" value=\"$comingSoonTopFontOutlineSize\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonTopFontOutlineColor\" name=\"comingSoonTopFontOutlineColor\" value=\"$comingSoonTopFontOutlineColor\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonTopAutoScale\" name=\"comingSoonTopAutoScale\" value=\"$comingSoonTopAutoScale\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonBottom\" name=\"comingSoonBottom\" value=\"$comingSoonBottom\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonBottomText\" name=\"comingSoonBottomText\" value=\"$comingSoonBottomText\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonBottomFontSize\" name=\"comingSoonBottomFontSize\" value=\"$comingSoonBottomFontSize\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonBottomFontColor\" name=\"comingSoonBottomFontColor\" value=\"$comingSoonBottomFontColor\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonBottomFontEnabled\" name=\"comingSoonBottomFontEnabled\" value=\"$comingSoonBottomFontEnabled\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonBottomFontID\" name=\"comingSoonBottomFontID\" value=\"$comingSoonBottomFontID\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonBottomFontOutlineSize\" name=\"comingSoonBottomFontOutlineSize\" value=\"$comingSoonBottomFontOutlineSize\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonBottomFontOutlineColor\" name=\"comingSoonBottomFontOutlineColor\" value=\"$comingSoonBottomFontOutlineColor\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonBottomAutoScale\" name=\"comingSoonBottomAutoScale\" value=\"$comingSoonBottomAutoScale\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonBottomScroll\" name=\"comingSoonBottomScroll\" value=\"$comingSoonBottomScroll\">\n";
        echo $ghostField;
    }

    // Now Showing PHP
    if ($configPage != "nowShowing.php" && $configPage != "login.php") {
        $ghostField = "\n";
        echo $ghostField;

        $ghostField = "$formIndent<!-- Now Showing PHP -->\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingBackgroundArt\" name=\"nowShowingBackgroundArt\" value=\"$nowShowingBackgroundArt\">\n";
        echo $ghostField;
        
        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingFullScreenArt\" name=\"nowShowingFullScreenArt\" value=\"$nowShowingFullScreenArt\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingRefreshSpeed\" name=\"nowShowingRefreshSpeed\" value=\"$nowShowingRefreshSpeed\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingShowTVThumb\" name=\"nowShowingShowTVThumb\" value=\"$nowShowingShowTVThumb\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingTop\" name=\"nowShowingTop\" value=\"$nowShowingTop\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingTopText\" name=\"nowShowingTopText\" value=\"$nowShowingTopText\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingTopFontSize\" name=\"nowShowingTopFontSize\" value=\"$nowShowingTopFontSize\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingTopFontColor\" name=\"nowShowingTopFontColor\" value=\"$nowShowingTopFontColor\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingTopFontEnabled\" name=\"nowShowingTopFontEnabled\" value=\"$nowShowingTopFontEnabled\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingTopFontID\" name=\"nowShowingTopFontID\" value=\"$nowShowingTopFontID\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingTopFontOutlineSize\" name=\"nowShowingTopFontOutlineSize\" value=\"$nowShowingTopFontOutlineSize\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingTopFontOutlineColor\" name=\"nowShowingTopFontOutlineColor\" value=\"$nowShowingTopFontOutlineColor\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingTopAutoScale\" name=\"nowShowingTopAutoScale\" value=\"$nowShowingTopAutoScale\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingBottom\" name=\"nowShowingBottom\" value=\"$nowShowingBottom\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingBottomText\" name=\"nowShowingBottomText\" value=\"$nowShowingBottomText\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingBottomFontSize\" name=\"nowShowingBottomFontSize\" value=\"$nowShowingBottomFontSize\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingBottomFontColor\" name=\"nowShowingBottomFontColor\" value=\"$nowShowingBottomFontColor\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingBottomFontEnabled\" name=\"nowShowingBottomFontEnabled\" value=\"$nowShowingBottomFontEnabled\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingBottomFontID\" name=\"nowShowingBottomFontID\" value=\"$nowShowingBottomFontID\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingBottomFontOutlineSize\" name=\"nowShowingBottomFontOutlineSize\" value=\"$nowShowingBottomFontOutlineSize\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingBottomFontOutlineColor\" name=\"nowShowingBottomFontOutlineColor\" value=\"$nowShowingBottomFontOutlineColor\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingBottomAutoScale\" name=\"nowShowingBottomAutoScale\" value=\"$nowShowingBottomAutoScale\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"nowShowingBottomScroll\" name=\"nowShowingBottomScroll\" value=\"$nowShowingBottomScroll\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"pmpDisplayProgress\" name=\"pmpDisplayProgress\" value=\"$pmpDisplayProgress\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"pmpDisplayProgressSize\" name=\"pmpDisplayProgressSize\" value=\"$pmpDisplayProgressSize\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"pmpDisplayProgressColor\" name=\"pmpDisplayProgressColor\" value=\"$pmpDisplayProgressColor\">\n";
        echo $ghostField;
    }

    // Custom PHP
    if ($configPage != "custom.php" && $configPage != "login.php") {
        $ghostField = "\n";
        echo $ghostField;

        $ghostField = "$formIndent<!-- Custom PHP -->\n";
        echo $ghostField;

        // // $ghostField = "$formIndent<input type=\"hidden\" id=\"customImageUpload\" name=\"customImageUpload\" value=\"$customImageUpload\">\n";
        // // echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"customBackgroundArt\" name=\"customBackgroundArt\" value=\"$customBackgroundArt\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"customFullScreenArt\" name=\"customFullScreenArt\" value=\"$customFullScreenArt\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"customImageEnabled\" name=\"customImageEnabled\" value=\"$customImageEnabled\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"customRefreshSpeed\" name=\"customRefreshSpeed\" value=\"$customRefreshSpeed\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"customImage\" name=\"customImage\" value=\"$customImage\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"customTopText\" name=\"customTopText\" value=\"$customTopText\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"customTopFontSize\" name=\"customTopFontSize\" value=\"$customTopFontSize\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"customTopFontColor\" name=\"customTopFontColor\" value=\"$customTopFontColor\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"customTopFontEnabled\" name=\"customTopFontEnabled\" value=\"$customTopFontEnabled\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"customTopFontID\" name=\"customTopFontID\" value=\"$customTopFontID\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"customTopFontOutlineSize\" name=\"customTopFontOutlineSize\" value=\"$customTopFontOutlineSize\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"customTopFontOutlineColor\" name=\"customTopFontOutlineColor\" value=\"$customTopFontOutlineColor\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"customBottomText\" name=\"customBottomText\" value=\"$customBottomText\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"customBottomFontSize\" name=\"customBottomFontSize\" value=\"$customBottomFontSize\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"customBottomFontColor\" name=\"customBottomFontColor\" value=\"$customBottomFontColor\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"customBottomFontEnabled\" name=\"customBottomFontEnabled\" value=\"$customBottomFontEnabled\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"customBottomFontID\" name=\"customBottomFontID\" value=\"$customBottomFontID\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"customBottomFontOutlineSize\" name=\"customBottomFontOutlineSize\" value=\"$customBottomFontOutlineSize\">\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"customBottomFontOutlineColor\" name=\"customBottomFontOutlineColor\" value=\"$customBottomFontOutlineColor\">\n";
        echo $ghostField;
    }

    // echo 'GHOST BLOCK END';
}

function setData($configPage) {
    //Save Configuration

    // //Custom Image Upload
    // if ($_FILES['customImageUpload'] != "") {
    //     $uploaddir = 'cache/custom/';
    //     $uploadfile = $uploaddir . basename($_FILES['customImageUpload']['name']);

    //     if (move_uploaded_file($_FILES['customImageUpload']['tmp_name'], $uploadfile)) {
    //     } else {
    //         $uploadfile = $_POST['customImageUpload'];
    //     }
    // }

    //Define Config File
    $myfile = fopen("../config.php", "w") or die("Unable to open file!");

    //FixUP POST Data
    $_POST = array_map("stripslashes", $_POST);

    //Create New Config
    $newConfig = "
<?php
  // PMPD Configuration
  \$pmpConfigVersion = '2.10.7';
  \$pmpUsername = '$_POST[pmpUsername]';
  \$pmpPassword = '$_POST[pmpPassword]';
  \$pmpClearImageCache = 'Yes'; // Default: Yes
  // \$pmpImageSpeed = '$_POST[pmpImageSpeed]'; // Default: 30 (Seconds)

  // Cache Configuration
  \$cacheEnabled = '$_POST[cacheEnabled]'; // Default: TRUE
  \$pmpPosterDir = '$_POST[pmpPosterDir]'; // Default: cache/posters/
  \$pmpPosterDir_24hExp = '$_POST[pmpPosterDir_24hExp]'; // Default: TRUE
  \$pmpArtDir = '$_POST[pmpArtDir]'; // Default: cache/art/
  \$pmpArtDir_24hExp = '$_POST[pmpArtDir_24hExp]'; // Default: TRUE
  \$pmpCustomDir = '$_POST[pmpCustomDir]'; // Default: cache/custom/
  \$pmpCustomDir_24hExp = '$_POST[pmpCustomDir_24hExp]'; // Default: FALSE
  \$pmpFontDir = '$_POST[pmpFontDir]'; // Default: cache/fonts/
  \$pmpFontDir_24hExp = '$_POST[pmpFontDir_24hExp]'; // Default: FALSE
  \$pmpLogDir = '$_POST[pmpLogDir]'; // Default: cache/logs/
  \$pmpLogDir_24hExp = '$_POST[pmpLogDir_24hExp]'; // Default: FALSE

  // Plex Configuration
  \$plexServer = '$_POST[plexServer]';
  \$plexServerDirect = '$_POST[plexServerDirect]';
  \$plexToken = '$_POST[plexToken]';
  \$plexServerMovieSection = '$_POST[plexServerMovieSection]';
  \$plexServerSSL = '$_POST[plexServerSSL]'; // Default: FALSE
  \$plexClient = '$_POST[plexClient]';
  \$plexClientName = '$_POST[plexClientName]';

  // Custom Image Configuration
  \$customBackgroundArt = '$_POST[customBackgroundArt]'; // Default: FALSE
  \$customFullScreenArt = '$_POST[customFullScreenArt]'; // Default: FALSE
  \$customRefreshSpeed = '$_POST[customRefreshSpeed]'; // Default: 30 (Seconds)
  \$customImageEnabled = '$_POST[customImageEnabled]'; // Default: Disabled
  \$customImage = '$_POST[customImage]';

  // Custom Image Configuration - Top Settings
  \$customTopText = '$_POST[customTopText]';
  \$customTopFontSize = '$_POST[customTopFontSize]'; // Default: 55 (px)
  \$customTopFontColor = '$_POST[customTopFontColor]'; // Default: #FFFF00 (Yellow)
  \$customTopFontOutlineSize = '$_POST[customTopFontOutlineSize]'; // Default: 0 (px)
  \$customTopFontOutlineColor = '$_POST[customTopFontOutlineColor]'; // Default: #FFFF00 (Yellow)
  \$customTopFontEnabled = '$_POST[customTopFontEnabled]'; // Default: FALSE
  \$customTopFontID = '$_POST[customTopFontID]'; // Default: None

  // Custom Image Configuration - Bottom Settings
  \$customBottomText = '$_POST[customBottomText]';
  \$customBottomFontSize = '$_POST[customBottomFontSize]'; // Default: 25 (px)
  \$customBottomFontColor = '$_POST[customBottomFontColor]'; // Default: #FFFFFF (White)
  \$customBottomFontOutlineSize = '$_POST[customBottomFontOutlineSize]'; // Default: 0 (px)
  \$customBottomFontOutlineColor = '$_POST[customBottomFontOutlineColor]'; // Default: #FFFFFF (White)
  \$customBottomFontEnabled = '$_POST[customBottomFontEnabled]'; // Default: FALSE
  \$customBottomFontID = '$_POST[customBottomFontID]'; // Default: None

  // Coming Soon Configuration
  \$comingSoonBackgroundArt = '$_POST[comingSoonBackgroundArt]'; // Default: FALSE
  \$comingSoonFullScreenArt = '$_POST[comingSoonFullScreenArt]'; // Default: FALSE
  \$comingSoonRefreshSpeed = '$_POST[comingSoonRefreshSpeed]'; // Default: 30 (Seconds)
  \$comingSoonShowTVThumb = '$_POST[comingSoonShowTVThumb]'; // Default: series
  \$comingSoonShowSelection = '$_POST[comingSoonShowSelection]'; // Default: unwatched
  // \$showComingSoonInfo = '$_POST[showComingSoonInfo]'; // Default: FALSE

  // Coming Soon Configuration - Top Settings
  \$comingSoonTop = '$_POST[comingSoonTop]'; // Default: custom (title/summary/tagline/custom)
  \$comingSoonTopText = '$_POST[comingSoonTopText]';
  \$comingSoonTopFontSize = '$_POST[comingSoonTopFontSize]'; // Default: 55 (px)
  \$comingSoonTopFontColor = '$_POST[comingSoonTopFontColor]'; // Default: #FFFF00 (Yellow)
  \$comingSoonTopFontOutlineSize = '$_POST[comingSoonTopFontOutlineSize]'; // Default: 0 (px)
  \$comingSoonTopFontOutlineColor = '$_POST[comingSoonTopFontOutlineColor]'; // Default: #FFFF00 (Yellow)
  \$comingSoonTopFontEnabled = '$_POST[comingSoonTopFontEnabled]'; // Default: FALSE
  \$comingSoonTopFontID = '$_POST[comingSoonTopFontID]'; // Default: None
  \$comingSoonTopAutoScale = '$_POST[comingSoonTopAutoScale]'; // Default: FALSE

  // Coming Soon Configuration - Bottom Settings
  \$comingSoonBottom = '$_POST[comingSoonBottom]'; // Default: custom (title/summary/tagline/presented/custom)
  \$comingSoonBottomText = '$_POST[comingSoonBottomText]';
  \$comingSoonBottomFontSize = '$_POST[comingSoonBottomFontSize]'; // Default: 25 (px)
  \$comingSoonBottomFontColor = '$_POST[comingSoonBottomFontColor]'; // Default: #FFFFFF (White)
  \$comingSoonBottomFontOutlineSize = '$_POST[comingSoonBottomFontOutlineSize]'; // Default: 0 (px)
  \$comingSoonBottomFontOutlineColor = '$_POST[comingSoonBottomFontOutlineColor]'; // Default: #FFFFFF (White)
  \$comingSoonBottomFontEnabled = '$_POST[comingSoonBottomFontEnabled]'; // Default: FALSE
  \$comingSoonBottomFontID = '$_POST[comingSoonBottomFontID]'; // Default: None
  \$comingSoonBottomAutoScale = '$_POST[comingSoonBottomAutoScale]'; // Default: FALSE
  \$comingSoonBottomScroll = '$_POST[comingSoonBottomScroll]'; // Default: Disabled

  // Now Showing Configuration
  \$nowShowingBackgroundArt = '$_POST[nowShowingBackgroundArt]'; // Default: FALSE
  \$nowShowingFullScreenArt = '$_POST[nowShowingFullScreenArt]'; // Default: FALSE
  \$nowShowingRefreshSpeed = '$_POST[nowShowingRefreshSpeed]'; // Default: 30 (Seconds)
  \$nowShowingShowTVThumb = '$_POST[nowShowingShowTVThumb]'; // Default: series
  \$pmpDisplayProgress = '$_POST[pmpDisplayProgress]'; // Default: Disabled
  \$pmpDisplayProgressSize = '$_POST[pmpDisplayProgressSize]'; // Default: 5 (px)
  \$pmpDisplayProgressColor = '$_POST[pmpDisplayProgressColor]'; // Default: #FFFF00 (Yellow)

  // Now Showing Configuration - Top Settings
  \$nowShowingTop = '$_POST[nowShowingTop]'; // Default: custom (title/summary/tagline/progessinfo/custom)
  \$nowShowingTopText = '$_POST[nowShowingTopText]';
  \$nowShowingTopFontSize = '$_POST[nowShowingTopFontSize]'; // Default: 55 (px)
  \$nowShowingTopFontColor = '$_POST[nowShowingTopFontColor]'; // Default: #FFFF00 (Yellow)
  \$nowShowingTopFontOutlineSize = '$_POST[nowShowingTopFontOutlineSize]'; // Default: 0 (px)
  \$nowShowingTopFontOutlineColor = '$_POST[nowShowingTopFontOutlineColor]'; // Default: #FFFF00 (Yellow)
  \$nowShowingTopFontEnabled = '$_POST[nowShowingTopFontEnabled]'; // Default: FALSE
  \$nowShowingTopFontID = '$_POST[nowShowingTopFontID]'; // Default: None
  \$nowShowingTopAutoScale = '$_POST[nowShowingTopAutoScale]'; // Default: FALSE

  // Now Showing Configuration - Bottom Settings
  \$nowShowingBottom = '$_POST[nowShowingBottom]'; // Default: title (title/summary/tagline/presented/custom)
  \$nowShowingBottomText = '$_POST[nowShowingBottomText]';
  \$nowShowingBottomFontSize = '$_POST[nowShowingBottomFontSize]'; // Default: 25 (px)
  \$nowShowingBottomFontColor = '$_POST[nowShowingBottomFontColor]'; // Default: #FFFFFF (White)
  \$nowShowingBottomFontOutlineSize = '$_POST[nowShowingBottomFontOutlineSize]'; // Default: 0 (px)
  \$nowShowingBottomFontOutlineColor = '$_POST[nowShowingBottomFontOutlineColor]'; // Default: #FFFFFF (White)
  \$nowShowingBottomFontEnabled = '$_POST[nowShowingBottomFontEnabled]'; // Default: FALSE
  \$nowShowingBottomFontID = '$_POST[nowShowingBottomFontID]'; // Default: None
  \$nowShowingBottomAutoScale = '$_POST[nowShowingBottomAutoScale]'; // Default: FALSE
  \$nowShowingBottomScroll = '$_POST[nowShowingBottomScroll]'; // Default: Disabled

  // Misc Configuration
  \$pmpDisplayClock = 'Disabled'; // Default: Disabled (FUTURE)
  // \$pmpBottomScroll = '$_POST[pmpBottomScroll]'; // Default: Disabled
  \$pmpBottomScrollSpeed = '1'; // Default: 1 (FUTURE)
?>";

    echo $newConfig;
    fwrite($myfile, $newConfig);
    fclose($myfile);
    sleep(5); // Change from '2' to '5' second sleep time to allow for save to complete fully.
    // header("Location: $configPage");
    echo "<script>window.location.href='$configPage';</script>";
    // echo "<script>window.location.href='$configPage?nocache=' + (new Date()).getTime();</script>";
    exit;
}

?>