<?php

//  NEED TO SUPPORT "movie" and "show" as well as "clients"

function plex_metadata_title($mediaType = "episode") {
    global $mediaTitle, $mediaTitle_MetadataID, $clients;

    // Title
    switch ($mediaType) {
        case "episode":
            $mediaTitle = $clients['title']; // Episode Title
            pmp_Logging("getTVShowData", "mediaTitle @ Episode (title) - $mediaTitle (metadata ID: $mediaTitle_MetadataID)");
            break;
        case "season":
            $mediaTitle = $clients['parentTitle']; // Season Title
            pmp_Logging("getTVShowData", "mediaTitle @ Season (parentTitle) - $mediaTitle (metadata ID: $mediaTitle_MetadataID)");
            break;
        case "series":
            $mediaTitle = $clients['grandparentTitle']; // Series Title
            pmp_Logging("getTVShowData", "mediaTitle @ Series (grandparentTitle) - $mediaTitle (metadata ID: $mediaTitle_MetadataID)");
            break;
        case "movie":
            $mediaTitle = $clients['title']; // Movie Title
            pmp_Logging("getMovieData", "mediaTitle @ Movie (title) - $mediaTitle (metadata ID: $mediaTitle_MetadataID)");
            break;
        case "track":
            $mediaTitle = $clients['title']; // Track Title (future - title, parentTitle (Album), grandparentTitle (Artist))
            pmp_Logging("getMusicData", "mediaTitle @ Track (title) - $mediaTitle (metadata ID: $mediaTitle_MetadataID)");
            break;
        default:
            $mediaTitle = $clients['title']; // Default Title
            pmp_Logging("getTVShowData", "mediaTitle @ Default (title) - $mediaTitle (metadata ID: $mediaTitle_MetadataID)");
    }
}

function plex_metadata_summary($mediaType = "episode") {
    global $mediaSummary, $mediaSummary_MetadataID, $clients;

    // Summary
    switch ($mediaType) {
        case "episode":
            $mediaSummary = $clients['summary']; // Episode Summary
            pmp_Logging("getTVShowData", "mediaSummary @ Episode (summary) - $mediaSummary (metadata ID: $mediaSummary_MetadataID)");
            break;
        case "season":
            $mediaSummary = $clients['summary']; // Season Summary
            pmp_Logging("getTVShowData", "mediaSummary @ Season (summary) - $mediaSummary (metadata ID: $mediaSummary_MetadataID)");
            break;
        case "series":
            $mediaSummary = $clients['summary']; // Series Summary
            pmp_Logging("getTVShowData", "mediaSummary @ Series (summary) - $mediaSummary (metadata ID: $mediaSummary_MetadataID)");
            break;
        case "movie":
            $mediaSummary = $clients['summary']; // Movie Summary
            pmp_Logging("getMovieData", "mediaSummary @ Movie (summary) - $mediaSummary (metadata ID: $mediaSummary_MetadataID)");
            break;
        case "track":
            $mediaSummary = $clients['summary']; // Track Summary
            pmp_Logging("getMusicData", "mediaSummary @ Track (summary) - $mediaSummary (metadata ID: $mediaSummary_MetadataID)");
            break;
        default:
            $mediaSummary = $clients['summary']; // Default Summary
            pmp_Logging("getTVShowData", "mediaSummary @ Default (summary) - $mediaSummary (metadata ID: $mediaSummary_MetadataID)");
    }
}

function plex_metadata_tagline($mediaType = "episode") {
    global $mediaTagline, $mediaTagline_MetadataID, $clients;

    // Notes: TV Shows do not contain tagline

    // Tagline
    switch ($mediaType) {
        case "episode":
            $mediaTagline = $clients['tagline']; // Episode Tagline
            pmp_Logging("getTVShowData", "mediaTagline @ Episode (tagline) - $mediaTagline (metadata ID: $mediaTagline_MetadataID)");
            break;
        case "season":
            $mediaTagline = $clients['tagline']; // Season Tagline
            pmp_Logging("getTVShowData", "mediaTagline @ Season (tagline) - $mediaTagline (metadata ID: $mediaTagline_MetadataID)");
            break;
        case "series":
            $mediaTagline = $clients['tagline']; // Series Tagline
            pmp_Logging("getTVShowData", "mediaTagline @ Series (tagline) - $mediaTagline (metadata ID: $mediaTagline_MetadataID)");
            break;
        case "movie":
            $mediaTagline = $clients['tagline']; // Movie Tagline
            pmp_Logging("getMovieData", "mediaTagline @ Movie (tagline) - $mediaTagline (metadata ID: $mediaTagline_MetadataID)");
            break;
        case "track":
            $mediaTagline = $clients['tagline']; // Track Tagline
            pmp_Logging("getMusicData", "mediaTagline @ Track (tagline) - $mediaTagline (metadata ID: $mediaTagline_MetadataID)");
            break;
        default:
            $mediaTagline = $clients['tagline']; // Default Tagline
            pmp_Logging("getTVShowData", "mediaTagline @ Default (tagline) - $mediaTagline (metadata ID: $mediaTagline_MetadataID)");
    }
}

function plex_metadata_art($mediaType = "episode") {
    global $mediaArt, $mediaArt_MetadataID, $clients;

    // Art
    switch ($mediaType) {
        case "episode":
            $mediaArt = $clients['art']; // Episode Background Art
            pmp_Logging("getTVShowData", "mediaArt @ Episode (art) - $mediaArt (metadata ID: $mediaArt_MetadataID)");
            break;
        case "season":
            $mediaArt = $clients['art']; // Season Background Art
            pmp_Logging("getTVShowData", "mediaArt @ Season (art) - $mediaArt (metadata ID: $mediaArt_MetadataID)");
            break;
        case "series":
            $mediaArt = $clients['grandparentArt']; // Series Background Art
            pmp_Logging("getTVShowData", "mediaArt @ Series (grandparentArt) - $mediaArt (metadata ID: $mediaArt_MetadataID)");
            break;
        case "movie":
            $mediaArt = $clients['art']; // Movie Background Art
            pmp_Logging("getMovieData", "mediaArt @ Movie (art) - $mediaArt (metadata ID: $mediaArt_MetadataID)");
            break;
        case "track":
            $mediaArt = $clients['art']; // Track Background Art
            pmp_Logging("getMusicData", "mediaArt @ Track (art) - $mediaArt (metadata ID: $mediaArt_MetadataID)");
            break;
        default:
            $mediaArt = $clients['art']; // Default Background Art
            pmp_Logging("getTVShowData", "mediaArt @ Default (art) - $mediaArt (metadata ID: $mediaArt_MetadataID)");
    }
}

function plex_metadata_thumb($mediaType = "episode") {
    global $mediaThumb, $mediaThumb_MetadataID, $clients;

    // Thumb
    switch ($mediaType) {
        case "episode":
            $mediaThumb = $clients['thumb']; // Episode Thumb (Poster)
            $mediaThumb_TMP = preg_split("#/#", $mediaThumb);
            $mediaThumb_MetadataID = $mediaThumb_TMP[3];
            pmp_Logging("getTVShowData", "mediaThumb @ Episode (thumb) - $mediaThumb (metadata ID: $mediaThumb_MetadataID)");
            break;
        case "season":
            $mediaThumb = $clients['parentThumb']; // Season Thumb (Poster)
            $mediaThumb_TMP = preg_split("#/#", $mediaThumb);
            $mediaThumb_MetadataID = $mediaThumb_TMP[3];
            pmp_Logging("getTVShowData", "mediaThumb @ Season (parentThumb) - $mediaThumb (metadata ID: $mediaThumb_MetadataID)");
            break;
        case "series":
            $mediaThumb = $clients['grandparentThumb']; // Series Thumb (Poster)
            $mediaThumb_TMP = preg_split("#/#", $mediaThumb);
            $mediaThumb_MetadataID = $mediaThumb_TMP[3];
            pmp_Logging("getTVShowData", "mediaThumb @ Series (grandparentThumb) - $mediaThumb (metadata ID: $mediaThumb_MetadataID)");
            break;
        case "movie":
            $mediaThumb = $clients['thumb']; // Movie Thumb (Poster)
            $mediaThumb_TMP = preg_split("#/#", $mediaThumb);
            $mediaThumb_MetadataID = $mediaThumb_TMP[3];
            pmp_Logging("getMovieData", "mediaThumb @ Movie (thumb) - $mediaThumb (metadata ID: $mediaThumb_MetadataID)");
            break;
        case "track":
            $mediaThumb = $clients['thumb']; // Track Thumb (Poster) (future - thumb, parentThumb (Album), grandparentThumb (Artist))
            $mediaThumb_Note = "thumb";

            if ($mediaThumb == '') {
                $mediaThumb = $clients['parentThumb']; // Track Thumb (Poster) (future - thumb, parentThumb (Album), grandparentThumb (Artist))
                $mediaThumb_Note = "parentThumb";
            }

            if ($mediaThumb == '') {
                $mediaThumb = $clients['grandparentThumb']; // Track Thumb (Poster) (future - thumb, parentThumb (Album), grandparentThumb (Artist))
                $mediaThumb_Note = "grandparentThumb";
            }

            $mediaThumb_TMP = preg_split("#/#", $mediaThumb);
            $mediaThumb_MetadataID = $mediaThumb_TMP[3];
            pmp_Logging("getMusicData", "mediaThumb @ Track ($mediaThumb_Note) - $mediaThumb (metadata ID: $mediaThumb_MetadataID)");
            break;
        default:
            $mediaThumb = $clients['thumb']; // Default Thumb (Poster)
            $mediaThumb_TMP = preg_split("#/#", $mediaThumb);
            $mediaThumb_MetadataID = $mediaThumb_TMP[3];
            pmp_Logging("getTVShowData", "mediaThumb @ Default (thumb) - $mediaThumb (metadata ID: $mediaThumb_MetadataID)");
    }
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

?>
