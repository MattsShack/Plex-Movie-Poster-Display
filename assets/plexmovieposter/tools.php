<?php

function pmp_Logging($LogType = "Generic", $LogMSG = "") {
    include 'sysConfig.php';
    // Debug URL:

    if($LogPath == "") {
        $destination = "cache/logs/";
    }
    else {
        $destination = "$LogPath";
    }

    if (!file_exists($destination)) {
        mkdir($destination, 0777, true);
    }

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

}


?>