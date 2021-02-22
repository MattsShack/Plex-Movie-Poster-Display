<?php
//For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
include_once('../assets/plexmovieposter/loginCheck.php');
include '../assets/plexmovieposter/CommonLib.php';
include '../assets/plexmovieposter/setData.php';
include '../config.php';
include '../assets/plexmovieposter/FontLib.php';

//Save Configuration
if (!empty($_POST['saveConfig'])) {
    setData(basename(__FILE__));
}

GenerateCSS_Font_ALL();

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

                                            <label for="customTopFontColorPicker" style="cursor: pointer;">
                                                <div class= "label label-btn label-primary">
                                                    <i class="label-icon glyphicon tint"></i>
                                                    Browse Colors
                                                </div>
                                            </label>

                                            <input type="color" name="customTopFontColorPicker" id="customTopFontColorPicker" style="opacity: 0; display: inline;"
                                                value="<?php echo $customTopFontColor; ?>"
                                                onchange="setColor('customTopFontColorPicker', 'customTopFontColor')">

                                            <!-- <p class="help-block">
                                            </p> -->
                                        </div>
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

                                            <label for="customTopFontOutlineColorPicker" style="cursor: pointer;">
                                                <div class= "label label-btn label-primary">
                                                    <i class="label-icon glyphicon tint"></i>
                                                    Browse Colors
                                                </div>
                                            </label>

                                            <input type="color" name="customTopFontOutlineColorPicker" id="customTopFontOutlineColorPicker" style="opacity: 0; display: inline;"
                                                value="<?php echo $customTopFontOutlineColor; ?>"
                                                onchange="setColor('customTopFontOutlineColorPicker', 'customTopFontOutlineColor')">

                                            <!-- <p class="help-block">
                                            </p> -->
                                        </div>
                                    </div>

                                    <div class="form-group advanced-setting row">
                                        <div class="col-md-6 mb-3">
                                            <input type="checkbox" name="customTopFontEnabled" id="customTopFontEnabled" value="1" <?php if ($customTopFontEnabled) echo " checked"?>>
                                            Use Custom Font (Top)

                                            <!-- <p class="help-block">
                                            </p> -->
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            Custom Font (Top): &nbsp;
                                            <?php
                                                // PHP 7.x
                                                findFontFamily_Full(FALSE, TRUE, "customTopFontID");
                                                // PHP 8.x
                                                //findFontFamily(CSSPath: "../assets/plexmovieposter/", CSSFile: "fonts_stock.css", HTMLdropdown: TRUE, fieldID: "customTopFontID");
                                            ?>

                                            <!-- <p class="help-block">
                                            </p> -->
                                        </div>
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

                                            <label for="customBottomFontColorPicker" style="cursor: pointer;">
                                                <div class= "label label-btn label-primary">
                                                    <i class="label-icon glyphicon tint"></i>
                                                    Browse Colors
                                                </div>
                                            </label>

                                            <input type="color" name="customBottomFontColorPicker" id="customBottomFontColorPicker" style="opacity: 0; display: inline;"
                                                value="<?php echo $customBottomFontColor; ?>"
                                                onchange="setColor('customBottomFontColorPicker', 'customBottomFontColor')">

                                            <!-- <p class="help-block">
                                            </p> -->
                                        </div>
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

                                            <label for="customBottomFontOutlineColorPicker" style="cursor: pointer;">
                                                <div class= "label label-btn label-primary">
                                                    <i class="label-icon glyphicon tint"></i>
                                                    Browse Colors
                                                </div>
                                            </label>

                                            <input type="color" name="customBottomFontOutlineColorPicker" id="customBottomFontOutlineColorPicker" style="opacity: 0; display: inline;"
                                                value="<?php echo $customBottomFontOutlineColor; ?>"
                                                onchange="setColor('customBottomFontOutlineColorPicker', 'customBottomFontOutlineColor')">

                                            <!-- <p class="help-block">
                                            </p> -->
                                        </div>
                                    </div>

                                    <div class="form-group advanced-setting row">
                                        <div class="col-md-6 mb-3">
                                            <input type="checkbox" name="customBottomFontEnabled" id="customBottomFontEnabled" value="1" <?php if ($customBottomFontEnabled) echo " checked"?>>
                                            Use Custom Font (Bottom)

                                            <!-- <p class="help-block">
                                            </p> -->
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            Custom Font (Bottom): &nbsp;
                                            <?php
                                                // PHP 7.x
                                                findFontFamily_Full(FALSE, TRUE, "customBottomFontID");
                                                // PHP 8.x
                                                //findFontFamily(CSSPath: "../assets/plexmovieposter/", CSSFile: "fonts_stock.css", HTMLdropdown: TRUE, fieldID: "customBottomFontID");
                                            ?>

                                            <!-- <p class="help-block">
                                            </p> -->
                                        </div>
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
                        <?php FooterInfo() ; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
