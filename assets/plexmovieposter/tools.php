<?php

function pmp_Logging($LogType = "Generic", $LogMSG = "") {
    include 'sysConfig.php';
    // include 'CacheLib.php';
    // Debug URL:

    // Add more checks if prereqs are defined

    if($LogPath == "") {
        $destination = "../../cache/logs/";
    }
    else {
        $destination = "$LogPath";
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

    if ($LogAction == TRUE) {
        $Log_FileName = "PMPD_Log_$LogType.txt";

        $Log_FullName = join('/', array(trim($destination, '/'), trim($Log_FileName, '/')));
	    $Log_MSG = "$LogMSG\n";

        file_put_contents($Log_FullName, $Log_MSG, FILE_APPEND | LOCK_EX);
    }

    // echo "Log (FullName): $Log_FileName";
}

?>