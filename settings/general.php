<?php
//For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
include_once('../assets/plexmovieposter/loginCheck.php');
include '../assets/plexmovieposter/setData.php';
include 'PMPInfo.php';
include 'PMPReleaseNotes.php';
include '../assets/plexmovieposter/CommonLib.php';
include '../config.php';

$CurrentPage = basename(__FILE__);

//Save Configuration
if (!empty($_POST['saveConfig'])) {
    setData(basename(__FILE__));
}

//Count Items in Posters
PosterCache();

//Clear Poster Cache Directory
if (!empty($_POST['clearPosterCache'])) {
    PosterCacheClear();
    header("Location: $CurrentPage");
}

//Count Items in Custom Images
CustomCache();

//Clear Custom Cache Directory
if (!empty($_POST['clearCustomCache'])) {
    CustomCacheClear();
    header("Location: $CurrentPage");
}

if (!empty($_GET['file'])) {
    exportConfig(basename($_GET['file']));
}

if(!empty($_POST['pmplogout'])) {
    header("Location: logout.php");
}

uploadConfig();

?>

<!doctype html>
<html lang="en">
<head>
    <?php HeaderInfo(basename(__FILE__)); ?>
    <script> ShowHideAdvanced(); </script>
</head>

<body class="bg-light">
    <div id="plex" class="application">
        <div class="background-container">
            <div class="FullPage-container-17Y0cs">
                <div>
                    <div style="position: absolute; width: 100%; height: 100%;">
                        <div class=" CrossFadeImage-crossFade-10Sndv" style="position: absolute; animation-duration: 600ms; background-image: url(&quot;/../assets/images/Plex/backgrounds/preset-dark.png&quot;); width: 100%; height: 100%; background-size: cover; background-position: center center; background-repeat: no-repeat;"></div>
                    </div>
                    <div style="position: absolute; width: 100%; height: 100%; background: url(&quot;/../assets/images/Plex/backgrounds/noise.png&quot;); z-index: 2;"></div>
                </div>
            </div>
        </div>
        <?php NavBar() ;?>
        <div id="content" class="scroll-container dark-scrollbar">
            <div class="FullPage-container-17Y0cs">
                <div class="Measure-container-3yONEe">
                    <?php sidebarInfo(basename(__FILE__)) ;?>
                </div>
                <div class="Page-page-aq7i_X Scroller-scroller-3GqQcZ Scroller-vertical-VScFLT  ">
                    <div id="MainPage" class="SettingsPage-content-1vKVEr PageContent-pageContent-16mK6G">
                        <h2 class="SettingsPageHeader-header-1ugtIL">
                            <?php echo gethostname(); ?>
                            <span class="DashSeparator-separator-4CyEFW">—</span>
                            General
                        </h2>
                        <div>
                        <div class="server-settings-container show-advanced">
                            <div class="filter-bar">
                                <div class="filter-bar-right">
                                    <input class="toggle-advanced-btn btn btn-sm btn-default advanced-settingButton" type="button" value="SHOW ADVANCED"></input>
                                </div>
                            </div>
                        </div>
                            <form id="server-settings-form" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                                <!-- SEGMENT BLOCK START -->
                                    <div class="form-group">
                                        <div class="ClaimedServer-container-3O6-1n">
                                            <div class="ServerAvatar-avatar-2VGH0z">
                                                <div class="AvatarImg-avatar-3Op56u">
                                                    <div style="width: 60px; height: 60px; background-image: url(&quot;blob:&quot;); background-size: cover; background-position: center center; background-repeat: no-repeat;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ClaimedServer-message-1yZ-wd">
                                            <div class="ClaimedServer-messageHeader-3uzatL">Server signed in as</div>
                                            <div class="ClaimedServer-messageDetails-3lEkVI"><?php echo $pmpUsername?></div>
                                        </div>
                                        <form method="post" class="needs-validation" novalidate>
                                            <button id="pmplogout" name="pmplogout" value="pmplogout" role="button" class="ClaimedServer-button-36k0Q0 SpinnerButton-button-1A8EcL Button-button-2kT68l Link-link-2n0yJn SpinnerButton-button-1A8EcL Button-button-2kT68l Link-link-2n0yJn  Button-button-2kT68l Link-link-2n0yJn Button-default--yDCH5 Button-medium-3g45_Q Link-link-2n0yJn Link-default-2XA2bN     ">
                                                <span class="SpinnerButton-spinnerContainer-1NdZWc">
                                                    <div class="SpinnerButton-spinner-1TgDPI Spinner-spinner-Niere7 spin-spin-2kLwt_ Spinner-small-3PStHE Spinner-spinner-Niere7 spin-spin-2kLwt_" aria-label="Loading" style="border-top-color: rgb(255, 255, 255); border-left-color: rgb(255, 255, 255);">
                                                    </div>
                                                </span>
                                                <span class="SpinnerButton-label-qxG01S">Sign Out</span>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="form-group ">
                                        <h4 class="version-header">
                                            <span class="version">Version <?php echo $version;?></span>
                                            <span class="update-region">
                                                <span class="check-for-updates-container has-release-notes available">
                                                    <a href="#" class="check-for-updates-btn label label-btn label-primary active">
                                                        <i class="label-icon glyphicon upload"></i>
                                                        Check for Updates
                                                    </a>
                                                    <a href="#" class="checking-for-updates-btn label label-btn label-primary active">
                                                        <i class="label-icon glyphicon upload"></i>
                                                        Checking for Updates
                                                    </a>
                                                    <a href="https://github.com/MattsShack/Plex-Movie-Poster-Display/tree/dev" class="available-updates-btn label label-btn label-primary" target="_blank">
                                                        <i class="label-icon glyphicon download"></i>
                                                        Download Updates
                                                    </a>
                                                    <!-- <a href="#" class="available-updates-btn label label-btn label-primary">
                                                        <i class="label-icon glyphicon download"></i>
                                                        Download Updates
                                                    </a>
                                                    <span class="downloading-updates-container label label-btn label-progress active">
                                                        <i class="label-icon glyphicon download"></i>
                                                        Downloading Update
                                                        <span class="downloading-progress-container hidden">
                                                            (
                                                            <span class="downloading-progress-label"></span>
                                                            %)
                                                            </span>
                                                        </span>
                                                    <a href="#" class="install-updates-btn label label-btn label-primary">
                                                        <i class="label-icon glyphicon download"></i>
                                                        Install Update
                                                    </a>
                                                    <a href="#" class="installing-updates-btn label label-btn label-primary active">
                                                        <i class="label-icon glyphicon upload"></i>
                                                        Installing
                                                    </a>
                                                    <span class="install-info-label up-to-date-label">
                                                        <i class="success-icon glyphicon ok-2"></i>
                                                        Up to date
                                                    </span>
                                                    <span class="install-info-label install-error-label">
                                                        <i class="failure-icon glyphicon circle-exclamation-mark"></i>
                                                        <span class="update-error-message"></span>
                                                        <a class="install-manual-link" href="https://github.com/MattsShack/Plex-Movie-Poster-Display/tree/dev" target="_blank">Please install manually.</a>
                                                    </span>  -->
                                                    <!-- NOTE: What's New option coming soon -->
                                                    <!-- <a href="#" class="release-notes-btn label label-btn label-default">
                                                        <i class="label-icon glyphicon circle-info"></i>
                                                        What's New
                                                    </a> -->
                                                </span>
                                            </span>
                                        </h4>
                                    </div>

                                    <div class="form-group">
                                        <hr>
                                        <h4>
                                            Statistics:
                                        </h4>
                                    </div>

                                    <div class="form-group">
                                        Posters:

                                        <div style="display: inline; padding-left:8.75em">
                                            <?php echo $posterCount; ?>
                                        </div>

                                        <form method="post" class="needs-validation" novalidate style="display: inline; padding-left:5em">
                                            <label for="clearPosterCache" style="cursor: pointer;">
                                                <div class= "label label-btn label-primary">
                                                    <i class="label-icon glyphicon remove circle"></i>
                                                    Clear Cache
                                                </div>
                                            </label>
                                            <button name="clearPosterCache" id="clearPosterCache" type="submit" class="btn btn-danger btn-sm" value="clearPosterCache" style="opacity: 0; display: inline;">
                                                Clear
                                            </button>
                                        </form>

                                        <p class="help-block">
                                            <small class="text-muted">Items in cache/posters</small>
                                        </p>
                                    </div>

                                    <div class="form-group">
                                        Custom Images:

                                        <div style="display: inline; padding-left:5em">
                                            <?php echo $customCount; ?>
                                        </div>

                                        <form method="post" class="needs-validation" novalidate style="display: inline; padding-left:5em">
                                            <label for="clearPosterCache" style="cursor: pointer;">
                                                <div class= "label label-btn label-primary">
                                                    <i class="label-icon glyphicon remove circle"></i>
                                                    Clear Cache
                                                </div>
                                            </label>
                                            <button name="clearPosterCache" id="clearPosterCache" type="submit" class="btn btn-danger btn-sm" value="clearPosterCache" style="opacity: 0; display: inline;">
                                                Clear
                                            </button>
                                        </form>

                                        <p class="help-block">
                                            <small class="text-muted">Items in cache/custom</small>
                                        </p>
                                    </div>

                                    <div class="form-group">
                                        Free Space:

                                        <div style="display: inline; padding-left:5em">
                                            <?php echo fixupSize(disk_free_space("/")); ?>
                                        </div>

                                        <p class="help-block">
                                            <small class="text-muted">Free space on /</small>
                                        </p>
                                    </div>

                                    <div class="format-group advanced-setting">
                                        <hr>
                                        <h4>
                                            Configuration Settings:
                                        </h4>
                                    </div>

                                    <div class="format-group advanced-setting">
                                        Export Configuration:
                                        <br>

                                        <a href="general.php?file=config.php" class="available-updates-btn label label-btn label-primary">
                                            <i class="label-icon glyphicon download"></i>
                                            Export Configuration
                                        </a>

                                        <p class="help-block">
                                            <small class="text-muted">Export Current Configuration</small>
                                        </p>
                                    </div>

                                    <div class="format-group advanced-setting">
                                        Import Configuration:

                                        <form action="general.php" method="post" enctype="multipart/form-data">
                                            <label for="fileToUpload" style="cursor: pointer;">
                                                <div class= "label label-btn label-primary">
                                                    <i class="label-icon glyphicon file"></i>
                                                    Browse Configuration
                                                </div>
                                            </label>

                                            <input type="file" name="fileToUpload" id="fileToUpload" accept=".php" style="opacity: 0; display: inline;" onchange="showName()">

                                            <p>
                                                <div id="configFileName" style="font-size: smaller;">
                                                    Restore Configuration File:
                                                    <i>None</i>
                                                </div>
                                            </p>                                            

                                            <label for="submitConfig" style="cursor: pointer;">
                                                <div class= "label label-btn label-primary">
                                                    <i class="label-icon glyphicon upload"></i>
                                                    Restore Configuration
                                                </div>
                                            </label>
                                            <input type="submit" value="Restore Configuration" name="restoreConfig" id="submitConfig" style="opacity: 0;">
                                        </form>
                                    </div>
                                <!-- SEGMENT BLOCK END -->

                                <!-- GHOST BLOCK START -->
                                <!-- GHOST BLOCK END -->

                                <div class="form-footer">
                                    <!-- <button name="saveConfig" class="submit-btn btn btn-lg btn-primary btn-loading " type="submit" value="saveConfig">
                                        <div class="loading loading-sm"></div>
                                        <span class="btn-label">SAVE CHANGES</span>
                                    </button> -->
                                </div>
                            </form>
                        </div>
                        <?php FooterInfo() ; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
