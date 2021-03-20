<?php

function importFiles($fieldID = 'zip_file', $configPage = "fonts.php") {
    // Future Development:
    // - Set destination values within a config file (per file type)

    $PostMSG = '';

    $ShowMSG = TRUE;
    $SetRedirect = TRUE;
    $SetRedirect_target = "$configPage";

    if ($_FILES[$fieldID]['name'] != '') {
        $FileInfo_NameRAW = $_FILES[$fieldID]['name'];
        $FileInfo_NameTMP = $_FILES[$fieldID]['tmp_name'];

        $FileInfo_Name = basename($FileInfo_NameRAW);
        $FileInfo_Array = explode(".", $FileInfo_Name);
        $name = $FileInfo_Array[0];

        $FileInfo_Ext = $FileInfo_Array[1];
        $FileInfo_Size = $_FILES[$fieldID]['size'];

        switch ($configPage) {
            case "custom.php":
                $destination = "../cache/custom/";
                if (preg_match("{[zZ][iI][pP]}",$FileInfo_Ext)) {
                    importFiles_ZIP($ShowMSG, $SetRedirect, $fieldID, $destination, 'all', $configPage);
                }
                else {
                    importFiles_CUSTOM($ShowMSG, $SetRedirect, $fieldID, $destination);
                }
                break;
            case "fonts.php":
                $destination = "../cache/fonts/";
                if (preg_match("{[zZ][iI][pP]}",$FileInfo_Ext)) {
                    importFiles_ZIP($ShowMSG, $SetRedirect, $fieldID, $destination, 'fonts', $configPage);
                }
                
                // Add filter list to allow all types of fonts to be uploaded
                if (preg_match("{[tT][tT][fF]}",$FileInfo_Ext)) {
                    importFiles_TTF($ShowMSG, $SetRedirect, $fieldID, $destination);
                }
                break;
            default:
                if (preg_match("{[zZ][iI][pP]}",$FileInfo_Ext)) {
                    $destination = "../cache/fonts/";
                    importFiles_ZIP($ShowMSG, $SetRedirect, $fieldID, $destination);
                }

                if (preg_match("{[tT][tT][fF]}",$FileInfo_Ext)) {
                    $destination = "../cache/fonts/";
                    importFiles_TTF($ShowMSG, $SetRedirect, $fieldID, $destination);
                }
                break;
        }
    }
}

function importFiles_ZIP($ShowMSG = FALSE, $SetRedirect = FALSE, $fieldID = 'zip_file', $destination = '../cache/TMP/', $extractFiles = 'all', $redirectTarget = "fonts.php") {
    // require_once 'tools.php';
    $PostMSG = '';
    $LogMSG_Header = "Import Files (ZIP)";

    // $ShowMSG = FALSE;
    // $SetRedirect = TRUE;
    $SetRedirect_target = $redirectTarget;
    $SubDirectoryMode = TRUE;

    $FileInfo_NameRAW = $_FILES[$fieldID]['name'];
    $FileInfo_NameTMP = $_FILES[$fieldID]['tmp_name'];

    $fontExtList = array("ttf","otf","eot","woff","svg");

    pmp_Logging("importFiles", "$LogMSG_Header File Info (NameRAW): $FileInfo_NameRAW");
    pmp_Logging("importFiles", "$LogMSG_Header File Info (NameTMP): $FileInfo_NameTMP");

    $FileInfo_Name = basename($FileInfo_NameRAW);
    $FileInfo_Array = explode(".", $FileInfo_Name);
    $name = $FileInfo_Array[0];

    pmp_Logging("importFiles", "$LogMSG_Header File Info (FileInfo_Name): $FileInfo_Name");
    pmp_Logging("importFiles", "$LogMSG_Header File Info (Name): $name");

    $FileInfo_Ext = $FileInfo_Array[1];
    $FileInfo_Size = $_FILES[$fieldID]['size'];

    // Set destination to use zip file name as folder name.
    if ($SubDirectoryMode == TRUE) {
        $destination = $destination . $name;
    }

    // Generate the directory if it does not exist.
    GeneralPath_Create($destination, "importFiles_ZIP");

    // $location = $destination . $FileInfo_Name;
    // $destination_FullName = $destination . $FileInfo_Name;
    $destination_FullName = $destination . "/" . $FileInfo_Name;

    if (move_uploaded_file($FileInfo_NameTMP, $destination_FullName)) {
        $zip = new ZipArchive();

        pmp_Logging("importFiles", "$LogMSG_Header Destination FullName: $destination_FullName");
        pmp_Logging("importFiles", "$LogMSG_Header Destination: $destination");
        
        switch ($extractFiles) {
            case 'all':
                if ($zip->open($destination_FullName)) {
                    $zip->extractTo($destination);
                    $zip->close();
                }
                break;
            case 'fonts':
                if ($zip->open($destination_FullName) === TRUE) {
                    for($i = 0; $i < $zip->numFiles; $i++) {
                        $entry = $zip->getNameIndex($i);
                        
                        foreach ($fontExtList as $fontExt) {
                            $setMatch = '#\.(' . $fontExt . ')$#i';
                            // if(preg_match('#\.(ttf)$#i', $entry)) {
                            if(preg_match($setMatch, $entry)) {
                                pmp_Logging("importFiles", "DUMP: $entry");
                                $zip->extractTo($destination, $entry);
                            }
                        }
                    }
                    $zip->close();
                    
                    FontDirCleanup();
                    FontExtRename();
                }
                break;
            default:
                if ($zip->open($destination_FullName)) {
                    $zip->extractTo($destination);
                    $zip->close();
                }
                break;
        }

        // Remove the file if it exits.  (* Look at moving to separate function)
        // if (is_file($destination_FullName)) {
        //     unlink ($destination_FullName);
        // }
        // rmdir ($destination . $name);

        GeneralPath_Remove($destination_FullName, $destination, $name);

        if ($ShowMSG == TRUE) {
            $PostMSG .= "The file ". htmlspecialchars($FileInfo_Name). " has been uploaded.<br>";
            echo $PostMSG;
        }

        if ($SetRedirect == TRUE) {
            header("Location: $SetRedirect_target");
            exit();
        }
    }
}

function importFiles_TTF($ShowMSG = FALSE, $SetRedirect = FALSE, $fieldID = 'zip_file', $destination = '../cache/TMP/') {
    $PostMSG = '';

    // $ShowMSG = FALSE;
    // $SetRedirect = TRUE;
    $SetRedirect_target = "fonts.php";

    // Generate the directory if it does not exist.  (* Look at moving to separate function)
    GeneralPath_Create($destination, "importFiles_TTF");

    $FileInfo_NameRAW = $_FILES[$fieldID]['name'];
    $FileInfo_NameTMP = $_FILES[$fieldID]['tmp_name'];

    $FileInfo_Name = basename($FileInfo_NameRAW);
    $FileInfo_Array = explode(".", $FileInfo_Name);
    $name = $FileInfo_Array[0];

    $FileInfo_Ext = $FileInfo_Array[1];
    $FileInfo_Size = $_FILES[$fieldID]['size'];

    $UseFileName = true;

    $CustomFont_fileName = "CustomFont.ttf";

    // Check file size
    $fileSizeMax = 500000;  // 500 KB

    if ($UseFileName == TRUE) {
        $destination_FullName = $destination . $FileInfo_Name;
    }
    else {
        $destination_FullName = $destination . $CustomFont_fileName;
    }

    $uploadOk = 1;

    // Check if file already exists
    if (file_exists($destination_FullName)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($FileInfo_Size > $fileSizeMax) {
        if ($ShowMSG == TRUE) {
            echo "Sorry, your file is too large.";
        }
        $uploadOk = 0;
    }

    if(!preg_match("{[tT][tT][fF]}",$FileInfo_Ext)) {
        if ($ShowMSG == TRUE) {
            echo "Sorry, only ttf files are allowed.";
        }
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        if ($ShowMSG == TRUE) {
            echo "Sorry, your file was not uploaded.<br>";
        }
        // if everything is ok, try to upload file
    }
    else {
        if (move_uploaded_file($FileInfo_NameTMP, $destination_FullName)) {
            if ($ShowMSG == TRUE) {
                $PostMSG .= "The file ". htmlspecialchars($FileInfo_Name). " has been uploaded.<br>";
                echo $PostMSG;
            }

            if ($SetRedirect == TRUE) {
                header("Location: $SetRedirect_target");
                exit();
            }
        }
        else {
            if ($ShowMSG == TRUE) {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}

function importFiles_CUSTOM($ShowMSG = FALSE, $SetRedirect = FALSE, $fieldID = 'zip_file', $destination = '../cache/custom/') {
    $PostMSG = '';

    // $ShowMSG = FALSE;
    // $ShowMSG = TRUE;
    // $SetRedirect = TRUE;
    $SetRedirect_target = "custom.php";

    // Generate the directory if it does not exist.  (* Look at moving to separate function)
    GeneralPath_Create($destination, "importFiles_CUSTOM");

    $FileInfo_NameRAW = $_FILES[$fieldID]['name'];
    $FileInfo_NameTMP = $_FILES[$fieldID]['tmp_name'];

    $FileInfo_Name = basename($FileInfo_NameRAW);
    $FileInfo_Array = explode(".", $FileInfo_Name);
    $name = $FileInfo_Array[0];

    $FileInfo_Ext = $FileInfo_Array[1];
    $FileInfo_Size = $_FILES[$fieldID]['size'];

    $UseFileName = true;

    $Custom_fileName = "CustomFont.ttf";

    // Check file size
    $fileSizeMax = 5000000;  // 5000 KB

    if ($UseFileName == TRUE) {
        $destination_FullName = $destination . $FileInfo_Name;
    }
    else {
        $destination_FullName = $destination . $Custom_fileName;
    }

    $uploadOk = 1;

    // Check if file already exists
    if (file_exists($destination_FullName)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($FileInfo_Size > $fileSizeMax) {
        if ($ShowMSG == TRUE) {
            echo "Sorry, your file is too large.";
        }
        $uploadOk = 0;
    }

    // if(!preg_match("{[tT][tT][fF]}",$FileInfo_Ext)) {
    //     if ($ShowMSG == TRUE) {
    //         echo "Sorry, only ttf files are allowed.";
    //     }
    //     $uploadOk = 0;
    // }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        if ($ShowMSG == TRUE) {
            echo "Sorry, your file was not uploaded.<br>";
        }
        // if everything is ok, try to upload file
    }
    else {
        if (move_uploaded_file($FileInfo_NameTMP, $destination_FullName)) {
            if ($ShowMSG == TRUE) {
                $PostMSG .= "The file ". htmlspecialchars($FileInfo_Name). " has been uploaded.<br>";
                echo $PostMSG;
            }

            if ($SetRedirect == TRUE) {
                header("Location: $SetRedirect_target");
                exit();
            }
        }
        else {
            if ($ShowMSG == TRUE) {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

}

function importFiles_Config() {
    $ShowMSG = false;
    $SetRedirect = true;

    // $target_dir = "uploads/";
    $destination = "../";
    $target_fileName = "config.php";
    // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $target_file = $destination . $target_fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Generate the Upload directory if it does not exist.
    // GeneralPath_Create($destination, "importFiles_Config"); // Not Required as config file is in root.

    // Check if image file is a actual image or fake image
    if (isset($_POST["restoreConfig"])) {
        // $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]); // Disabled for php upload
        if ($check !== false) {
            if ($ShowMSG == true) {
                echo "File is an image - " . $check["mime"] . ".";
            }
            $uploadOk = 1;
        }
        else {
            if ($ShowMSG == true) {
                echo "File is not an image.";
            }
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    // if (file_exists($target_file)) {
    //     echo "Sorry, file already exists.";
    //     $uploadOk = 0;
    // }

    // if ($_FILES["fileToUpload"] == "") {
    //     echo "NO FILE";
    // }
    // else {
    //     echo "FILE HERE";
    // }

    // Trying to track down nginx error when there is no file to upload for config.php.  No issue to client.

    // Check file size
    // $fileSizeMax = 500000; // 500 KB
    $fileSizeMax = 10000;  // 10 KB
    // if ($_FILES["fileToUpload"] != "") {
        if ($_FILES["fileToUpload"]["size"] > $fileSizeMax) {
            if ($ShowMSG == true) {
                echo "Sorry, your file is too large.";
            }
            $uploadOk = 0;
        }
    // }

    // Allow certain file formats
    // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    //   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //   $uploadOk = 0;
    // }

    if($imageFileType != "php") {
        if ($ShowMSG == true) {
            echo "Sorry, only php files are allowed.";
        }
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        if ($ShowMSG == true) {
            echo "Sorry, your file was not uploaded.<br>";
        }
        // if everything is ok, try to upload file
    }
    else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            if ($ShowMSG == true) {
                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.<br>";
            }
            if ($SetRedirect == true) {
                header("Location: general.php");
                exit();
            }
        }
        else {
            if ($ShowMSG == true) {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}

function exportFiles($source = "../cache/fonts", $destination = "../cache/archive", $exportFileName = "FontArchive_Custom.zip", $exportType = "zip", $SetRedirect = TRUE) {
    // exportFiles_ZIP("../assets/fonts","../cache/archive", "FontArchive_Stock.zip");
    // exportFiles_ZIP("../cache/fonts","../cache/archive", "FontArchive_Custom.zip");

    // $exportType = "pmp";

    $PostMSG = '';

    $ShowMSG = FALSE;
    // $SetRedirect = TRUE;
    $SetRedirect_target = "fonts.php";

    if (preg_match("{[zZ][iI][pP]}",$exportType)) {
        // $source = "$source";
        // $destination = "$destination";
        exportFiles_ZIP($ShowMSG, $SetRedirect, $source, $destination, $exportFileName);
    }

    if (preg_match("{[pP][mM][pP]}",$exportType)) {
        // $source = "$source";
        // $destination = "$destination";
        // $exportFileName = "PlexMoviePosterBackup.pmp";
        exportFiles_PMP($ShowMSG, $SetRedirect, $source, $destination, $exportFileName);
    }
}

function exportFiles_ZIP($ShowMSG = FALSE, $SetRedirect = FALSE, $source, $destination = "../cache/archive", $FileInfo_Name) {
    if (!extension_loaded('zip') || !file_exists($source)) {
        return false;
    }

    $PostMSG = '';

    pmp_Logging("exportFiles", "Function: exportFiles_ZIP");
    pmp_Logging("exportFiles", "\t Source (Original): $source");
    pmp_Logging("exportFiles", "\t destination: $destination");
    pmp_Logging("exportFiles", "\t File Info (Name): $FileInfo_Name");

    // $ShowMSG = FALSE;
    // $SetRedirect = TRUE;
    $SetRedirect_target = "fonts.php";

    // Generate the directory if it does not exist.
    GeneralPath_Create($destination, "exportFiles_ZIP");

    // $destination_FullName = $destination . $FileInfo_Name;
    // $destination_FullName = "$destination/$FileInfo_Name";
    $destination_FullName = join('/', array(trim($destination, '/'), trim($FileInfo_Name, '/')));
    pmp_Logging("exportFiles", "\t Destination (FullName): $destination_FullName");

    // Remove the file if it exits.  (* Look at moving to separate function)
    // if (is_file($destination_FullName)) {
    //     unlink ($destination_FullName);
    // }

    GeneralPath_Remove($destination_FullName);

    $zip = new ZipArchive();

    if (!$zip->open($destination_FullName, ZIPARCHIVE::CREATE)) {
        return false;
    }

    $source = str_replace('\\', '/', realpath($source));
    pmp_Logging("exportFiles", "\t Source (Modified): $source");

    if (is_dir($source) === true) {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file) {
            $file = str_replace('\\', '/', $file);

            if (in_array(substr($file, strrpos($file, '/')+1), array('.', '..')))
            continue;
            $file = realpath($file);

            if (is_dir($file) === true) {
                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
            }
            else if (is_file($file) === true) {
                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
        }
    }
    else if (is_file($source) === true) {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    // return $zip->close();
    $zip->close();
    // header('Content-type: application/zip');
    // header('Content-Disposition: attachment; filename='.basename($destination));

    if ($ShowMSG == TRUE) {
        $PostMSG .= "The file ". htmlspecialchars($FileInfo_Name). " has been uploaded.<br>";
        echo $PostMSG;
    }

    if ($SetRedirect == TRUE) {
        header("Location: $SetRedirect_target");
        exit();
    }
}

function exportFiles_PMP($ShowMSG = FALSE, $SetRedirect = FALSE, $source, $destination = "../cache/archive", $FileInfo_Name) {
    // if (!extension_loaded('zip') || !file_exists($source)) {
    //     return false;
    // }

    if (!extension_loaded('zip')) {
        return false;
    }

    $PostMSG = '';

    $PMPFontsDir = "fonts/";

    // $ShowMSG = FALSE;
    // $SetRedirect = TRUE;
    $SetRedirect_target = "fonts.php";

    // Generate the directory if it does not exist.

    $destination = str_replace("//", "/", $destination);

    GeneralPath_Create($destination, "exportFiles_PMP");

    $destination_FullName = join('/', array(trim($destination, '/'), trim($FileInfo_Name, '/')));

    // Remove the file if it exits.  (* Look at moving to separate function)
    // if (is_file($destination_FullName)) {
    //     unlink ($destination_FullName);
    // }

    GeneralPath_Remove($destination_FullName);

    $zip = new ZipArchive();

    if (!$zip->open($destination_FullName, ZIPARCHIVE::CREATE)) {
        return false;
    }

    // --- Config File
    if (strpos($source, "../../") !== false) {
        $configRootPath = "../../";
    }
    else {
        $configRootPath = "../";
    }

    $configFile_Name = "config.php";
    $configFile_FullName = join('/', array(trim($configRootPath, '/'), trim($configFile_Name, '/')));

    if ($ShowMSG == TRUE) {
        print "<br> Config File: $configFile_FullName <br>";
    }
    // --- Config File

    $zip->addFile($configFile_FullName,$configFile_Name);

    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true) {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file) {
            $file = str_replace('\\', '/', $file);

            if (in_array(substr($file, strrpos($file, '/')+1), array('.', '..')))
            continue;
            $file = realpath($file);

            if (is_dir($file) === true) {
                $zip->addEmptyDir(str_replace($source . '/', "$PMPFontsDir", $file . '/'));
            }
            else if (is_file($file) === true) {
                $zip->addFromString(str_replace($source . '/', "$PMPFontsDir", $file), file_get_contents($file));
            }
        }
    }
    else if (is_file($source) === true) {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    // return $zip->close();
    $zip->close();
    // header('Content-type: application/zip');
    // header('Content-Disposition: attachment; filename='.basename($destination));

    if ($ShowMSG == TRUE) {
        $PostMSG .= "The file ". htmlspecialchars($FileInfo_Name). " has been uploaded.<br>";
        echo $PostMSG;
    }

    if ($SetRedirect == TRUE) {
        header("Location: $SetRedirect_target");
        exit();
    }
}

function exportFiles_DownloadLink($fieldID = "DownloadLink", $destination = "../cache/archive", $FileInfo_Name = "FontArchive_Custom.zip") {
    $destination_FullName = join('/', array(trim($destination, '/'), trim($FileInfo_Name, '/')));

    if(file_exists($destination_FullName)) {
        $GLOBALS["$fieldID"] = "Download Bundle: <a href=\"$destination_FullName\">Here</a>";
    }
    else {
        $GLOBALS["$fieldID"] = "Download Bundle: <i>None</i>";
    }
}

function exportFiles_Config($exportFile) {
    // $fileName = basename($exportFile);
    $fileName = $exportFile;
    $filePath = '../'.$fileName;

    $exportConfigName = "PMP_config.php";

    if (!empty($fileName) && file_exists($filePath)) {
        //Define Headers
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        // header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Disposition: attachment; filename=$exportConfigName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
        ob_clean();
        flush();
        readfile($filePath);
        exit;
    }
    else {
        echo "This file does not exist.";
    }
}

?>