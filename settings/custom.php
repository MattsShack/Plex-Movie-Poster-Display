<?php
//For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
include_once('../assets/plexmovieposter/loginCheck.php');
include '../assets/plexmovieposter/setData.php';
include 'PMPInfo.php';
include 'PMPReleaseNotes.php';
include '../assets/plexmovieposter/CommonLib.php';
include '../config.php';

//Save Configuration
if (!empty($_POST['saveConfig'])) {
    setData(basename(__FILE__));
}

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
        <div class="nav-bar">
            <div class="NavBar-container-1T0BJz">
                <div class="NavBar-left-2SrTGf NavBar-side-2kZrHV">
                    <a id="id-261" aria-label="Home" data-uid="id-262" href="../index.php" role="link" class="NavBar-button-diriIs NavBarIconButton-button-eR0v0j IconButton-button-9An-7I Link-link-2n0yJn Link-default-2XA2bN     ">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 560 560" id="plex-icon-navbar-home-560" aria-hidden="true" class="PlexIcon-plexIcon-8Tamaj NavBarIconButton-icon-2gdVPu">
                        <path d="M84 448V291.598a28 28 0 0 1 8.201-19.799L280 84l187.799 187.799A28 28 0 0 1 476 291.598V448c0 15.464-12.536 28-28 28H322V336h-84v140H112c-15.464 0-28-12.536-28-28z">
                        </path>
                        </svg>
                    </a>
                    <a data-uid="id-2" href="#" role="link" class="NavBar-plexLogo-3_NNRw NavBarIconButton-button-eR0v0j IconButton-button-9An-7I Link-link-2n0yJn Link-default-2XA2bN     ">
                    </a>
                </div>
            </div>
        </div>
        <div id="content" class="scroll-container dark-scrollbar">
            <div class="FullPage-container-17Y0cs">
                <div class="Measure-container-3yONEe">
                    <?php sidebarInfo(basename(__FILE__)) ;?>
                </div>
                <div class="Page-page-aq7i_X Scroller-scroller-3GqQcZ Scroller-vertical-VScFLT  ">
                    <div id="MainPage" class="SettingsPage-content-1vKVEr PageContent-pageContent-16mK6G">
                        <h2 class="SettingsPageHeader-header-1ugtIL">
                            Custom Images Configuration
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
                                        Custom Image Upload:

                                        <input type="file" class="form-control"
                                            id="customImageUpload" name="customImageUpload"
                                            value="">

                                        <!-- <p class="help-block">
                                        </p> -->
                                    </div>

                                    <div class="form-group">
                                        Custom Image State: &nbsp;
                                        <select  style="display: inline;"
                                            id="customImageEnabled" name="customImageEnabled">
                                            <option value="Disabled" <?php if ($customImageEnabled == 'Disabled') {
                                                echo "selected";
                                            } ?>>Disabled
                                            </option>
                                            <option value="Enabled" <?php if ($customImageEnabled == 'Enabled') {
                                                echo "selected";
                                            } ?>>Enabled
                                            </option>
                                        </select>

                                        <!-- <p class="help-block">
                                        </p> -->
                                    </div>

                                    <div class="form-group">
                                        Custom Image Select:&nbsp;

                                        <select style="display: inline;"
                                            id="customImage" name="customImage">
                                            <option value="" <?php if ($customImage == '') {
                                                echo "selected";
                                            } ?>>None
                                            </option>
                                            <?php
                                            $path = "cache/custom";
                                            $files = array_diff(scandir($path), array('.', '..'));
                                            foreach ($files as $file) {
                                                echo "<option value='$file'";
                                                if ($customImage == $file) {
                                                    echo "selected";
                                                }
                                                echo ">$file</option>";
                                            }
                                            ?>
                                        </select>

                                        <!-- <p class="help-block">
                                        </p> -->
                                    </div>

                                    <div class="form-group">
                                        <hr>
                                        <h3>Top Text Option:</h3>
                                    </div>

                                    <div class="form-group">
                                        Custom Top Text:

                                        <input type="text" class="form-control"
                                            id="customTopText" name="customTopText"
                                            placeholder="Custom Image Top Text"
                                            value="<?php echo $customTopText; ?>">

                                        <p class="help-block">
                                            <small>Optional</small>
                                        </p>
                                    </div>

                                    <div class="form-group advanced-setting row">
                                        <div class="col-md-6 mb-3">
                                            Top Font Size:

                                            <input type="text" class="form-control"
                                                id="customTopFontSize" name="customTopFontSize"
                                                value="<?php echo $customTopFontSize; ?>">

                                            <p class="help-block">
                                                px
                                            </p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            Top Font Color:

                                            <input type="text" class="form-control"
                                                id="customTopFontColor" name="customTopFontColor"
                                                data-position="bottom left"
                                                value="<?php echo $customTopFontColor; ?>">

                                            <!-- <p class="help-block">
                                            </p> -->
                                        </div>

                                        <script>
                                            $(function () {
                                                $('#customTopFontColor').colorpicker();
                                                $('#customTopFontColor').on('colorpickerChange', function (event) {
                                                    $('.jumbotron').css('background-color', event.color.toString());
                                                });
                                            });
                                        </script>
                                    </div>

                                    <div class="form-group advanced-setting row">
                                        <div class="col-md-6 mb-3">
                                            Top Font Outline Size:

                                            <input type="text" class="form-control"
                                                id="customTopFontOutlineSize" name="customTopFontOutlineSize"
                                                value="<?php echo $customTopFontOutlineSize; ?>">

                                            <p class="help-block">
                                                px
                                            </p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            Top Font Outline Color:

                                            <input type="text" class="form-control"
                                                id="customTopFontOutlineColor" name="customTopFontOutlineColor"
                                                data-position="bottom left"
                                                value="<?php echo $customTopFontOutlineColor; ?>">

                                            <!-- <p class="help-block">
                                            </p> -->
                                        </div>

                                        <script>
                                            $(function () {
                                                $('#customTopFontOutlineColor').colorpicker();
                                                $('#customTopFontOutlineColor').on('colorpickerChange', function (event) {
                                                    $('.jumbotron').css('background-color', event.color.toString());
                                                });
                                            });
                                        </script>
                                    </div>

                                    <div class="form-group">
                                        <hr>
                                        <h3>Bottom Text Option:</h3>
                                    </div>

                                    <div class="form-group">
                                        Custom Bottom Text:

                                        <input type="text" class="form-control"
                                            id="customBottomText" name="customBottomText"
                                            placeholder="Coming Soon Top Text"
                                            value="<?php echo $customBottomText; ?>">

                                        <p class="help-block">
                                            <small>Optional</small>
                                        </p>
                                    </div>

                                    <div class="form-group advanced-setting row">
                                        <div class="col-md-6 mb-3">
                                            Bottom Font Size:

                                            <input type="text" class="form-control"
                                                id="customBottomFontSize" name="customBottomFontSize"
                                                value="<?php echo $customBottomFontSize; ?>">

                                            <p class="help-block">
                                                px
                                            </p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            Bottom Font Color:

                                            <input type="text" class="form-control"
                                                id="customBottomFontColor" name="customBottomFontColor"
                                                data-position="bottom left"
                                                value="<?php echo $customBottomFontColor; ?>">

                                            <!-- <p class="help-block">
                                            </p> -->
                                        </div>

                                        <script>
                                            $(function () {
                                                $('#customBottomFontColor').colorpicker();
                                                $('#customBottomFontColor').on('colorpickerChange', function (event) {
                                                    $('.jumbotron').css('background-color', event.color.toString());
                                                });
                                            });
                                        </script>
                                    </div>

                                    <div class="form-group advanced-setting row">
                                        <div class="col-md-6 mb-3">
                                            Bottom Font Outline Size:

                                            <input type="text" class="form-control"
                                                id="customBottomFontOutlineSize" name="customBottomFontOutlineSize"
                                                value="<?php echo $customBottomFontOutlineSize; ?>">

                                            <p class="help-block">
                                                px
                                            </p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            Bottom Font Outline Color:

                                            <input type="text" class="form-control"
                                                id="customBottomFontOutlineColor" name="customBottomFontOutlineColor"
                                                data-position="bottom left"
                                                value="<?php echo $customBottomFontOutlineColor; ?>">

                                            <!-- <p class="help-block">
                                            </p> -->
                                        </div>

                                        <script>
                                            $(function () {
                                                $('#customBottomFontOutlineColor').colorpicker();
                                                $('#customBottomFontOutlineColor').on('colorpickerChange', function (event) {
                                                    $('.jumbotron').css('background-color', event.color.toString());
                                                });
                                            });
                                        </script>
                                    </div>
                                <!-- SEGMENT BLOCK END -->

                                <!-- GHOST BLOCK START -->
                                    <?php ghostData(basename(__FILE__)) ;?>
                                <!-- GHOST BLOCK END -->

                                <div class="form-footer">
                                    <!-- <button name="saveConfig" class="submit-btn btn btn-lg btn-primary btn-loading disabled" type="submit" value="saveConfig"> -->
                                    <button name="saveConfig" class="submit-btn btn btn-lg btn-primary btn-loading " type="submit" value="saveConfig">
                                        <div class="loading loading-sm"></div>
                                        <span class="btn-label">SAVE CHANGES</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>