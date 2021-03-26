<?php

function GenerateCSS_FontSingle($CSSFullName, $fontPath = "/cache/fonts", $fontName = "CustomFont", $fontFile = "CustomFont") {
    // Font CSS Logic

    $fontSystemRoot = "/var/www/html";
    $fontExtList = array("ttf","otf","eot","woff","svg");

    // Simple Logic
        // $publishString = "@font-face {\n";
        // $publishString .= "    font-family: \"$fontName\";\n";
        // $publishString .= "    src: url('$fontPath/$fontFile.eot');\n";
        // $publishString .= "    src: url('$fontPath/$fontFile.eot?#iefix') format('embedded-opentype'),\n";
        // $publishString .= "         url('$fontPath/$fontFile.woff') format('woff'),\n";
        // $publishString .= "         url('$fontPath/$fontFile.ttf') format('truetype'),\n";
        // $publishString .= "         url('$fontPath/$fontFile.otf') format('opentype'),\n";
        // $publishString .= "         url('$fontPath/$fontFile.svg#webfont') format('svg');\n";
        // $publishString .= "}\n\n";

    // Advanced Logic
        $publishString = "@font-face {\n";
        $publishString .= "    font-family: \"$fontName\";\n";

        foreach ($fontExtList as $fontExt) {
            $fontSystemPath = "$fontSystemRoot$fontPath/$fontFile.$fontExt";
            pmp_Logging("fontSystem", "Validating (Font System Path): $fontSystemPath");

            $ValidateFontSystemPath = realpath("$fontSystemPath");
            pmp_Logging("fontSystem", "Validating (realpath): $ValidateFontSystemPath");

            if (($fontExt == "eot") && ($ValidateFontSystemPath != "")) {
                $publishString .= "    src: url('$fontPath/$fontFile.eot');\n";
                $publishString .= "    src: url('$fontPath/$fontFile.eot?#iefix') format('embedded-opentype'),\n";
            }

            if (($fontExt == "woff") && ($ValidateFontSystemPath != "")) {
                $publishString .= "    src: url('$fontPath/$fontFile.woff') format('woff');\n";
            }

            if (($fontExt == "ttf") && ($ValidateFontSystemPath != "")) {
                $publishString .= "    src: url('$fontPath/$fontFile.ttf') format('truetype');\n";
            }

            if (($fontExt == "otf") && ($ValidateFontSystemPath != "")) {
                $publishString .= "    src: url('$fontPath/$fontFile.otf') format('opentype');\n";
            }

            if (($fontExt == "svg") && ($ValidateFontSystemPath != "")) {
                $publishString .= "    src: url('$fontPath/$fontFile.svg#webfont') format('svg');\n";
            }
        }
        $publishString .= "}\n\n";

    // Open the file to get existing content
    if (realpath($CSSFullName) != "") {
        $current = file_get_contents($CSSFullName);
    }
    else {
        $current = "";
    }

    // Append a new entry to the file
    $current .= "$publishString";

    // Write the contents back to the file
    file_put_contents($CSSFullName, $current);

    // // Write the contents to the file,
    // // using the FILE_APPEND flag to append the content to the end of the file
    // // and the LOCK_EX flag to prevent anyone else writing to the file at the same time
    // file_put_contents($CSSFullName, $publishString, FILE_APPEND | LOCK_EX);

}

function GenerateCSS_Font($CSSPath = "../cache/fonts/", $CSSFile = "fonts_custom.css", $FontPath = "../cache/fonts") {
    $invalidDirs = array('__MACOSX');
    $invalidFiles = array('._');

    // CSS File Settings
    $CSSFullName = $CSSPath . $CSSFile;

    // Generate the directory if it does not exist.
    if (!file_exists($CSSPath)) {
        mkdir($CSSPath, 0777, true);
    }

    // Remove the file if it exits.
    if (is_file($CSSFullName)) {
        unlink($CSSFullName);
    }

    // Generate the directory if it does not exist.  (* Look at moving to separate function)
    if (!file_exists($FontPath)) {
        mkdir($FontPath, 0777, true);
    }

    // Process Logic

    $dir_iterator = new RecursiveDirectoryIterator("$FontPath");
    $files = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);

    $fontExtList = array("ttf","otf","eot","woff","svg");

    foreach ($files as $file) {
        if (is_file($file)) {
            $file_parts = pathinfo($file);

            foreach ($fontExtList as $fontExt) {
                $setMatch = '#(' . $fontExt . ')#i';

                if (preg_match($setMatch,$file_parts['extension'])) {
                    $fontPath = $file_parts['dirname'];
                    $fontPath = str_replace('..','',$fontPath);
                    $fontName = $file_parts['filename'];
                    $fontFile = $file_parts['filename'];

                    // Folder Validate
                    // foreach ($invalidDirs as $validateDir) {
                    //     if (strpos($fontPath, $validateDir)) {
                    //         pmp_Logging("fontSystem", "FolderCheck (IF): $fontName ($fontPath)");
                    //     }
                    //     else {
                    //         pmp_Logging("fontSystem", "FolderCheck (ELSE): $fontName ($fontPath)");
                    //     }
                    // }

                    // Font Validation
                    $fontValid = TRUE;
                    pmp_Logging("fontSystem", "Validating: $fontName ($fontPath - $fontFile)");

                    $Validate_CSSFullName = realpath($CSSFullName);

                    if ($Validate_CSSFullName != "") {
                        $checkFont = file_get_contents("$CSSFullName");
                        $checkFont = explode("\n", $checkFont);
                        $searchFont = "$fontPath/$fontName";
                        pmp_Logging("fontSystem", "Checking For: $searchFont");

                        foreach ($checkFont as $FontLine) {
                            if (strpos($FontLine, $searchFont) !== FALSE) {
                                pmp_Logging("fontSystem", "Found Existing Font: $fontName ($fontPath - $fontFile)");
                                $fontValid = FALSE;
                            }
                        }
                    }
                    else {
                        pmp_Logging("fontSystem", "No pre-existing CSS file to validate against.");
                    }

                    if ($fontValid == TRUE) {
                        // Future: Use invalidFiles array
                        if (strpos($fontFile, '._') !== FALSE) {
                            pmp_Logging("fontSystem", "[WARNING] Validating Font (._): $fontFile");
                            $fontValid = FALSE;
                        }
                    }
                    // ----

                    if ($fontValid == TRUE) {
                        pmp_Logging("fontSystem", "Adding: $fontName ($fontPath - $fontFile)");
                        GenerateCSS_FontSingle($CSSFullName, $fontPath, $fontName, $fontFile);
                    }
                    else {
                        pmp_Logging("fontSystem", "Duplicate or Invalid Font: $fontName ($fontPath - $fontFile)");
                    }
                }
            }
        }
    }
}

function GenerateCSS_Font_Stock() {
    $CSSPath = "../assets/plexmovieposter/";
    $CSSFontFileName = "fonts_stock.css";
    $FontPath = "../assets/fonts";

    GenerateCSS_Font($CSSPath, $CSSFontFileName, $FontPath);
}

function GenerateCSS_Font_Custom() {
    $CSSPath = "../cache/fonts/";
    $CSSFontFileName = "fonts_custom.css";
    $FontPath = "../cache/fonts";

    GenerateCSS_Font($CSSPath, $CSSFontFileName, $FontPath);
}

function GenerateCSS_Font_ALL() {
    GenerateCSS_Font_Stock();
    GenerateCSS_Font_Custom();
}

function findFontFamily($CSSPath = "../assets/plexmovieposter/", $CSSFile = "fonts_stock.css", $HTMLdisplay = FALSE, $HTMLdropdown = FALSE, $fieldID) {
    // $file = '../assets/plexmovieposter/fonts_stock.css';
    $file = $CSSPath . $CSSFile;
    $searchfor = 'font-family:';

    // the following line prevents the browser from parsing this as HTML.
    header('Content-Type: text/plain');

    // get the file contents, assuming the file to be readable (and exist)
    $contents = file_get_contents($file);

    // escape special characters in the query
    $pattern = preg_quote($searchfor, '/');

    // finalise the regular expression, matching the whole line
    $pattern = "/^.*$pattern.*\$/m";

    // search, and store all matching occurrences in $matches
    if(preg_match_all($pattern, $contents, $matches)){
    //    echo "Found fonts:\n";
    //    echo implode("\n", $matches[0]);

        if ($HTMLdisplay == TRUE) {
            // PHP 7.x
            displayFontFamily($searchfor, $matches[0]);
            // PHP 8.x
            // displayFontFamily(searchfor: $searchfor, fontfamilyRAW: $matches[0]);
        }

        if ($HTMLdropdown == TRUE) {
            // PHP 7.x
            dropdownFontFamily($searchfor, $matches[0], $fieldID);
            // PHP 8.x
            // dropdownFontFamily(searchfor: $searchfor, fontfamilyRAW: $matches[0], fieldID: $fieldID);
        }
    }
    else{
    //    echo "\nNo fonts found";
    }
}

function findFontFamily_Full($HTMLdisplay = FALSE, $HTMLdropdown = FALSE, $fieldID) {
    // Settings
    $CSSFontPath_Placeholder = "../assets/plexmovieposter/";
    $CSSFontFileName_Placeholder = "fonts.css";
    $CSSFontFullName_Placeholder = $CSSFontPath_Placeholder . $CSSFontFileName_Placeholder;
    $contents_0 = file_get_contents($CSSFontFullName_Placeholder);
    // echo "<br> Debug (contents_A): <br> $contents_A <br>"; // Debug MSG

    $CSSFontPath_Stock = "../assets/plexmovieposter/";
    $CSSFontFileName_Stock = "fonts_stock.css";
    $CSSFontFullName_Stock = $CSSFontPath_Stock . $CSSFontFileName_Stock;

    if (realpath($CSSFontFullName_Stock) != "") {
        $contents_1 = file_get_contents($CSSFontFullName_Stock); // TODO: Add file check to see if it exists (to fix nginx errors tail -30 /var/log/nginx/error.log)
        // echo "<br> Debug (contents_A): <br> $contents_A <br>"; // Debug MSG
    }
    else {
        $contents_1 = "";
    }

    $CSSFontPath_Custom = "../cache/fonts/";
    $CSSFontFileName_Custom = "fonts_custom.css";
    $CSSFontFullName_Custom = $CSSFontPath_Custom . $CSSFontFileName_Custom;

    if (realpath($CSSFontFullName_Custom) != "") {
        $contents_2 = file_get_contents($CSSFontFullName_Custom);
        // echo "<br> Debug (contents_B): <br> $contents_B <br>"; // Debug MSG
    }
    else {
        $contents_2 = "";
    }

    $searchfor = 'font-family:';

    // the following line prevents the browser from parsing this as HTML.
    header('Content-Type: text/plain');

    // get the file contents, assuming the file to be readable (and exist)
    // $contents = file_get_contents($file);

    $contents_Full = $contents_0;
    $contents_Full .= $contents_1;
    $contents_Full .= $contents_2;
        // echo "<br> Debug (contents_Full): <br> $contents_Full <br>"; // Debug MSG

    // escape special characters in the query
    $pattern = preg_quote($searchfor, '/');

    // finalise the regular expression, matching the whole line
    $pattern = "/^.*$pattern.*\$/m";

    $contents = $contents_Full;
        // echo "<br> Debug (contents): <br> $contents <br>"; // Debug MSG

    // search, and store all matching occurrences in $matches
    if(preg_match_all($pattern, $contents, $matches)){
    //    echo "Found fonts:\n";
    //    echo implode("\n", $matches[0]);

        if ($HTMLdisplay == TRUE) {
            // PHP 7.x
            displayFontFamily($searchfor, $matches[0]);
            // PHP 8.x
            // displayFontFamily(searchfor: $searchfor, fontfamilyRAW: $matches[0]);
        }

        if ($HTMLdropdown == TRUE) {
            // PHP 7.x
            dropdownFontFamily($searchfor, $matches[0], $fieldID);
            // PHP 8.x
            // dropdownFontFamily(searchfor: $searchfor, fontfamilyRAW: $matches[0], fieldID: $fieldID);
        }
    }
    else{
        //    echo "\nNo fonts found";
        if ($HTMLdropdown == TRUE) {
            // PHP 7.x
            dropdownFontFamily($searchfor, $matches[0], $fieldID);
            // PHP 8.x
            // dropdownFontFamily(searchfor: $searchfor, fontfamilyRAW: $matches[0], fieldID: $fieldID);
        }
    }
}

function displayFontFamily($searchfor, $fontfamilyRAW) {
    echo "<h3>Installed fonts and samples:</h3><br>";

    foreach($fontfamilyRAW as $fontfamily) {
        // Clean Up String
        $fontfamily = str_replace($searchfor,'',$fontfamily);
        $fontfamily = str_replace('"','',$fontfamily);
        $fontfamily = str_replace(';','',$fontfamily);
        $fontfamily = trim($fontfamily);

        // PHP 7.x
        displayFontFamilySub($fontfamily);
        // PHP 8.x
        // displayFontFamilySub(fontfamily: $fontfamily);
    }
}

function displayFontFamilySub($fontfamily) {
    $set_Inline = TRUE;

    if ($set_Inline == TRUE) {
        $displayInline = "display: inline;";
    }
    else {
        $displayInline = "";
    }

    $fontSample[0] = "Sample";
    $fontSample[1] = "The quick brown fox jumps over the lazy dog";

    echo "<div class=\"form-group\">\n";
    echo "$fontfamily:&nbsp;\n";
    echo "<div style=\"font-family: '$fontfamily'; font-size: 20px; $displayInline\">\n";
    echo "$fontSample[1]\n";
    echo "</div>\n";
    echo "</div>\n";
}

function dropdownFontFamily($searchfor, $fontfamilyRAW, $fieldID = "customTopFontID", $showFontSample = FALSE) {

    if ($showFontSample == TRUE) {
        $HTMLStyle = "style=\"font-size: 20px;\"";
    }
    else {
        $HTMLStyle = "";
    }

    if ($$fieldID == none) {
        $HTMLSelect = "selected";
    }
    else {
        $HTMLSelect = "";
    }

    echo "<select id=\"\" name=\"$fieldID\" $HTMLStyle>\n";

    $fontfamily = "None";
    echo "<option value=\"$fontfamily\" $HTMLStyle $HTMLSelect>";
    echo "$fontfamily";
    echo "</option>\n";

    foreach($fontfamilyRAW as $fontfamily) {
        // Clean Up String
        $fontfamily = str_replace($searchfor,'',$fontfamily);
        $fontfamily = str_replace('"','',$fontfamily);
        $fontfamily = str_replace(';','',$fontfamily);
        $fontfamily = trim($fontfamily);

        // PHP 7.x
        dropdownFontFamilySub($fontfamily, $fieldID, $showFontSample);
        // PHP 8.x
        // dropdownFontFamilySub3(fontfamily: $fontfamily, fieldID: $fieldID);

    }
    echo "</select>";
}

function dropdownFontFamilySub($fontfamily, $fieldID, $showFontSample = FALSE) {
    include '../config.php';

    if ($showFontSample == TRUE) {
        $HTMLStyle = "style=\"font-family: '$fontfamily';\"";
    }
    else {
        $HTMLStyle = "";
    }

    if ($$fieldID == $fontfamily) {
        $HTMLSelect = "selected";
    }
    else {
        $HTMLSelect = "";
    }

    echo "<option value=\"$fontfamily\" $HTMLStyle $HTMLSelect>";
    echo "$fontfamily";
    echo "</option>\n";
}

// LOOK AT MOVING FONT CACHE FUNCTIONS TO THIS FILE (2021-03-12)

function FontDirCleanup($source = "../cache/fonts/", $ScanSubDir = TRUE) {
    $invalidDirs = array('__MACOSX');
    $invalidFiles = array('._');

    if ($ScanSubDir == TRUE) {
        // Multi Level
        //Remove: Directories
        $dir_iterator = new RecursiveDirectoryIterator($source);
        $files = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file) {
            $file_parts = pathinfo($file);
            foreach ($invalidDirs as $invalidDir) {
                $setMatch = '#(' . $invalidDir . ')#i';

                if (preg_match($setMatch,$file_parts['dirname'])) {
                    $fontPath = $file_parts['dirname'];
                    $fontPath = realpath($fontPath);

                    pmp_Logging("fontSystem", "Remove invalid font folder: $fontPath");

                    if (is_dir($fontPath)) {
                        $objects = scandir($fontPath);
                        foreach ($objects as $object) {
                          if ($object != "." && $object != "..") {
                            if (is_dir($fontPath. DIRECTORY_SEPARATOR .$object) && !is_link($fontPath."/".$object)) {
                                pmp_Logging("fontSystem", "\tPurge empty directory");
                                rmdir($fontPath. DIRECTORY_SEPARATOR .$object);
                            }
                            else {
                                pmp_Logging("fontSystem", "\tPurge files from directory.");
                                unlink($fontPath. DIRECTORY_SEPARATOR .$object);
                            }
                          }
                        }
                        rmdir($fontPath);
                    }
                }
            }
        }

        //Remove: Files // FUTURE
        $dir_iterator = new RecursiveDirectoryIterator($source);
        $files = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file) {
            $file_parts = pathinfo($file);
            foreach ($invalidFiles as $invalidFile) {
                $setMatch = '#(' . $invalidFile . ')#i';

                if (strpos($file_parts['filename'],$setMatch) !== FALSE) {
                    $fontPath = $file_parts['filename'];
                    $fontPath = realpath($fontPath);

                    pmp_Logging("fontSystem", "Remove invalid font file: $fontPath");
                    // ADD UNLINK
                }
            }
        }

    }
    else {
        // Single Level
        $files = glob("$source/*");
        foreach ($files as $file) {
            if (is_file($file)) {
                pmp_Logging("fontSystem", "Removing Font  - TEST: $file");
                // // // unlink($file);
            }
        }
    }
}

function FontExtRename($source = "../cache/fonts/", $ScanSubDir = TRUE) {
    $fontExtList = array("ttf","otf","eot","woff","svg");

    if ($ScanSubDir == TRUE) {
        // Multi Level
        $dir_iterator = new RecursiveDirectoryIterator($source);
        $files = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file) {
            if (is_file($file)) {
                $file_parts = pathinfo($file);
                foreach ($fontExtList as $fontExt) {
                    $setMatch = '#(' . $fontExt . ')#i';

                    if (preg_match($setMatch,$file_parts['extension'])) {
                        $fontPath = $file_parts['dirname'];
                        $fontPath = str_replace('..','',$fontPath);
                        $fontName = $file_parts['filename'];
                        $fontFile = $file_parts['filename'];
                        $fontExtension = $file_parts['extension'];

                        if (ctype_upper($fontExtension)) {
                            pmp_Logging("fontSystem", "Invalid Font Ext: $fontFile ($fontExtension)");

                            $UpdateFont_PRE = realpath($file);
                            pmp_Logging("fontSystem", "\tUpdate Font (PRE): $UpdateFont_PRE");

                            $UpdateFont_POST = str_replace($fontExtension, strtolower($fontExtension), $UpdateFont_PRE);
                            pmp_Logging("fontSystem", "\tUpdate Font (POST): $UpdateFont_POST");

                            rename($UpdateFont_PRE, $UpdateFont_POST);
                        }
                        else {
                            pmp_Logging("fontSystem", "Valid Font Ext: $fontFile ($fontExtension)");
                        }
                    }
                }
            }
        }
    }
    else {
        // Single Level
        $files = glob("$source/*");
        foreach ($files as $file) {
            if (is_file($file)) {
                pmp_Logging("fontSystem", "Rename Font: $file");
                // // // unlink($file);
            }
        }
    }

}

?>