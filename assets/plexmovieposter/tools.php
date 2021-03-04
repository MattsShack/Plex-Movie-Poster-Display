<?php

function pmp_Logging($LogType = "Generic", $LogMSG = "") {
    include 'sysConfig.php';
    // include 'CacheLib.php';
    // Debug URL:

    // Add more checks if prereqs are defined

    $CurrDir = getcwd();
    echo "Log (Current Directory): $CurrDir <br>";

    $basePath = dirname(__FILE__);
    echo "Base Path: $basePath <br>";

    echo "Log Type: $LogType <br>";

    if($LogPath == "") {
        $destination_RAW = "$basePath/../../cache/logs/";
        echo "Destination (RAW): $destination_RAW <br>";

        $destination = realpath($destination_RAW);
        echo "Destination (realpath): $destination <br>";
    }
    else {
        $destination = "$LogPath";
        echo "Destination (No Modification): $destination <br>";
    }

    GeneralCache_Prep($destination, FALSE);

    if ($LogType != "Generic") {
        $LogSetting = "Log_$LogType";
        if ($$LogSetting == TRUE) {
            $LogAction = TRUE;
        }
        else {
            $LogAction = FALSE;
        }
    }
    else {
        $LogAction = TRUE;
    }

    $Log_FileName = "PMPD_Log_$LogType.txt";

    $Log_FullName = join('/', array(trim($destination, '/'), trim($Log_FileName, '/')));
    $Log_FullName = "/$Log_FullName"; //Pre-append '/' to build out the path correctly

    $Log_MSG = "$LogMSG\n";

    if ($LogAction == TRUE) {
        
        file_put_contents($Log_FullName, $Log_MSG, FILE_APPEND | LOCK_EX);
    }

    echo "Log (Action): $LogAction <br>";
    echo "Log (FileName): $Log_FileName <br>";
    echo "Log (FullName): $Log_FullName <br>";
}

?>