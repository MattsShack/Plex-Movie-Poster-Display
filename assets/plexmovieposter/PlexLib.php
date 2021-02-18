<?php

//  NEED TO SUPPORT "movie" and "show" as well as "clients"

function plex_metadata_title($mediaType = "episode") {
    global $clients;
    global $mediaTitle, $mediaTitle_MetadataID;

    $media_MetadataID_STR = "";

    // Title
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'title';
            $media_logClass = "getTVShowData";
            break;
        case "season":
            $media_metadata_name = 'parentTitle';
            $media_logClass = "getTVShowData";
            break;
        case "series":
            $media_metadata_name = 'grandparentTitle';
            $media_logClass = "getTVShowData";
            break;
        case "movie":
            $media_metadata_name = 'title';
            $media_logClass = "getMovieData";
            break;
        case "track":
            $media_metadata_name = 'title'; // Track Title (future - title, parentTitle (Album), grandparentTitle (Artist))
            $media_logClass = "getMusicData";
            break;
        default:
            $media_metadata_name = 'title';
            $media_logClass = "getTVShowData";
    }

    $mediaTitle = $clients[$media_metadata_name];

    // $media_MetadataID_TMP = preg_split("#/#", $mediaTitle);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaTitle_MetadataID = $media_MetadataID;
    pmp_Logging("$media_logClass", "mediaTitle @ $mediaType ($media_metadata_name) $media_MetadataID_STR - $mediaTitle");
}

function plex_metadata_summary($mediaType = "episode") {
    global $clients;
    global $mediaSummary, $mediaSummary_MetadataID;

    $media_MetadataID_STR = "";

    // Summary
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'summary';
            $media_logClass = "getTVShowData";
            break;
        case "season":
            $media_metadata_name = 'summary';
            $media_logClass = "getTVShowData";
            break;
        case "series":
            $media_metadata_name = 'summary';
            $media_logClass = "getTVShowData";
            break;
        case "movie":
            $media_metadata_name = 'summary';
            $media_logClass = "getMovieData";
            break;
        case "track":
            $media_metadata_name = 'summary';
            $media_logClass = "getMusicData";
            break;
        default:
            $media_metadata_name = 'summary';
            $media_logClass = "getTVShowData";
    }

    $mediaSummary = $clients[$media_metadata_name];

    // $media_MetadataID_TMP = preg_split("#/#", $mediaSummary);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaSummary_MetadataID = $media_MetadataID;
    pmp_Logging("$media_logClass", "mediaSummary @ $mediaType ($media_metadata_name) $media_MetadataID_STR - \n $mediaSummary");
}

function plex_metadata_tagline($mediaType = "episode") {
    global $clients;
    global $mediaTagline, $mediaTagline_MetadataID;

    $media_MetadataID_STR = "";

    // Notes: TV Shows do not contain tagline

    // Tagline
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'tagline';
            $media_logClass = "getTVShowData";
            break;
        case "season":
            $media_metadata_name = 'tagline';
            $media_logClass = "getTVShowData";
            break;
        case "series":
            $media_metadata_name = 'tagline';
            $media_logClass = "getTVShowData";
            break;
        case "movie":
            $media_metadata_name = 'tagline';
            $media_logClass = "getMovieData";
            break;
        case "track":
            $media_metadata_name = 'tagline';
            $media_logClass = "getMusicData";
            break;
        default:
            $media_metadata_name = 'tagline';
            $media_logClass = "getTVShowData";
    }

    $mediaTagline = $clients[$media_metadata_name];

    // $media_MetadataID_TMP = preg_split("#/#", $mediaTagline);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaTagline_MetadataID = $media_MetadataID;
    pmp_Logging("$media_logClass", "mediaTagline @ $mediaType ($media_metadata_name) $media_MetadataID_STR - \n $mediaTagline");
}

function plex_metadata_art($mediaType = "episode") {
    global $clients;
    global $mediaArt, $mediaArt_MetadataID;

    $media_MetadataID_STR = "";

    // Art
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'art';
            $media_logClass = "getTVShowData";
            break;
        case "season":
            $media_metadata_name = 'art';
            $media_logClass = "getTVShowData";
            break;
        case "series":
            $media_metadata_name = 'art';
            $media_logClass = "getTVShowData";
            break;
        case "movie":
            $media_metadata_name = 'art';
            $media_logClass = "getMovieData";
            break;
        case "track":
            $media_metadata_name = 'art';
            $media_logClass = "getMusicData";
            break;
        default:
            $media_metadata_name = 'art';
            $media_logClass = "getTVShowData";
    }

    $mediaArt = $clients[$media_metadata_name];

    $media_MetadataID_TMP = preg_split("#/#", $mediaArt);
    $media_MetadataID = $media_MetadataID_TMP[3];
    $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    $mediaArt_MetadataID = $media_MetadataID;
    pmp_Logging("$media_logClass", "mediaArt @ $mediaType ($media_metadata_name) $media_MetadataID_STR - $mediaArt");
}

function plex_metadata_thumb($mediaType = "episode") {
    global $clients;
    global $mediaThumb, $mediaThumb_MetadataID;

    $media_MetadataID_STR = "";

    // Thumb
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'thumb';
            $media_logClass = "getTVShowData";
            break;
        case "season":
            $media_metadata_name = 'parentThumb';
            $media_logClass = "getTVShowData";
            break;
        case "series":
            $media_metadata_name = 'grandparentThumb';
            $media_logClass = "getTVShowData";
            break;
        case "movie":
            $media_metadata_name = 'thumb';
            $media_logClass = "getMovieData";
            break;
        case "track":
            $media_metadata_name = 'thumb'; // Track Thumb (Poster) (future - thumb, parentThumb (Album), grandparentThumb (Artist))
            $media_logClass = "getMusicData";

            $mediaThumb = $clients[$media_metadata_name];

            if ($mediaThumb == '') {
                $media_metadata_name = 'parentThumb';
                $mediaThumb = $clients[$media_metadata_name];
            }

            if ($mediaThumb == '') {
                $media_metadata_name = 'grandparentThumb';
                $mediaThumb = $clients[$media_metadata_name];
            }
            break;
        default:
            $media_metadata_name = 'thumb';
            $media_logClass = "getTVShowData";
    }

    $mediaThumb = $clients[$media_metadata_name];

    $media_MetadataID_TMP = preg_split("#/#", $mediaThumb);
    $media_MetadataID = $media_MetadataID_TMP[3];
    $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    $mediaThumb_MetadataID = $media_MetadataID;
    pmp_Logging("$media_logClass", "mediaTagline @ $mediaType ($media_metadata_name) $media_MetadataID_STR - $mediaThumb");
}

function plex_metadata_template($mediaType = "episode") {
    global $mediaTitle, $clients;

    // Template
    // switch ($mediaType) {
    //     case "episode":

    //         break;
    //     case "season":

    //         break;
    //     case "series":

    //         break;
    //     case "movie":

    //         break;
    //     default:

    // }
}

function plex_random_media($mediaAttempt = 0) {
    global $URLScheme, $plexServer, $comingSoonShowSelection, $plexToken;
    global $plexServerMovieSection, $plexServerMovieSections, $plexServerMovieSection_ID ;
    global $useSection, $xmlMedia, $viewGroup;

    pmp_Logging("getMediaURL", "\n"); // New Line
    pmp_Logging("getMediaURL", "plex_random_media (attempt): $mediaAttempt");

    $plexServerMovieSections = explode(",", $plexServerMovieSection);

    $ValidateSections = implode(",", $plexServerMovieSections);
    pmp_Logging("getMediaURL", "Library (Array Scan/ReScan): $ValidateSections");

    $useSection = rand(0, count($plexServerMovieSections) - 1);
    $plexServerMovieSection_ID = $plexServerMovieSections[$useSection];
    pmp_Logging("getMediaURL", "Library (ID): $plexServerMovieSection_ID");

    $MoviesURL = $URLScheme . '://' . $plexServer . ':32400/library/sections/' . $plexServerMovieSections[$useSection] . '/' . $comingSoonShowSelection . '?X-Plex-Token=' . $plexToken . '';
    pmp_Logging("getMediaURL", "$comingSoonShowSelection URL: $MoviesURL");

    $getMovies = file_get_contents($MoviesURL);
    $xmlMedia = simplexml_load_string($getMovies) or die("feed not loading");

    $viewGroup = $xmlMedia['viewGroup'];
    pmp_Logging("getMediaURL", "xml viewGroup: $viewGroup");

}

function plex_variable_presets($mode = "comingSoon") {
    $topSelection_test = ${$mode . "Top"};
    pmp_Logging("getMediaURL", "GenVar: $topSelection_test");
    // $autoScaleTop = $comingSoonTopAutoScale;
    // $topColor = $comingSoonTopFontColor;
    // $topSize = $comingSoonTopFontSize;
    // $topFontEnabled = $comingSoonTopFontEnabled;
    // $topFontID = $comingSoonTopFontID;

    // $bottomSelection = $comingSoonBottom;
    // $autoScaleBottom = $comingSoonBottomAutoScale;
    // $bottomColor = $comingSoonBottomFontColor;
    // $bottomSize = $comingSoonBottomFontSize;
    // $bottomFontEnabled = $comingSoonBottomFontEnabled;
    // $bottomFontID = $comingSoonBottomFontID;

    // $mediaArt_Status = $comingSoonBackgroundArt;
    // $mediaArt_ShowTVThumb = $comingSoonShowTVThumb;


}

function plex_getMedia_thumb() {
    // Media Thumb (Poster)
    global $URLScheme, $plexServer, $plexToken, $cachePath, $cacheEnabled; // Input Variables
    global $mediaThumb, $mediaThumb_MetadataID; // Input Variables
    global $mediaThumb_Display; // Output Variables

    // $mediaThumb_ID, $mediaThumb_CacheFileName, $mediaThumb_CacheFullName, $mediaThumb_URL, $mediaThumb_CacheURL; // Internal Variables

    // Check if the cache option is enabled, and if so set the name of the saved file and store in the designated cache path.
    if ($cacheEnabled) {
        $mediaThumb_ID = explode("/", $mediaThumb);
        $mediaThumb_ID = trim($mediaThumb_ID[count($mediaThumb_ID) - 1], '/');

        if (!isset($mediaThumb_MetadataID) || trim($mediaThumb_MetadataID) === '') {
            $mediaThumb_CacheFileName = $mediaThumb_ID;
        } else {
            $mediaThumb_CacheFileName = $mediaThumb_ID . "_" . $mediaThumb_MetadataID;
        }

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
    } else {
        // $mediaThumb_Display = "url('$URLScheme://$plexServer:32400$mediaThumb?X-Plex-Token=$plexToken')"; // Unsecure URL
        $mediaThumb_Display = "url('data:image/jpeg;base64,".getPoster($mediaThumb)."')"; // Secure URL
        // pmp_Logging("getMediaThumb", "mediaThumb (Display - Secure) - $mediaThumb_Display"); // DO NOT LOG SECURE URL - DATA UNUSABLE AND LOGS BECOME UNREADABLE
    }
}

function plex_getMedia_art() {
    // Media Art (Background)
    global $URLScheme, $plexServer, $plexToken, $cacheArtPath, $cacheEnabled; // Input Variables
    global $mediaArt, $mediaArt_MetadataID; // Input Variables
    global $mediaArt_Display; // Output Variables

    // $mediaArt_ID, $mediaArt_CacheFileName, $mediaArt_CacheFullName, $mediaArt_URL, $mediaArt_CacheURL; // Internal Variables

    // Check if the cache option is enabled, and if so set the name of the saved file and store in the designated cache path.
    if ($cacheEnabled) {
        $mediaArt_ID = explode("/", $mediaArt);
        $mediaArt_ID = trim($mediaArt_ID[count($mediaArt_ID) - 1], '/');

        // If there is no mediaArt then the media art will be skipped, and background will revert to default.
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
         // $mediaArt_Display = "url('$URLScheme://$plexServer:32400$mediaArt?X-Plex-Token=$plexToken')"; // Unsecure URL
         $mediaArt_Display = "url('data:image/jpeg;base64,".getPoster($mediaArt)."')"; // Secure URL
         // pmp_Logging("getMediaArt", "mediaArt (Display - Secure) - $mediaArt_Display"); // DO NOT LOG SECURE URL - DATA UNUSABLE AND LOGS BECOME UNREADABLE
    }
}

?>
