<?php

function pmp_Logging($LogType = "Generic", $LogMSG = "", $DebugMSG = FALSE, $FeedFunction = "N/A") {
    include 'sysConfig.php';
    // include 'CacheLib.php';
    // Debug URL:

    // Usage: pmp_Logging("importFiles", "$LogMSG_Header Destination FullName: $destination_FullName");

    // Add more checks if prereqs are defined

    $CurrDir = getcwd();
    if ($DebugMSG == TRUE) {
        echo "Log (Current Directory): $CurrDir <br>";
    }

    $basePath = dirname(__FILE__);
    if ($DebugMSG == TRUE) {
        echo "Base Path: $basePath <br>";
        echo "Log Type: $LogType <br>";
    }

    if ($LogPath == "") {
        $destination_RAW = "$basePath/../../cache/logs/";

        $destination = realpath($destination_RAW);

        if ($DebugMSG == TRUE) {
            echo "Destination (RAW): $destination_RAW <br>";
            echo "Destination (realpath): $destination <br>";
        }
    }
    else {
        $destination = "$LogPath";
        if ($DebugMSG == TRUE) {
            echo "Destination (No Modification): $destination <br>";
        }
    }

    // Generate destination directory
        // Generate folder directly so that function stays more independent from other functions.
        if ($DebugMSG == TRUE) {
            echo "Debug (pmp_Logging): $destination <br>";
        }

        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }
    // -----

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

    // $Log_FileName = "PMPD_Log_$LogType.txt";
    $Log_FileName = "$LogType.log";

    $Log_FullName = join('/', array(trim($destination, '/'), trim($Log_FileName, '/')));
    $Log_FullName = "/$Log_FullName"; //Pre-append '/' to build out the path correctly

    $Log_MSG = "$LogMSG\n";

    // echo "Log (FullName): $Log_FullName -- $FeedFunction <br>";

    if ($LogAction == TRUE) {
        file_put_contents($Log_FullName, $Log_MSG, FILE_APPEND | LOCK_EX);
    }

    if ($DebugMSG == TRUE) {
        echo "Log (Action): $LogAction <br>";
        echo "Log (FileName): $Log_FileName <br>";
        echo "Log (FullName): $Log_FullName <br>";
    }
}

function GeneralPath_Create($destination = "../cache/", $FeedFunction = "N/A") {
    // Generate the Cache Directory if it does not exist.
    // Usage: GeneralPath_Create($destination);

    $functionName = "GeneralPath_Create";

    pmp_Logging("fileSystem", "$functionName: $destination", FALSE, "$functionName - $FeedFunction");

    if ($destination != "") {
        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }
    }
    else {
        echo "Invalid path provided by: $FeedFunction <br>";
    }
}

function GeneralPath_Remove($destination_FullName, $destination = "", $name = "") {
    // Remove the file if it exits.
    // Usage: GeneralPath_Remove($destination_FullName, $destination, $name);

    $functionName = "GeneralPath_Remove";

    pmp_Logging("fileSystem", "$functionName (destination_FullName): $destination_FullName");
    pmp_Logging("fileSystem", "$functionName (destination): $destination");
    pmp_Logging("fileSystem", "$functionName (name): $name");

    if (is_file($destination_FullName)) {
        pmp_Logging("fileSystem", "$functionName: unlink");
        unlink ($destination_FullName);
    }

    if ($name != "") {
        $RemoveDir = $destination . "/" . $name;

        if(is_file($RemoveDir)) {
            pmp_Logging("fileSystem", "$functionName: rmdir - $RemoveDir");
            rmdir ($RemoveDir);
        }
    }
}

?>