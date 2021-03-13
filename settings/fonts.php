<?php
//For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
include_once('../assets/plexmovieposter/loginCheck.php');
include '../assets/plexmovieposter/CommonLib.php';
require_once '../assets/plexmovieposter/tools.php';
include '../assets/plexmovieposter/CacheLib.php';
include '../assets/plexmovieposter/setData.php';
include '../config.php';
include '../assets/plexmovieposter/FontLib.php';
include '../assets/plexmovieposter/importExportLib.php';

//Save Configuration
if (!empty($_POST['saveConfig'])) {
    setData(basename(__FILE__));
}

$rootDir = "../";
$exportFileName = "FontArchive_Custom.zip";

GenerateCSS_Font_ALL();
exportFiles_DownloadLink("DownloadLink", "$rootDir/cache/archive", "$exportFileName");

if (isset($_POST["btn_zipDL"])) {
    exportFiles("$rootDir/cache/fonts", "$rootDir/cache/archive", "$exportFileName", "zip", TRUE);
}

if (isset($_POST["btn_zip"])) {
    importFiles("zip_file");
}

?>

<!doctype html>
<html lang="en">
<head>
    <?php HeaderInfo(basename(__FILE__)); ?>
    <script> ShowHideAdvanced(); </script>
</head>

<body>
    <div id="plex" class="application">
        <div class="background-container">
            <div class="settings-core"></div>
        </div>
        <?php NavBar() ;?>
        <div id="content" class="scroll-container dark-scrollbar">
            <div class="FullPage-container-17Y0cs">
                <?php sidebarInfo(basename(__FILE__)) ;?>
                <div class="Page-page-aq7i_X Scroller-scroller-3GqQcZ Scroller-vertical-VScFLT  ">
                    <div id="MainPage" class="SettingsPage-content-1vKVEr PageContent-pageContent-16mK6G">
                        <h2 class="SettingsPageHeader-header-1ugtIL">
                            Font Configuration
                        </h2>
                        <?php AdvancedBar() ;?>
                        <form id="server-settings-form" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                            <!-- SEGMENT BLOCK START -->
                                <div class="form-group">
                                    <form action="fonts.php" method="post" enctype="multipart/form-data">
                                        Import Font or Bundle:
                                        <label for="zip_file" class="btn btn-sm btn-faux">
                                            Browse File
                                        </label>
                                        <input type="file" name="zip_file" id="zip_file" accept=".zip,.ttf,.pmp" class="field-hideInput" onchange="showName_zip()">

                                        <p>
                                            <div id="UploadFileName_Zip" style="font-size: smaller;">
                                                Upload File:
                                                <i>None</i>
                                            </div>
                                        </p>

                                        <label for="btn_zip" class="btn btn-sm btn-faux">
                                            Upload File
                                        </label>
                                        <input type="submit" value="Upload Zip" name="btn_zip" id="btn_zip" class="field-hideInput">
                                    </form>

                                    <!-- <p class="help-block">
                                    </p> -->
                                </div>

                                <div class="form-group">
                                    <hr>
                                    <form method="post" enctype="multipart/form-data">
                                        Download Bundle:
                                        <label for="btn_zipDL" class="btn btn-sm btn-faux">
                                            Generate Bundle
                                        </label>
                                        <input type="submit" value="Generate Zip" name="btn_zipDL" id="btn_zipDL" class="field-hideInput">
                                    </form>

                                    <br>

                                    <?php
                                        if (isset($DownloadLink)) {
                                            echo $DownloadLink;
                                        }
                                    ?>

                                    <!-- <p class="help-block">
                                    </p> -->
                                </div>

                                <div class="form-group">
                                    <hr>
                                    <?php
                                        // PHP 7.x
                                        // findFontFamily("../assets/plexmovieposter/", "fonts_stock.css", TRUE, FALSE, "");
                                        // findFontFamily("../cache/fonts/", "fonts_custom.css", TRUE, FALSE, "");
                                        findFontFamily_Full(TRUE, FALSE, "");
                                        // PHP 8.x
                                        // findFontFamily(CSSPath: "../assets/plexmovieposter/", CSSFile: "fonts_stock.css", HTMLdisplay: TRUE, HTMLdropdown: FALSE);
                                        // findFontFamily(CSSPath: "../cache/fonts/", CSSFile: "fonts_custom.css", HTMLdisplay:TRUE, HTMLdropdown:FALSE);

                                    ?>
                                </div>
                            <!-- SEGMENT BLOCK END -->

                            <!-- GHOST BLOCK START -->
                            <!-- GHOST BLOCK END -->

                            <!-- SUBMIT BLOCK START -->
                                <!-- <?php submitForm(FALSE); ?> -->
                            <!-- SUBMIT BLOCK END -->
                        </form>
                        <?php FooterInfo() ; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
