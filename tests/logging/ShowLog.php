<?php
    
    $inputData = $_GET['logFile'];

    $Log_Path = "../../cache/logs/";
    
    if (empty($inputData)) {
        $Log_Name = "PLEX_getMovieMetadata.log";
    }
    else {
        $Log_Name = "$inputData";
    }

    $Log_FullName = $Log_Path . $Log_Name;

    $getLogContent = file_get_contents($Log_FullName);

    echo nl2br("$getLogContent");

?>