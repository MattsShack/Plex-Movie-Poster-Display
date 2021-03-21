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

GenerateCSS_Font_ALL();

if (isset($_POST["btn_customImg"])) {
    importFiles("customImageUpload", basename(__FILE__));
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
                            Custom Images Configuration
                        </h2>
                        <?php AdvancedBar() ;?>
                            <!-- CUSTOM IMAGE UPLOAD BLOCK START -->
                                <div class="form-group">
                                    <form action="custom.php" method="post" enctype="multipart/form-data">
                                        Custom Image Upload:<br>
                                        <label for="customImageUpload" class="btn btn-sm btn-faux">
                                            Browse File
                                        </label>
                                        <input type="file" name="customImageUpload" id="customImageUpload" class="field-hideInput" onchange="showName_customImg()">

                                        <p>
                                            <div id="UploadFileName_Custom" style="font-size: smaller;">
                                                Upload File:
                                                <i>None</i>
                                            </div>
                                        </p>

                                        <label for="btn_customImg" class="btn btn-sm btn-faux">
                                            Upload File
                                        </label>
                                        <input type="submit" value="Upload Custom Image" name="btn_customImg" id="btn_customImg" class="field-hideInput">
                                    </form>

                                    <!-- <p class="help-block">
                                    </p> -->
                                </div>
                            <!-- CUSTOM IMAGE UPLOAD BLOCK END -->
                        <form id="server-settings-form" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                            <!-- SEGMENT BLOCK START -->
                            <div class="form-group">
                                    <hr>
                                    Transition/Refresh Speed: &nbsp;
                                    <input type="text" id="customRefreshSpeed" name="customRefreshSpeed" class="form-control fieldInfo-xsmall form-inline" value="<?php echo $customRefreshSpeed; ?>" required>

                                    <p class="help-block">
                                        How fast the page will refresh in seconds.
                                    </p>
                                </div>

                                <div class="form-group">
                                    Custom Image State: &nbsp;

                                    <select class="form-inline"
                                        id="customImageEnabled" name="customImageEnabled">
                                        <option value="Disabled"
                                            <?php if ($customImageEnabled == 'Disabled') { echo "selected"; } ?>>
                                            Disabled
                                        </option>
                                        <option value="Enabled"
                                            <?php if ($customImageEnabled == 'Enabled') { echo "selected"; } ?>>
                                            Enabled
                                        </option>
                                    </select>

                                    <!-- <p class="help-block">
                                    </p> -->
                                </div>

                                <div class="form-group">
                                    Custom Image Select:&nbsp;

                                    <select class="form-inline"
                                        id="customImage" name="customImage">
                                        <option value=""
                                            <?php if ($customImage == '') { echo "selected"; } ?>>
                                            None
                                        </option>

                                        <?php customImagesList(); ?>
                                    </select>

                                    <!-- <p class="help-block">
                                    </p> -->
                                </div>
                                
                                <div class="form-group advanced-setting">
                                    <hr>
                                    Background Art:&nbsp;
                                    <input type="checkbox" name="customBackgroundArt" id="customBackgroundArt" value="1" <?php if ($customBackgroundArt) echo " checked"?>>

                                    <p class="help-block">
                                        Set image to be background art instead of poster art.
                                    </p>
                                </div>

                                <div class="form-group">
                                    <hr>
                                    <h3>Top Text Option:</h3>
                                </div>

                                <div class="form-group">
                                    Custom Text:
                                    <input type="text" class="form-control"
                                        id="customTopText" name="customTopText"
                                        placeholder="Custom Text"
                                        value="<?php echo $customTopText; ?>">

                                    <p class="help-block">
                                        <small>Optional</small>
                                    </p>
                                </div>

                                <div class="form-group advanced-setting">
                                    <table>
                                        <tr>
                                            <td>
                                                Font Size:
                                                <input type="text" class="form-control"
                                                    id="customTopFontSize" name="customTopFontSize"
                                                    value="<?php echo $customTopFontSize; ?>">

                                                <p class="help-block">
                                                    px
                                                </p>
                                            </td>
                                            <td>
                                                Font Color:
                                                <input type="text" class="form-control"
                                                    id="customTopFontColor" name="customTopFontColor"
                                                    value="<?php echo $customTopFontColor; ?>">

                                                <label for="customTopFontColorPicker" class="btn btn-sm btn-faux">
                                                    Browse Colors
                                                </label>

                                                <input type="color" name="customTopFontColorPicker" id="customTopFontColorPicker" class="field-hideInput"
                                                    value="<?php echo $customTopFontColor; ?>"
                                                    onchange="setColor('customTopFontColorPicker', 'customTopFontColor')">

                                                <!-- <p class="help-block">
                                                </p> -->
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group advanced-setting">
                                    <table>
                                        <tr>
                                            <td>
                                                Font Outline Size:
                                                <input type="text" class="form-control"
                                                    id="customTopFontOutlineSize" name="customTopFontOutlineSize"
                                                    value="<?php echo $customTopFontOutlineSize; ?>">

                                                <p class="help-block">
                                                    px
                                                </p>
                                            </td>
                                            <td>
                                                Font Outline Color:
                                                <input type="text" class="form-control"
                                                    id="customTopFontOutlineColor" name="customTopFontOutlineColor"
                                                    value="<?php echo $customTopFontOutlineColor; ?>">

                                                <label for="customTopFontOutlineColorPicker" class="btn btn-sm btn-faux">
                                                    Browse Colors
                                                </label>

                                                <input type="color" name="customTopFontOutlineColorPicker" id="customTopFontOutlineColorPicker" class="field-hideInput"
                                                    value="<?php echo $customTopFontOutlineColor; ?>"
                                                    onchange="setColor('customTopFontOutlineColorPicker', 'customTopFontOutlineColor')">

                                                <!-- <p class="help-block">
                                                </p> -->
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group advanced-setting">
                                    <table>
                                        <tr>
                                            <td>
                                                Enable Custom Font: &nbsp;
                                                <input type="checkbox" name="customTopFontEnabled" id="customTopFontEnabled" value="1"
                                                <?php if ($customTopFontEnabled) echo " checked"?>>

                                                <!-- <p class="help-block">
                                                </p> -->
                                            </td>
                                            <td>
                                                Custom Font: &nbsp;
                                                <?php
                                                    // PHP 7.x
                                                    findFontFamily_Full(FALSE, TRUE, "customTopFontID");
                                                    // PHP 8.x
                                                    //findFontFamily(CSSPath: "../assets/plexmovieposter/", CSSFile: "fonts_stock.css", HTMLdropdown: TRUE, fieldID: "customTopFontID");
                                                ?>

                                                <!-- <p class="help-block">
                                                </p> -->
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group">
                                    <hr>
                                    <h3>Bottom Text Option:</h3>
                                </div>

                                <div class="form-group">
                                    Custom Text:

                                    <input type="text" class="form-control"
                                        id="customBottomText" name="customBottomText"
                                        placeholder="Custom Text"
                                        value="<?php echo $customBottomText; ?>">

                                    <p class="help-block">
                                        <small>Optional</small>
                                    </p>
                                </div>

                                <div class="form-group advanced-setting">
                                    <table>
                                        <tr>
                                            <td>
                                                Font Size:
                                                <input type="text" class="form-control"
                                                    id="customBottomFontSize" name="customBottomFontSize"
                                                    value="<?php echo $customBottomFontSize; ?>">

                                                <p class="help-block">
                                                    px
                                                </p>
                                            </td>
                                            <td>
                                                Font Color:
                                                <input type="text" class="form-control"
                                                    id="customBottomFontColor" name="customBottomFontColor"
                                                    value="<?php echo $customBottomFontColor; ?>">

                                                <label for="customBottomFontColorPicker" class="btn btn-sm btn-faux">
                                                    Browse Colors
                                                </label>

                                                <input type="color" name="customBottomFontColorPicker" id="customBottomFontColorPicker" class="field-hideInput"
                                                    value="<?php echo $customBottomFontColor; ?>"
                                                    onchange="setColor('customBottomFontColorPicker', 'customBottomFontColor')">

                                                <!-- <p class="help-block">
                                                </p> -->
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group advanced-setting">
                                    <table>
                                        <tr>
                                            <td>
                                                Font Outline Size:
                                                <input type="text" class="form-control"
                                                    id="customBottomFontOutlineSize" name="customBottomFontOutlineSize"
                                                    value="<?php echo $customBottomFontOutlineSize; ?>">

                                                <p class="help-block">
                                                    px
                                                </p>
                                            </td>
                                            <td>
                                                Font Outline Color:
                                                <input type="text" class="form-control"
                                                    id="customBottomFontOutlineColor" name="customBottomFontOutlineColor"
                                                    value="<?php echo $customBottomFontOutlineColor; ?>">

                                                <label for="customBottomFontOutlineColorPicker" class="btn btn-sm btn-faux">
                                                    Browse Colors
                                                </label>

                                                <input type="color" name="customBottomFontOutlineColorPicker" id="customBottomFontOutlineColorPicker" class="field-hideInput"
                                                    value="<?php echo $customBottomFontOutlineColor; ?>"
                                                    onchange="setColor('customBottomFontOutlineColorPicker', 'customBottomFontOutlineColor')">

                                                <!-- <p class="help-block">
                                                </p> -->
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group advanced-setting">
                                    <table>
                                        <tr>
                                            <td>
                                                Enable Custom Font: &nbsp;
                                                <input type="checkbox" name="customBottomFontEnabled" id="customBottomFontEnabled" value="1"
                                                <?php if ($customBottomFontEnabled) echo " checked"?>>

                                                <!-- <p class="help-block">
                                                </p> -->
                                            </td>
                                            <td>
                                                Custom Font: &nbsp;
                                                <?php
                                                    // PHP 7.x
                                                    findFontFamily_Full(FALSE, TRUE, "customBottomFontID");
                                                    // PHP 8.x
                                                    //findFontFamily(CSSPath: "../assets/plexmovieposter/", CSSFile: "fonts_stock.css", HTMLdropdown: TRUE, fieldID: "customBottomFontID");
                                                ?>

                                                <!-- <p class="help-block">
                                                </p> -->
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            <!-- SEGMENT BLOCK END -->

                            <!-- GHOST BLOCK START -->
                                <?php ghostData(basename(__FILE__)) ;?>
                            <!-- GHOST BLOCK END -->

                            <!-- SUBMIT BLOCK START -->
                                <?php submitForm(FALSE); ?>
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
