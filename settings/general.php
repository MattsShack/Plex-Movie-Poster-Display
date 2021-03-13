<?php
//For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
include_once('../assets/plexmovieposter/loginCheck.php');
include '../assets/plexmovieposter/CommonLib.php';
require_once '../assets/plexmovieposter/tools.php';
include '../assets/plexmovieposter/CacheLib.php';
include '../assets/plexmovieposter/setData.php';
include '../config.php';
include '../assets/plexmovieposter/importExportLib.php';
include 'PMPInfo.php';
include 'PMPReleaseNotes.php';

$CurrentPage = basename(__FILE__);

//Save Configuration
if (!empty($_POST['saveConfig'])) {
    setData(basename(__FILE__));
}

//Count Items in Posters
// PosterCache();
GeneralCache_Count("../cache/posters/", "posterCount");

//Clear Poster Cache Directory
if (!empty($_POST['clearPosterCache'])) {
    PosterCacheClear();
    header("Location: $CurrentPage");
}

//Count Items in Custom Images
// CustomCacheCount();
GeneralCache_Count("../cache/custom/", "customCount");

//Clear Custom Cache Directory
if (!empty($_POST['clearCustomCache'])) {
    CustomCacheClear();
    header("Location: $CurrentPage");
}

//Count Items in Custom Fonts
FontCacheCount();

//Clear Custom Font Cache Directory
if (!empty($_POST['clearFontCache'])) {
    FontCacheClear();
    header("Location: $CurrentPage");
}

if (!empty($_GET['file'])) {
    exportFiles_Config(basename($_GET['file']));
}

if(!empty($_POST['pmplogout'])) {
    header("Location: ../assets/plexmovieposter/logout.php");
}

importFiles_Config();

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
                            <?php echo gethostname(); ?>
                            <span class="hyphenSpace">—</span>
                            General
                        </h2>
                        <?php AdvancedBar() ;?>
                        <form id="server-settings-form" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                            <!-- SEGMENT BLOCK START -->
                                <div class="form-group">
                                    <div>
                                        <span class="infoString">Server signed in as:&nbsp</span>
                                        <span class="infoUser"><?php echo $pmpUsername?></span>
                                    </div>

                                    <form method="post" class="needs-validation" novalidate>
                                        <button name="pmplogout" id="pmplogout" role="button" class="btn btn-sm" value="pmplogout">
                                            Sign Out
                                        </button>
                                    </form>
                                </div>

                                <div class="form-group">
                                    <h4 class="btn-inline">
                                        Version: <?php echo $version;?>&nbsp
                                    </h4>

                                    <button name="linkUpdate" id="linkUpdate" class="btn btn-sm" onclick="window.open('https://github.com/MattsShack/Plex-Movie-Poster-Display/tree/dev')">
                                        Download Updates
                                    </button>
                                </div>

                                <div class="form-group">
                                    <hr>
                                    <h4>
                                        Statistics:
                                    </h4>
                                </div>

                                <div class="form-group">
                                    <?php CacheInfo_Display(); ?>
                                </div>

                                <div class="form-group advanced-setting">
                                    <hr>
                                    <h4>
                                        Configuration Settings:
                                    </h4>
                                </div>

                                <div class="form-group advanced-setting">
                                    Export Configuration:

                                    <button name="exportConfig" id="exportConfig" class="btn btn-sm" onclick="document.location='general.php?file=config.php'">
                                        Export Configuration
                                    </button>

                                    <p class="help-block">
                                        <small class="text-muted">Export current configuration file (config.php)</small>
                                    </p>
                                </div>

                                <div class="form-group advanced-setting">
                                    <form action="general.php" method="post" enctype="multipart/form-data">
                                        Import Configuration:
                                        <label for="fileToUpload" class="btn btn-sm btn-faux">
                                            Browse Configuration
                                        </label>
                                        <input type="file" name="fileToUpload" id="fileToUpload" accept=".php" class="field-hideInput" onchange="showName()">
                                        
                                        <p class="help-block">
                                            <small class="text-muted">Select configuration file to restore (config.php)</small>
                                        </p>

                                        <p>
                                            <div id="configFileName" style="font-size: smaller;">
                                                Restore Configuration File:
                                                <i>None</i>
                                            </div>
                                        </p>
                                        
                                        Restore Configuration:
                                        <label for="submitConfig" class="btn btn-sm btn-faux btn-danger">
                                            Restore Configuration
                                        </label>
                                        <input type="submit" value="Restore Configuration" name="restoreConfig" id="submitConfig" style="opacity: 0;">
                                        
                                        <p class="help-block">
                                            <small class="text-muted">Restore selected configuration file (config.php)</small>
                                        </p>
                                    </form>
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
