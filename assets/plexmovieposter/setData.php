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

    // // Server PHP
    // if ($configPage != "server.php" && $configPage != "login.php" && $configPage != "plex.php") {
    //     $ghostField = "\n";
    //     echo $ghostField;

    //     $ghostField = "$formIndent<!-- Server PHP -->\n";
    //     echo $ghostField;

    //     $ghostField = "$formIndent<input type=\"hidden\" id=\"plexServer\" name=\"plexServer\" value=\"$plexServer\">\n";
    //     echo $ghostField;

    //     $ghostField = "$formIndent<input type=\"hidden\" id=\"plexServerDirect\" name=\"plexServerDirect\" value=\"$plexServerDirect\">\n";
    //     echo $ghostField;

    //     $ghostField = "$formIndent<input type=\"hidden\" id=\"plexToken\" name=\"plexToken\" value=\"$plexToken\">\n";
    //     echo $ghostField;

    //     $ghostField = "$formIndent<input type=\"hidden\" id=\"plexServerMovieSection\" name=\"plexServerMovieSection\" value=\"$plexServerMovieSection\">\n";
    //     echo $ghostField;

    //     $ghostField = "$formIndent<input type=\"hidden\" id=\"plexServerSSL\" name=\"plexServerSSL\" value=\"$plexServerSSL\">\n";
    //     echo $ghostField;
    // }

    // // Client PHP
    // if ($configPage != "client.php" && $configPage != "login.php" && $configPage != "plex.php") {
    //     $ghostField = "\n";
    //     echo $ghostField;

    //     $ghostField = "$formIndent<!-- Client PHP -->\n";
    //     echo $ghostField;

    //     $ghostField = "$formIndent<input type=\"hidden\" id=\"plexClient\" name=\"plexClient\" value=\"$plexClient\">\n";
    //     echo $ghostField;

    //     $ghostField = "$formIndent<input type=\"hidden\" id=\"plexClientName\" name=\"plexClientName\" value=\"$plexClientName\">\n";
    //     echo $ghostField;
    // }

    // Coming Soon PHP
    if ($configPage != "comingSoon.php" && $configPage != "login.php") {
        $ghostField = "\n";
        echo $ghostField;

        $ghostField = "$formIndent<!-- Coming Soon PHP -->\n";
        echo $ghostField;

        $ghostField = "$formIndent<input type=\"hidden\" id=\"comingSoonBackgroundArt\" name=\"comingSoonBackgroundArt\" value=\"$comingSoonBackgroundArt\">\n";
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
  //PMPD Configuration
  \$pmpConfigVersion = '2';
  \$pmpUsername = '$_POST[pmpUsername]';
  \$pmpPassword = '$_POST[pmpPassword]';
  \$pmpClearImageCache = 'Yes'; //Default Yes
  \$pmpImageSpeed = '$_POST[pmpImageSpeed]'; //Default 30 Seconds
  \$pmpPosterDir = 'cache/posters/'; //Default cache/posters/ (FUTURE)
  \$pmpArtDir = 'cache/art/'; //Default cache/art/ (FUTURE)
  \$pmpCustomDir = 'cache/custom/'; //Default cache/custom/ (FUTURE)
  \$pmpLogDir = 'cache/logs/'; //Default cache/logs/ (FUTURE)

  //Server Configuration
  \$plexServer = '$_POST[plexServer]';
  \$plexServerDirect = '$_POST[plexServerDirect]';
  \$plexToken = '$_POST[plexToken]';
  \$plexServerMovieSection = '$_POST[plexServerMovieSection]';
  \$cacheEnabled = '$_POST[cacheEnabled]'; //Default true
  \$plexServerSSL = '$_POST[plexServerSSL]'; //Default: Unchecked

  //Client Configuration
  \$plexClient = '$_POST[plexClient]';
  \$plexClientName = '$_POST[plexClientName]';

  //Custom Image Configuration
  \$customBackgroundArt = '$_POST[customBackgroundArt]'; //Default: false
  \$customImageEnabled = '$_POST[customImageEnabled]'; //Default: Disabled
  \$customRefreshSpeed = '$_POST[customRefreshSpeed]'; //Default 30 Seconds
  \$customImage = '$_POST[customImage]';
  \$customTopText = '$_POST[customTopText]';
  \$customTopFontSize = '$_POST[customTopFontSize]'; //Default: 55 (px)
  \$customTopFontColor = '$_POST[customTopFontColor]'; //Default: #FFFF00 (Yellow)
  \$customTopFontEnabled = '$_POST[customTopFontEnabled]'; //Default: Unchecked
  \$customTopFontID = '$_POST[customTopFontID]'; //Default: None
  \$customTopFontOutlineSize = '$_POST[customTopFontOutlineSize]'; //Default: 0 (px)
  \$customTopFontOutlineColor = '$_POST[customTopFontOutlineColor]'; //Default: #FFFF00 (Yellow)
  \$customBottomText = '$_POST[customBottomText]';
  \$customBottomFontSize = '$_POST[customBottomFontSize]'; //Default: 25 (px)
  \$customBottomFontColor = '$_POST[customBottomFontColor]'; //Default: #FFFFFF (White)
  \$customBottomFontEnabled = '$_POST[customBottomFontEnabled]'; //Default: Unchecked
  \$customBottomFontID = '$_POST[customBottomFontID]'; //Default: None
  \$customBottomFontOutlineSize = '$_POST[customBottomFontOutlineSize]'; //Default: 0 (px)
  \$customBottomFontOutlineColor = '$_POST[customBottomFontOutlineColor]'; //Default: #FFFFFF (White)

  //Coming Soon Configuration
  \$comingSoonBackgroundArt = '$_POST[comingSoonBackgroundArt]'; //Default: false
  \$comingSoonRefreshSpeed = '$_POST[comingSoonRefreshSpeed]'; //Default 30 Seconds
  \$comingSoonTop = '$_POST[comingSoonTop]'; //Default: custom (title/summary/tagline/custom)
  \$comingSoonTopAutoScale = '$_POST[comingSoonTopAutoScale]'; //Default: false
  \$comingSoonTopText = '$_POST[comingSoonTopText]';
  \$comingSoonTopFontSize = '$_POST[comingSoonTopFontSize]'; //Default: 55 (px)
  \$comingSoonTopFontColor = '$_POST[comingSoonTopFontColor]'; //Default: #FFFF00 (Yellow)
  \$comingSoonTopFontEnabled = '$_POST[comingSoonTopFontEnabled]'; //Default: Unchecked
  \$comingSoonTopFontID = '$_POST[comingSoonTopFontID]'; //Default: None
  \$comingSoonTopFontOutlineSize = '$_POST[comingSoonTopFontOutlineSize]'; //Default: 0 (px)
  \$comingSoonTopFontOutlineColor = '$_POST[comingSoonTopFontOutlineColor]'; //Default: #FFFF00 (Yellow)
  \$showComingSoonInfo = '$_POST[showComingSoonInfo]'; //Default: false
  \$comingSoonBottom = '$_POST[comingSoonBottom]'; //Default: custom (title/summary/tagline/custom)
  \$comingSoonBottomText = '$_POST[comingSoonBottomText]';
  \$comingSoonBottomAutoScale = '$_POST[comingSoonBottomAutoScale]'; //Default: false
  \$comingSoonBottomScroll = '$_POST[comingSoonBottomScroll]'; //Default: Disabled
  \$comingSoonBottomFontSize = '$_POST[comingSoonBottomFontSize]'; //Default: 25 (px)
  \$comingSoonBottomFontColor = '$_POST[comingSoonBottomFontColor]'; //Default: #FFFFFF (White)
  \$comingSoonBottomFontEnabled = '$_POST[comingSoonBottomFontEnabled]'; //Default: Unchecked
  \$comingSoonBottomFontID = '$_POST[comingSoonBottomFontID]'; //Default: None
  \$comingSoonBottomFontOutlineSize = '$_POST[comingSoonBottomFontOutlineSize]'; //Default: 0 (px)
  \$comingSoonBottomFontOutlineColor = '$_POST[comingSoonBottomFontOutlineColor]'; //Default: #FFFFFF (White)
  \$comingSoonShowSelection = '$_POST[comingSoonShowSelection]'; //Default: unwatched
  \$comingSoonShowTVThumb = '$_POST[comingSoonShowTVThumb]'; //Default: series

  //Now Showing Configuration
  \$nowShowingBackgroundArt = '$_POST[nowShowingBackgroundArt]'; //Default: false
  \$nowShowingRefreshSpeed = '$_POST[nowShowingRefreshSpeed]'; //Default 30 Seconds
  \$nowShowingTop = '$_POST[nowShowingTop]'; //Default: custom (title/summary/tagline/custom)
  \$nowShowingTopAutoScale = '$_POST[nowShowingTopAutoScale]'; //Default: false
  \$nowShowingTopText = '$_POST[nowShowingTopText]';
  \$nowShowingTopFontSize = '$_POST[nowShowingTopFontSize]'; //Default: 55 (px)
  \$nowShowingTopFontColor = '$_POST[nowShowingTopFontColor]'; //Default: #FFFF00 (Yellow)
  \$nowShowingTopFontEnabled = '$_POST[nowShowingTopFontEnabled]'; //Default: Unchecked
  \$nowShowingTopFontID = '$_POST[nowShowingTopFontID]'; //Default: None
  \$nowShowingTopFontOutlineSize = '$_POST[nowShowingTopFontOutlineSize]'; //Default: 0 (px)
  \$nowShowingTopFontOutlineColor = '$_POST[nowShowingTopFontOutlineColor]'; //Default: #FFFF00 (Yellow)
  \$nowShowingBottom = '$_POST[nowShowingBottom]'; //Default: title (title/summary/tagline/custom)
  \$nowShowingBottomText = '$_POST[nowShowingBottomText]';
  \$nowShowingBottomAutoScale = '$_POST[nowShowingBottomAutoScale]'; //Default: false
  \$nowShowingBottomScroll = '$_POST[nowShowingBottomScroll]'; //Default: Disabled
  \$nowShowingBottomFontSize = '$_POST[nowShowingBottomFontSize]'; //Default: 25 (px)
  \$nowShowingBottomFontColor = '$_POST[nowShowingBottomFontColor]'; //Default: #FFFFFF (White)
  \$nowShowingBottomFontEnabled = '$_POST[nowShowingBottomFontEnabled]'; //Default: Unchecked
  \$nowShowingBottomFontID = '$_POST[nowShowingBottomFontID]'; //Default: None
  \$nowShowingBottomFontOutlineSize = '$_POST[nowShowingBottomFontOutlineSize]'; //Default: 0 (px)
  \$nowShowingBottomFontOutlineColor = '$_POST[nowShowingBottomFontOutlineColor]'; //Default: #FFFFFF (White)
  \$nowShowingShowTVThumb = '$_POST[nowShowingShowTVThumb]'; //Default: series

  //Misc Configuration
  \$pmpDisplayProgress = '$_POST[pmpDisplayProgress]'; //Default: Disabled
  \$pmpDisplayProgressSize = '$_POST[pmpDisplayProgressSize]'; //Default: 5 (px)
  \$pmpDisplayProgressColor = '$_POST[pmpDisplayProgressColor]'; //Default: #FFFF00 (Yellow)
  \$pmpDisplayClock = 'Disabled'; //Default: Disabled (FUTURE)
  \$pmpBottomScroll = '$_POST[pmpBottomScroll]'; //Default: Disabled
  \$pmpBottomScrollSpeed = '1'; //Default: 1 (FUTURE)
?>";

    echo $newConfig;
    fwrite($myfile, $newConfig);
    sleep(2);
    fclose($myfile);
    // header("Location: $configPage");
    echo "<script>window.location.href='$configPage';</script>";
    exit;
}

?>