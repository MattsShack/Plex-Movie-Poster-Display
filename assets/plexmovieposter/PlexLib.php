<?php

//  NEED TO SUPPORT "movie" and "show" as well as "clients"

function plex_metadata_base($mediaType = "episode", $mediaLogMode = "") {

    switch ($mediaType) {
        case "episode":
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "season":
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "series":
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "movie":
            $media_logClass = "PLEX_getMovieMetadata";
            break;
        case "track":
            $media_logClass = "PLEX_getMusicMetadata";
            break;
        default:
            $media_logClass = "PLEX_getMediaMetadata";
            break;
    }

    switch ($mediaLogMode) {
        case "START":
            pmp_Logging("$media_logClass", "\n--- Media START Point ---");
            break;
        case "END":
            pmp_Logging("$media_logClass", "---  Media END Point  ---");
            break;
        default:
            pmp_Logging("$media_logClass", "---  Media TBD Point  ---");
            break;
    }

}

function plex_metadata_title($mediaType = "episode") {
    global $clients;
    global $mediaTitle, $mediaTitle_MetadataID;

    $media_MetadataID_STR = "";

    // Title
    switch ($mediaType) {
        case "episode":
            $media_logClass = "PLEX_getTVMetadata";
            $media_metadata_name = 'title';
            break;
        case "season":
            $media_logClass = "PLEX_getTVMetadata";
            $media_metadata_name = 'parentTitle';
            break;
        case "series":
            $media_logClass = "PLEX_getTVMetadata";
            $media_metadata_name = 'grandparentTitle';
            break;
        case "movie":
            $media_logClass = "PLEX_getMovieMetadata";
            $media_metadata_name = 'title';
            break;
        case "track":
            $media_logClass = "PLEX_getMusicMetadata";
            $media_metadata_name = 'title'; // Track Title (future - title, parentTitle (Album), grandparentTitle (Artist))
            break;
        default:
            $media_logClass = "PLEX_getTVMetadata";
            $media_metadata_name = 'title';
    }

    $mediaTitle = $clients[$media_metadata_name];

    // $media_MetadataID_TMP = preg_split("#/#", $mediaTitle);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaTitle_MetadataID = $media_MetadataID;
    pmp_Logging("$media_logClass", "\tmediaTitle @ $mediaType ($media_metadata_name) $media_MetadataID_STR - $mediaTitle");
}

function plex_metadata_summary($mediaType = "episode") {
    global $clients;
    global $mediaSummary, $mediaSummary_MetadataID;

    $media_MetadataID_STR = "";

    // Summary
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'summary';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "season":
            $media_metadata_name = 'summary';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "series":
            $media_metadata_name = 'summary';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "movie":
            $media_metadata_name = 'summary';
            $media_logClass = "PLEX_getMovieMetadata";
            break;
        case "track":
            $media_metadata_name = 'summary';
            $media_logClass = "PLEX_getMusicMetadata";
            break;
        default:
            $media_metadata_name = 'summary';
            $media_logClass = "PLEX_getTVMetadata";
    }

    $mediaSummary = $clients[$media_metadata_name];

    // $media_MetadataID_TMP = preg_split("#/#", $mediaSummary);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaSummary_MetadataID = $media_MetadataID;
    pmp_Logging("$media_logClass", "\tmediaSummary @ $mediaType ($media_metadata_name) $media_MetadataID_STR - \n $mediaSummary");
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
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "season":
            $media_metadata_name = 'tagline';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "series":
            $media_metadata_name = 'tagline';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "movie":
            $media_metadata_name = 'tagline';
            $media_logClass = "PLEX_getMovieMetadata";
            break;
        case "track":
            $media_metadata_name = 'tagline';
            $media_logClass = "PLEX_getMusicMetadata";
            break;
        default:
            $media_metadata_name = 'tagline';
            $media_logClass = "PLEX_getTVMetadata";
    }

    $mediaTagline = $clients[$media_metadata_name];

    // $media_MetadataID_TMP = preg_split("#/#", $mediaTagline);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaTagline_MetadataID = $media_MetadataID;
    pmp_Logging("$media_logClass", "\tmediaTagline @ $mediaType ($media_metadata_name) $media_MetadataID_STR - \n $mediaTagline");
}

function plex_metadata_art($mediaType = "episode") {
    global $clients;
    global $mediaArt, $mediaArt_MetadataID;

    $media_MetadataID_STR = "";

    // Art
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'art';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "season":
            $media_metadata_name = 'art';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "series":
            $media_metadata_name = 'art';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "movie":
            $media_metadata_name = 'art';
            $media_logClass = "PLEX_getMovieMetadata";
            break;
        case "track":
            $media_metadata_name = 'art';
            $media_logClass = "PLEX_getMusicMetadata";
            break;
        default:
            $media_metadata_name = 'art';
            $media_logClass = "PLEX_getTVMetadata";
    }

    $mediaArt = $clients[$media_metadata_name];

    $media_MetadataID_TMP = preg_split("#/#", $mediaArt);
    $media_MetadataID = $media_MetadataID_TMP[3];
    $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    $mediaArt_MetadataID = $media_MetadataID;
    pmp_Logging("$media_logClass", "\tmediaArt @ $mediaType ($media_metadata_name) $media_MetadataID_STR - $mediaArt");
}

function plex_metadata_contentRating($mediaType = "episode") {
    global $clients;
    global $mediaContentRating, $mediaContentRating_MetadataID;

    $media_MetadataID_STR = "";

    // Notes:

    // contentRating
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'contentRating';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "season":
            $media_metadata_name = 'contentRating';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "series":
            $media_metadata_name = 'contentRating';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "movie":
            $media_metadata_name = 'contentRating';
            $media_logClass = "PLEX_getMovieMetadata";
            break;
        case "track":
            $media_metadata_name = 'contentRating';
            $media_logClass = "PLEX_getMusicMetadata";
            break;
        default:
            $media_metadata_name = 'contentRating';
            $media_logClass = "PLEX_getTVMetadata";
    }

    $mediaContentRating = $clients[$media_metadata_name];

    // $media_MetadataID_TMP = preg_split("#/#", $mediaContentRating);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaContentRating_MetadataID = $media_MetadataID;
    pmp_Logging("$media_logClass", "\tmediaContentRating @ $mediaType ($media_metadata_name) - \"$mediaContentRating\"");
}

function plex_metadata_decision($mediaType = "episode", $isPlayingMode = FALSE) {
    global $clients, $isPlaying;
    global $mediaDecision, $mediaDecision_MetadataID;

    $media_MetadataID_STR = "";

    // Notes: decision -> directplay/transcode
    // DirectPlay/Transcode (Only for Playing)

    // contentRating
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'decision';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "season":
            $media_metadata_name = 'decision';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "series":
            $media_metadata_name = 'decision';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "movie":
            $media_metadata_name = 'decision';
            $media_logClass = "PLEX_getMovieMetadata";
            break;
        case "track":
            $media_metadata_name = 'decision';
            $media_logClass = "PLEX_getMusicMetadata";
            break;
        default:
            $media_metadata_name = 'decision';
            $media_logClass = "PLEX_getTVMetadata";
    }

    if ($isPlayingMode == TRUE) {
        $mediaDecision = $clients->Media->Part[$media_metadata_name];
    }
    else {
        $mediaDecision = "N/A";
    }

    // $media_MetadataID_TMP = preg_split("#/#", $mediaDecision);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaDecision_MetadataID = $media_MetadataID;
    pmp_Logging("$media_logClass", "\tmediaDecision @ $mediaType ($media_metadata_name) - \"$mediaDecision\"");
}

function plex_metadata_audioCodec($mediaType = "episode", $isPlayingMode = FALSE) {
    global $clients, $isPlaying;
    global $mediaAudioCodec, $mediaAudioCodec_MetadataID;

    $media_MetadataID_STR = "";

    // Notes: audioCodec
    //

    // Audio Codec
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'audioCodec';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "season":
            $media_metadata_name = 'audioCodec';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "series":
            $media_metadata_name = 'audioCodec';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "movie":
            $media_metadata_name = 'audioCodec';
            $media_logClass = "PLEX_getMovieMetadata";
            break;
        case "track":
            $media_metadata_name = 'audioCodec';
            $media_logClass = "PLEX_getMusicMetadata";
            break;
        default:
            $media_metadata_name = 'audioCodec';
            $media_logClass = "PLEX_getTVMetadata";
    }

    // if ($isPlayingMode == TRUE) {
        $mediaAudioCodec = $clients->Media[$media_metadata_name];
    // }
    // else {
        // $mediaAudioCodec = "N/A";
    // }

    // $media_MetadataID_TMP = preg_split("#/#", $mediaAudioCodec);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaAudioCodec_MetadataID = $media_MetadataID;
    pmp_Logging("$media_logClass", "\tmediaAudioCodec @ $mediaType ($media_metadata_name) - \"$mediaAudioCodec\"");
}

function plex_metadata_audioChannelLayout($mediaType = "episode", $isPlayingMode = FALSE) {
    global $clients, $isPlaying;
    global $mediaAudioChannelLayout, $mediaAudioChannelLayout_MetadataID;

    $media_MetadataID_STR = "";

    // Notes: audioChannelLayout
    //

    // Audio Codec
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'audioChannelLayout';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "season":
            $media_metadata_name = 'audioChannelLayout';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "series":
            $media_metadata_name = 'audioChannelLayout';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "movie":
            $media_metadata_name = 'audioChannelLayout';
            $media_logClass = "PLEX_getMovieMetadata";
            break;
        case "track":
            $media_metadata_name = 'audioChannelLayout';
            $media_logClass = "PLEX_getMusicMetadata";
            break;
        default:
            $media_metadata_name = 'audioChannelLayout';
            $media_logClass = "PLEX_getTVMetadata";
    }

    // if ($isPlayingMode == TRUE) {
        $rootElement = $clients->Media->Part->Stream[0];
        $mediaAudioChannelLayout = $rootElement[$media_metadata_name];
    // }
    // else {
        // $mediaAudioChannelLayout = "N/A";
    // }

    // $media_MetadataID_TMP = preg_split("#/#", $mediaAudioChannelLayout);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaAudioChannelLayout_MetadataID = $media_MetadataID;
    pmp_Logging("$media_logClass", "\tmediaAudioChannelLayout @ $mediaType ($media_metadata_name) - \"$mediaAudioChannelLayout\"");
}

function plex_metadata_videoCodec($mediaType = "episode", $isPlayingMode = FALSE) {
    global $clients, $isPlaying;
    global $mediaVideoCodec, $mediaVideoCodec_MetadataID;

    $media_MetadataID_STR = "";

    // Notes: videoCodec
    //

    // contentRating
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'videoCodec';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "season":
            $media_metadata_name = 'videoCodec';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "series":
            $media_metadata_name = 'videoCodec';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "movie":
            $media_metadata_name = 'videoCodec';
            $media_logClass = "PLEX_getMovieMetadata";
            break;
        case "track":
            $media_metadata_name = 'videoCodec';
            $media_logClass = "PLEX_getMusicMetadata";
            break;
        default:
            $media_metadata_name = 'videoCodec';
            $media_logClass = "PLEX_getTVMetadata";
    }

    // if ($isPlayingMode == TRUE) {
        $mediaVideoCodec = $clients->Media[$media_metadata_name];
    // }
    // else {
        // $mediaVideoCodec = "N/A";
    // }

    // $media_MetadataID_TMP = preg_split("#/#", $mediaVideoCodec);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaVideoCodec_MetadataID = $media_MetadataID;
    pmp_Logging("$media_logClass", "\tmediaVideoCodec @ $mediaType ($media_metadata_name) - \"$mediaVideoCodec\"");
}

function plex_metadata_videoResolution($mediaType = "episode", $isPlayingMode = FALSE) {
    global $clients, $isPlaying;
    global $mediaVideoResolution, $mediaVideoResolution_MetadataID;

    $media_MetadataID_STR = "";

    // Notes: videoResolution
    //

    // videoResolution
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'videoResolution';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "season":
            $media_metadata_name = 'videoResolution';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "series":
            $media_metadata_name = 'videoResolution';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "movie":
            $media_metadata_name = 'videoResolution';
            $media_logClass = "PLEX_getMovieMetadata";
            break;
        case "track":
            $media_metadata_name = 'videoResolution';
            $media_logClass = "PLEX_getMusicMetadata";
            break;
        default:
            $media_metadata_name = 'videoResolution';
            $media_logClass = "PLEX_getTVMetadata";
    }

    // if ($isPlayingMode == TRUE) {
        $mediaVideoResolution = $clients->Media[$media_metadata_name];
    // }
    // else {
        // $mediaVideoResolution = "N/A";
    // }

    // $media_MetadataID_TMP = preg_split("#/#", $mediaVideoResolution);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaVideoResolution_MetadataID = $media_MetadataID;
    pmp_Logging("$media_logClass", "\tmediaVideoResolution @ $mediaType ($media_metadata_name) - \"$mediaVideoResolution\"");
}

function plex_metadata_audioDisplay($mediaType = "episode", $isPlayingMode = FALSE) {
    global $clients, $isPlaying;
    global $mediaAudioDisplay, $mediaAudioDisplay_MetadataID;

    $media_MetadataID_STR = "";

    // Notes:
    //

    // contentRating
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'displayTitle';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "season":
            $media_metadata_name = 'displayTitle';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "series":
            $media_metadata_name = 'displayTitle';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "movie":
            $media_metadata_name = 'displayTitle';
            $media_logClass = "PLEX_getMovieMetadata";
            break;
        case "track":
            $media_metadata_name = 'displayTitle';
            $media_logClass = "PLEX_getMusicMetadata";
            break;
        default:
            $media_metadata_name = 'displayTitle';
            $media_logClass = "PLEX_getTVMetadata";
    }

    if ($isPlayingMode == TRUE) {
        $rootElement = $clients->Media->Part->Stream[1];
        $mediaAudioDisplay = $rootElement[$media_metadata_name];
    }
    else {
        $mediaAudioDisplay = "N/A";
    }

    // $media_MetadataID_TMP = preg_split("#/#", $mediaAudioDisplay);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaAudioDisplay_MetadataID = $media_MetadataID;
    pmp_Logging("$media_logClass", "\tmediaAudioDisplay @ $mediaType ($media_metadata_name) - \"$mediaAudioDisplay\"");
}

function plex_metadata_videoDisplay($mediaType = "episode", $isPlayingMode = FALSE) {
    global $clients, $isPlaying;
    global $mediaVideoDisplay, $mediaVideoDisplay_MetadataID;

    $media_MetadataID_STR = "";

    // Notes:
    //

    // contentRating
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'displayTitle';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "season":
            $media_metadata_name = 'displayTitle';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "series":
            $media_metadata_name = 'displayTitle';
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "movie":
            $media_metadata_name = 'displayTitle';
            $media_logClass = "PLEX_getMovieMetadata";
            break;
        case "track":
            $media_metadata_name = 'displayTitle';
            $media_logClass = "PLEX_getMusicMetadata";
            break;
        default:
            $media_metadata_name = 'displayTitle';
            $media_logClass = "PLEX_getTVMetadata";
    }

    if ($isPlayingMode == TRUE) {
        $rootElement = $clients->Media->Part->Stream[0];
        $mediaVideoDisplay = $rootElement[$media_metadata_name];
    }
    else {
        $mediaVideoDisplay = "N/A";
    }

    // $media_MetadataID_TMP = preg_split("#/#", $mediaVideoDisplay);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaVideoDisplay_MetadataID = $media_MetadataID;
    pmp_Logging("$media_logClass", "\tmediaVideoDisplay @ $mediaType ($media_metadata_name) - \"$mediaVideoDisplay\"");
}

function plex_metadata_thumb($mediaType = "episode", $ComingSoonMode = FALSE) {
    global $clients, $comingSoonShowSelection;
    global $mediaThumb, $mediaThumb_MetadataID;

    $media_MetadataID_STR = "";

    // Thumb
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'thumb';
            $media_logClass = "PLEX_getTVMetadata";

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
        case "season":
            $media_logClass = "PLEX_getTVMetadata";

            if ($ComingSoonMode == TRUE) {
                switch ($comingSoonShowSelection) {
                    case "all":
                        $media_metadata_name = 'thumb';
                        break;
                    case "unwatched":
                        $media_metadata_name = 'thumb';
                        break;
                    // case "newest":
                        // break;
                    // case "recentlyAdded":
                        // break;
                    default:
                        $media_metadata_name = 'parentThumb';
                        $mediaThumb = $clients[$media_metadata_name];

                        if ($mediaThumb == '') {
                            $media_metadata_name = 'grandparentThumb';
                            $mediaThumb = $clients[$media_metadata_name];
                        }
                }
            }
            else {
                $media_metadata_name = 'parentThumb';
                $mediaThumb = $clients[$media_metadata_name];

                if ($mediaThumb == '') {
                    $media_metadata_name = 'grandparentThumb';
                    $mediaThumb = $clients[$media_metadata_name];
                }
            }
            break;
        case "series":
            $media_logClass = "PLEX_getTVMetadata";

            if ($ComingSoonMode == TRUE) {
                switch ($comingSoonShowSelection) {
                    case "all":
                        $media_metadata_name = 'thumb';
                        break;
                    case "unwatched":
                        $media_metadata_name = 'thumb';
                        break;
                    // case "newest":
                        // break;
                    // case "recentlyAdded":
                        // break;
                    default:
                        $media_metadata_name = 'grandparentThumb';
                }
            }
            else {
                $media_metadata_name = 'grandparentThumb';
            }
            break;
        case "movie":
            $media_logClass = "PLEX_getMovieMetadata";
            $media_metadata_name = 'thumb';

            break;
        case "track":
            $media_logClass = "PLEX_getMusicMetadata";

            $media_metadata_name = 'thumb'; // Track Thumb (Poster) (future - thumb, parentThumb (Album), grandparentThumb (Artist))
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
            $media_logClass = "PLEX_getTVMetadata";
    }

    $mediaThumb = $clients[$media_metadata_name];

    $media_MetadataID_TMP = preg_split("#/#", $mediaThumb);
    $media_MetadataID = $media_MetadataID_TMP[3];
    $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    $mediaThumb_MetadataID = $media_MetadataID;
    pmp_Logging("$media_logClass", "\tmediaTagline @ $mediaType ($media_metadata_name) $media_MetadataID_STR - $mediaThumb");
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

    pmp_Logging("PLEX_getMediaMetadata", "\n"); // New Line
    pmp_Logging("PLEX_getMediaMetadata", "plex_random_media (attempt): $mediaAttempt");

    $plexServerMovieSections = explode(",", $plexServerMovieSection);

    $ValidateSections = implode(",", $plexServerMovieSections);
    pmp_Logging("PLEX_getMediaMetadata", "Library (Array Scan/ReScan): $ValidateSections");

    $useSection = rand(0, count($plexServerMovieSections) - 1);
    $plexServerMovieSection_ID = $plexServerMovieSections[$useSection];
    pmp_Logging("PLEX_getMediaMetadata", "Library (ID): $plexServerMovieSection_ID");

    $MoviesURL = $URLScheme . '://' . $plexServer . ':32400/library/sections/' . $plexServerMovieSections[$useSection] . '/' . $comingSoonShowSelection . '?X-Plex-Token=' . $plexToken . '';
    pmp_Logging("PLEX_getMediaMetadata", "$comingSoonShowSelection URL: $MoviesURL");

    $getMovies = file_get_contents($MoviesURL);
    $xmlMedia = simplexml_load_string($getMovies) or die("feed not loading");

    $viewGroup = $xmlMedia['viewGroup'];
    pmp_Logging("PLEX_getMediaMetadata", "xml viewGroup: $viewGroup");

}

function plex_variable_presets($mode = "comingSoon") {
    $topSelection_test = ${$mode . "Top"};
    pmp_Logging("PLEX_getMediaMetadata", "GenVar: $topSelection_test");
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

    $mediaThumb_Display = "";

    // $mediaThumb_ID, $mediaThumb_CacheFileName, $mediaThumb_CacheFullName, $mediaThumb_URL, $mediaThumb_CacheURL; // Internal Variables

    // Check if the cache option is enabled, and if so set the name of the saved file and store in the designated cache path.
    if ($cacheEnabled) {
        $mediaThumb_ID = explode("/", $mediaThumb);
        $mediaThumb_ID = trim($mediaThumb_ID[count($mediaThumb_ID) - 1], '/');

        if (!isset($mediaThumb_MetadataID) || trim($mediaThumb_MetadataID) === '') {
            $mediaThumb_CacheFileName = $mediaThumb_ID . ".jpeg";
        } else {
            $mediaThumb_CacheFileName = $mediaThumb_ID . "_" . $mediaThumb_MetadataID . ".jpeg";
        }

        $mediaThumb_CacheFullName = join('/', array(trim($cachePath, '/'), trim($mediaThumb_CacheFileName, '/')));
        pmp_Logging("PLEX_getMediaFile", "Cache File @ Output (mediaThumb) - $mediaThumb_CacheFullName");

        $mediaThumb_URL = "$URLScheme://$plexServer:32400$mediaThumb?X-Plex-Token=$plexToken";
        pmp_Logging("PLEX_getMediaFile", "$mediaThumb_ID ($cachePath) - $mediaThumb_URL");

        // There's nothing else to do here, just save it
        if (!file_exists($mediaThumb_CacheFullName)) {
            file_put_contents("$mediaThumb_CacheFullName", fopen("$mediaThumb_URL", 'r'));
        }

        $mediaThumb_CacheURL = $mediaThumb_CacheFullName;

        $mediaThumb_Display = "url('data:image/jpeg;base64,".getCachePoster($mediaThumb_CacheURL)."')"; // Secure URL
        // pmp_Logging("PLEX_getMediaFile", "mediaThumb (Display - Secure) - $mediaThumb_Display"); // DO NOT LOG SECURE URL - DATA UNUSABLE AND LOGS BECOME UNREADABLE

        if ((strpos($mediaThumb_Display, "InvalidImage") !== FALSE) || ($mediaThumb_Display == "")) {
            $mediaThumb_Display = "url('$mediaThumb_CacheURL')"; // Unsecure URL
            // pmp_Logging("PLEX_getMediaFile", "mediaThumb (Display - Unsecure) - $mediaThumb_Display"); // DO NOT LOG UNSECURE URL - DATA IS NOT ENCRYPTED
            pmp_Logging("PLEX_getMediaFile", "mediaThumb (Display - Unsecure - Cache) - FailOver");

            if ($mediaThumb_Display == "") {
                pmp_Logging("PLEX_getMediaFile", "mediaThumb (Display - Unsecure - Cache) - BLANK");
            }
        }

    } else {
        $mediaThumb_Display = "url('data:image/jpeg;base64,".getPoster($mediaThumb)."')"; // Secure URL
        // pmp_Logging("PLEX_getMediaFile", "mediaThumb (Display - Secure) - $mediaThumb_Display"); // DO NOT LOG SECURE URL - DATA UNUSABLE AND LOGS BECOME UNREADABLE

        if ((strpos($mediaThumb_Display, "InvalidImage") !== FALSE) || ($mediaThumb_Display == "")) {
            $mediaThumb_Display = "url('$URLScheme://$plexServer:32400$mediaThumb?X-Plex-Token=$plexToken')"; // Unsecure URL
            // pmp_Logging("PLEX_getMediaFile", "mediaThumb (Display - Unsecure) - $mediaThumb_Display"); // DO NOT LOG UNSECURE URL - DATA IS NOT ENCRYPTED
            pmp_Logging("PLEX_getMediaFile", "mediaThumb (Display - Unsecure - No Cache) - FailOver");

            if ($mediaThumb_Display == "") {
                pmp_Logging("PLEX_getMediaFile", "mediaThumb (Display - Unsecure - No Cache) - BLANK");
            }
        }
    }
}

function plex_getMedia_art() {
    // Media Art (Background)
    global $URLScheme, $plexServer, $plexToken, $cacheArtPath, $cacheEnabled; // Input Variables
    global $mediaArt, $mediaArt_MetadataID; // Input Variables
    global $mediaArt_Display; // Output Variables

    $mediaArt_Display = "";

    // $mediaArt_ID, $mediaArt_CacheFileName, $mediaArt_CacheFullName, $mediaArt_URL, $mediaArt_CacheURL; // Internal Variables

    // Check if the cache option is enabled, and if so set the name of the saved file and store in the designated cache path.
    if ($cacheEnabled) {
        $mediaArt_ID = explode("/", $mediaArt);
        $mediaArt_ID = trim($mediaArt_ID[count($mediaArt_ID) - 1], '/');

        // If there is no mediaArt then the media art will be skipped, and background will revert to default.
        if (isset($mediaArt_ID) && trim($mediaArt_ID) != '') {
            if (!isset($mediaArt_MetadataID) || trim($mediaArt_MetadataID) === '') {
                $mediaArt_CacheFileName = $mediaArt_ID . ".jpeg";
            } else {
                $mediaArt_CacheFileName = $mediaArt_ID . "_" . $mediaArt_MetadataID . ".jpeg";
            }

            $mediaArt_CacheFullName = join('/', array(trim($cacheArtPath, '/'), trim($mediaArt_CacheFileName, '/')));
            pmp_Logging("PLEX_getMediaFile", "Cache File @ Output (mediaArt) - $mediaArt_CacheFullName");

            $mediaArt_URL = "$URLScheme://$plexServer:32400$mediaArt?X-Plex-Token=$plexToken";
            pmp_Logging("PLEX_getMediaFile", "$mediaArt_ID ($cacheArtPath) - $mediaArt_URL");

            // There's nothing else to do here, just save it
            if (!file_exists($mediaArt_CacheFullName)) {
                file_put_contents("$mediaArt_CacheFullName", fopen("$mediaArt_URL", 'r'));
            }

            $mediaArt_CacheURL = $mediaArt_CacheFullName;

            $mediaArt_Display = "url('data:image/jpeg;base64,".getCachePoster($mediaArt_CacheURL)."')"; // Secure URL
            // pmp_Logging("PLEX_getMediaFile", "mediaArt (Display - Secure) - $mediaArt_Display"); // DO NOT LOG SECURE URL - DATA UNUSABLE AND LOGS BECOME UNREADABLE

            if ((strpos($mediaArt_Display, "InvalidImage") !== FALSE) || ($mediaArt_Display == "")) {
                $mediaArt_Display = "url('$mediaArt_CacheURL')"; // Unsecure URL
                // pmp_Logging("PLEX_getMediaFile", "mediaArt (Display - Unsecure) - $mediaArt_Display"); // DO NOT LOG UNSECURE URL - DATA IS NOT ENCRYPTED
                pmp_Logging("PLEX_getMediaFile", "mediaArt (Display - Unsecure - Cache) - FailOver");

                if ($mediaArt_Display == "") {
                    pmp_Logging("PLEX_getMediaFile", "mediaArt (Display - Unsecure - Cache) - BLANK");
                }
            }
        }
    } else {
         $mediaArt_Display = "url('data:image/jpeg;base64,".getPoster($mediaArt)."')"; // Secure URL
         // pmp_Logging("PLEX_getMediaFile", "mediaArt (Display - Secure) - $mediaArt_Display"); // DO NOT LOG SECURE URL - DATA UNUSABLE AND LOGS BECOME UNREADABLE

         if ((strpos($mediaArt_Display, "InvalidImage") !== FALSE) || ($mediaArt_Display == "")) {
            $mediaArt_Display = "url('$URLScheme://$plexServer:32400$mediaArt?X-Plex-Token=$plexToken')"; // Unsecure URL
            // pmp_Logging("PLEX_getMediaFile", "mediaArt (Display - Unsecure) - $mediaArt_Display"); // DO NOT LOG UNSECURE URL - DATA IS NOT ENCRYPTED
            pmp_Logging("PLEX_getMediaFile", "mediaArt (Display - Unsecure - No Cache) - FailOver");

            if ($mediaArt_Display == "") {
                pmp_Logging("PLEX_getMediaFile", "mediaArt (Display - Unsecure - No Cache) - BLANK");
            }
        }
    }
}

function plex_webhook_decode() {
    global $plex_webhook_data_raw, $plex_webhook_data_json; // Input Variables
    // global ; // Output Variables

    $plex_webhook_data_json = json_decode($plex_webhook_data_raw,true);

    plex_webhook_json_HEAD();

    plex_webhook_json_ACCOUNT();

    plex_webhook_json_SERVER();

    plex_webhook_json_PLAYER();

    plex_webhook_json_METADATA();

    pmp_Logging("PLEX_WebHookData", "$plex_webhook_data_raw");
}

function plex_webhook_json_HEAD() {
    // Head
    global $plex_webhook_data_raw, $plex_webhook_data_json; // Input Variables

    global $pwhd_event, $pwhd_user, $pwhd_owner; // Output Variables

    $pwhd_event = $plex_webhook_data_json["event"];
    $pwhd_user = $plex_webhook_data_json["user"];
    $pwhd_owner = $plex_webhook_data_json["owner"];
}

function plex_webhook_json_ACCOUNT() {
    // Account
    global $plex_webhook_data_raw, $plex_webhook_data_json; // Input Variables

    global $pwhd_Account_id, $pwhd_Account_thumb, $pwhd_Account_title; // Output Variables

    $pwhd_Account_id = $plex_webhook_data_json["Account"]["id"];
    $pwhd_Account_thumb = $plex_webhook_data_json["Account"]["thumb"];
    $pwhd_Account_title = $plex_webhook_data_json["Account"]["title"];
}

function plex_webhook_json_SERVER() {
     // Server
     global $plex_webhook_data_raw, $plex_webhook_data_json; // Input Variables

     global $pwhd_Server_title, $pwhd_Server_uuid; // Output Variables

     $pwhd_Server_title = $plex_webhook_data_json["Server"]["title"];
     $pwhd_Server_uuid = $plex_webhook_data_json["Server"]["uuid"];
}

function plex_webhook_json_PLAYER() {
    // Player
    global $plex_webhook_data_raw, $plex_webhook_data_json; // Input Variables

    global $pwhd_Player_local, $pwhd_Player_publicAddress, $pwhd_Player_title, $pwhd_Player_uuid; // Output Variables

    $pwhd_Player_local = $plex_webhook_data_json["Player"]["local"];
    $pwhd_Player_publicAddress = $plex_webhook_data_json["Player"]["publicAddress"];
    $pwhd_Player_title = $plex_webhook_data_json["Player"]["title"];
    $pwhd_Player_uuid = $plex_webhook_data_json["Player"]["uuid"];
}

function plex_webhook_json_METADATA() {
   // Metadata
   global $plex_webhook_data_raw, $plex_webhook_data_json; // Input Variables

   global $pwhd_Metadata_librarySectionType, $pwhd_Metadata_ratingKey, $pwhd_Metadata_key, $pwhd_Metadata_parentRatingKey, $pwhd_Metadata_grandparentRatingKey; // Output Variables

   $pwhd_Metadata_librarySectionType = $plex_webhook_data_json["Metadata"]["librarySectionType"];
   $pwhd_Metadata_ratingKey = $plex_webhook_data_json["Metadata"]["ratingKey"];
   $pwhd_Metadata_key = $plex_webhook_data_json["Metadata"]["key"];
   $pwhd_Metadata_parentRatingKey = $plex_webhook_data_json["Metadata"]["parentRatingKey"];
   $pwhd_Metadata_grandparentRatingKey = $plex_webhook_data_json["Metadata"]["grandparentRatingKey"];

   global $pwhd_Metadata_guid, $pwhd_Metadata_librarySectionID, $pwhd_Metadata_type, $pwhd_Metadata_title, $pwhd_Metadata_grandparentKey; // Output Variables

   $pwhd_Metadata_guid = $plex_webhook_data_json["Metadata"]["guid"];
   $pwhd_Metadata_librarySectionID = $plex_webhook_data_json["Metadata"]["librarySectionID"];
   $pwhd_Metadata_type = $plex_webhook_data_json["Metadata"]["type"];
   $pwhd_Metadata_title = $plex_webhook_data_json["Metadata"]["title"];
   $pwhd_Metadata_grandparentKey = $plex_webhook_data_json["Metadata"]["grandparentKey"];

   global $pwhd_Metadata_parentKey, $pwhd_Metadata_grandparentTitle, $pwhd_Metadata_parentTitle, $pwhd_Metadata_summary, $pwhd_Metadata_index; // Output Variables

   $pwhd_Metadata_parentKey = $plex_webhook_data_json["Metadata"]["parentKey"];
   $pwhd_Metadata_grandparentTitle = $plex_webhook_data_json["Metadata"]["grandparentTitle"];
   $pwhd_Metadata_parentTitle = $plex_webhook_data_json["Metadata"]["parentTitle"];
   $pwhd_Metadata_summary = $plex_webhook_data_json["Metadata"]["summary"];
   $pwhd_Metadata_index = $plex_webhook_data_json["Metadata"]["index"];

   global $pwhd_Metadata_parentIndex, $pwhd_Metadata_ratingCount, $pwhd_Metadata_thumb, $pwhd_Metadata_art, $pwhd_Metadata_parentThumb; // Output Variables

   $pwhd_Metadata_parentIndex = $plex_webhook_data_json["Metadata"]["parentIndex"];
   $pwhd_Metadata_ratingCount = $plex_webhook_data_json["Metadata"]["ratingCount"];
   $pwhd_Metadata_thumb = $plex_webhook_data_json["Metadata"]["thumb"];
   $pwhd_Metadata_art = $plex_webhook_data_json["Metadata"]["art"];
   $pwhd_Metadata_parentThumb = $plex_webhook_data_json["Metadata"]["parentThumb"];

   global $pwhd_Metadata_grandparentThumb, $pwhd_Metadata_grandparentArt, $pwhd_Metadata_addedAt, $pwhd_Metadata_updatedAt; // Output Variables

   $pwhd_Metadata_grandparentThumb = $plex_webhook_data_json["Metadata"]["grandparentThumb"];
   $pwhd_Metadata_grandparentArt = $plex_webhook_data_json["Metadata"]["grandparentArt"];
   $pwhd_Metadata_addedAt = $plex_webhook_data_json["Metadata"]["addedAt"];
   $pwhd_Metadata_updatedAt = $plex_webhook_data_json["Metadata"]["updatedAt"];
}

function plex_isPlaying_dataProcess() {
    // Global Variables - Input
    global $clients, $plexClient, $plexClientName;
    global $data;

    // Global Variables - Output
    global $PLEX_PlayerAddress, $PLEX_Client_ARR;
    global $PLEX_PlayerTitle, $PLEX_ClientName_ARR;

    $PLEX_PlayerAddress = $clients->Player['address'];
    $PLEX_Client_ARR = preg_split("#,#", $plexClient); // Split defined client IP address(s) (coma delimited array)

    $PLEX_PlayerTitle = $clients->Player['title'];
    $PLEX_ClientName_ARR = preg_split("#,#", $plexClientName); // Split defined client name(s) (coma delimited array)

    pmp_Logging("PLEX_getMediaMetadata", "plex_isPlaying_dataProcess @ $PLEX_Client_ARR[0] - Test");
}

function plex_metadata_PROCESS() {
    // Global Variables - Input
    global $isPlaying, $clients;
    global $mediaType_Display, $elementType, $mediaType;
    global $isPlayingMode, $ComingSoonMode;

    if ($isPlaying == TRUE) {
        $isPlayingMode = TRUE;
        $ComingSoonMode = FALSE;
    }
    else {
        $isPlayingMode = FALSE;
        $ComingSoonMode = TRUE;
    }

    plex_metadata_base("$mediaType", "START");

    plex_metadata_title("$mediaType");
    plex_metadata_summary("$mediaType");
    plex_metadata_tagline("$mediaType");
    plex_metadata_thumb("$mediaType", $ComingSoonMode); // COMING SOON MODE
    plex_metadata_art("$mediaType");
    plex_metadata_contentRating("$mediaType");
    plex_metadata_audioCodec("$mediaType");
    plex_metadata_audioChannelLayout("$mediaType");
    plex_metadata_videoCodec("$mediaType");
    plex_metadata_videoResolution("$mediaType");

    if ($isPlaying == TRUE) {
        plex_metadata_decision("$mediaType", $isPlayingMode); // isPlaying Mode
        plex_metadata_audioDisplay("$mediaType", $isPlayingMode); // isPlaying Mode
        plex_metadata_videoDisplay("$mediaType", $isPlayingMode); // isPlaying Mode
    }

    plex_metadata_base("$mediaType", "END");
}

function plex_metadata_viewGroup() {
    // Global Variables - Input
    global $viewGroup, $mediaArt_ShowTVThumb;

    // Global Variables - Output
    global $mediaType_Display, $elementType, $mediaType;

    switch ($viewGroup) {
        case "movie":
            $mediaType_Display = "$viewGroup";
            $elementType = "Video";
            $mediaType = "movie";
            break;
        case "episode":
            $mediaType_Display = "$viewGroup";
            $elementType = "Video";
            $mediaType = $mediaArt_ShowTVThumb;
            break;
        case "show":
            $mediaType_Display = "$viewGroup";
            $elementType = "Directory";
            $mediaType = $mediaArt_ShowTVThumb;
            break;
        case "track":
            $mediaType_Display = "$viewGroup";
            $elementType = "Directory";
            $mediaType = "track";
            break;
        default:
            $mediaType_Display = "Unknown";
            $elementType = "Video";
            $mediaType = "movie";
            break;
    }
}

function plex_metadata_Settings() {
    // Prototype Object

    $PLEXMedia = [];
    $PLEXMedia['TestMedia'] = "value 1 2 3";

    pmp_Logging("PLEX_getMediaMetadata", "plex_metadata_Settings (TESTING): " . $PLEXMedia['TestMedia']);
}

function plex_server_Settings() {
    // Global Variables - Input
    global $plexServerSSL, $plexServerDirect, $plexToken;

    // Global Variables - Output
    global $URLScheme, $plexServer, $plexServerURL;

    // Setting SSL Prefix
    if ($plexServerSSL) {
        $URLScheme = "https";
        $plexServer = $plexServerDirect;
    }
    else {
        $URLScheme = "http";
    }

    $plexServerURL = "$URLScheme://$plexServer:32400/status/sessions?X-Plex-Token=$plexToken";
    pmp_Logging("getMediaURL", "Plex Session URL: $plexServerURL");
}

?>
