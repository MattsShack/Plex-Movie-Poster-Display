<?php
//For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
include_once('../assets/plexmovieposter/loginCheck.php');
include '../config.php';
include '../assets/plexmovieposter/CommonLib.php';
require_once '../assets/plexmovieposter/tools.php';
include '../assets/plexmovieposter/CacheLib.php';
include '../assets/plexmovieposter/setData.php';
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
                            Now Showing Configuration
                        </h2>
                        <?php AdvancedBar() ;?>
                        <form id="server-settings-form" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                            <!-- SEGMENT BLOCK START -->
                                <div class="form-group">
                                    <hr>
                                    Transition/Refresh Speed: &nbsp;
                                    <input type="text" id="nowShowingRefreshSpeed" name="nowShowingRefreshSpeed" class="form-control fieldInfo-xsmall form-inline" value="<?php echo $nowShowingRefreshSpeed; ?>" required>

                                    <p class="help-block">
                                        How fast the page will refresh in seconds.
                                    </p>
                                </div>

                                <div class="form-group advanced-setting">
                                    <hr>
                                    Full Screen Art:&nbsp;
                                    <input type="checkbox" name="nowShowingFullScreenArt" id="nowShowingFullScreenArt" value="1" <?php if ($nowShowingFullScreenArt) echo " checked"?>>

                                    <p class="help-block">
                                        Set poster art to be full screen without any other display items.
                                    </p>
                                </div>

                                <div class="form-group advanced-setting">
                                    <hr>
                                    Background Art:&nbsp;
                                    <input type="checkbox" name="nowShowingBackgroundArt" id="nowShowingBackgroundArt" value="1" <?php if ($nowShowingBackgroundArt) echo " checked"?>>

                                    <p class="help-block">
                                        Set background art to match background of media in your library.
                                    </p>
                                </div>

                                <div class="form-group advanced-setting">
                                    <hr>
                                    Display TV Show information from:&nbsp;

                                    <select class="form-inline"
                                        id="nowShowingShowTVThumb" name="nowShowingShowTVThumb">
                                        <option value="episode"
                                            <?php if ($nowShowingShowTVThumb == 'episode') { echo "selected"; } ?>>
                                            Episode
                                        </option>
                                        <option value="season"
                                            <?php if ($nowShowingShowTVThumb == 'season') { echo "selected"; } ?>>
                                            Season
                                        </option>
                                        <option value="series"
                                            <?php if ($nowShowingShowTVThumb == 'series') { echo "selected"; } ?>>
                                            Series
                                        </option>
                                    </select>

                                    <p class="help-block">
                                        Display the poster, background art and information for TV Shows in your library.
                                    </p>
                                </div>

                                <div class="form-group">
                                    <hr>
                                    <h3>Top Text Option:</h3>

                                    <div class="input-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nowShowingTop" id="csb1" value="title"
                                            <?php if($nowShowingTop == 'title' || $nowShowingTop == '') echo " checked"?> onChange="nowShowingTopSelected()">
                                            Title
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nowShowingTop" id="csb2" value="summary"
                                            <?php if($nowShowingTop == 'summary') echo " checked"?> onChange="nowShowingTopSelected()">
                                            Summary
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nowShowingTop" id="csb3" value="tagline"
                                            <?php if($nowShowingTop == 'tagline') echo " checked"?> onChange="nowShowingTopSelected()">
                                            Tagline
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nowShowingTop" id="csb4" value="progessinfo"
                                            <?php if($nowShowingTop == 'progessinfo') echo " checked"?> onChange="nowShowingTopSelected()">
                                            Progress Info.
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nowShowingTop" id="csb5" value="custom"
                                            <?php if($nowShowingTop == 'custom') echo " checked"?> onChange="nowShowingTopSelected()">
                                            Custom
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    Custom Text:

                                    <input type="text" class="form-control"
                                        id="nowShowingTopText" name="nowShowingTopText"
                                        placeholder="NOW SHOWING"
                                        value="<?php echo $nowShowingTopText; ?>" readonly="readonly">

                                    <p class="help-block">
                                        <small>Optional</small>
                                    </p>

                                    <script>
                                        $(function(){
                                            //First call for the load
                                            nowShowingTopSelected();

                                            //Second call for change event
                                            $("input[type=radio]").change( nowShowingTopSelected );
                                        });

                                        // Look at moving script to js file
                                        function nowShowingTopSelected() {
                                            // readonly: input can't be modified
                                            // disabled: input has no form function
                                            var result = document.querySelector('input[name="nowShowingTop"]:checked').value;
                                            if(result=="custom") {
                                                // document.getElementById("nowShowingTopText").setAttribute('disabled', true);
                                                document.getElementById("nowShowingTopText").removeAttribute('readonly');
                                            }
                                            else {
                                                document.getElementById("nowShowingTopText").setAttribute('readonly', true);
                                                // document.getElementById("nowShowingTopText").removeAttribute('disabled');
                                            }
                                        }
                                    </script>
                                </div>

                                <div class="form-group advanced-setting">
                                    <table>
                                        <tr>
                                            <td>
                                                Font Size:
                                                <input type="text" class="form-control"
                                                    id="nowShowingTopFontSize" name="nowShowingTopFontSize"
                                                    value="<?php echo $nowShowingTopFontSize; ?>">

                                                <p class="help-block">
                                                    px
                                                </p>
                                            </td>
                                            <td>
                                                Font Color:
                                                <input type="text" class="form-control"
                                                    id="nowShowingTopFontColor" name="nowShowingTopFontColor"
                                                    value="<?php echo $nowShowingTopFontColor; ?>">

                                                <label for="nowShowingTopFontColorPicker" class="btn btn-sm btn-faux">
                                                    Browse Colors
                                                </label>

                                                <input type="color" name="nowShowingTopFontColorPicker" id="nowShowingTopFontColorPicker" class="field-hideInput"
                                                    value="<?php echo $nowShowingTopFontColor; ?>"
                                                    onchange="setColor('nowShowingTopFontColorPicker', 'nowShowingTopFontColor')">

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
                                                    id="nowShowingTopFontOutlineSize" name="nowShowingTopFontOutlineSize"
                                                    value="<?php echo $nowShowingTopFontOutlineSize; ?>">

                                                <p class="help-block">
                                                    px
                                                </p>
                                            </td>
                                            <td>
                                                Font Outline Color:
                                                <input type="text" class="form-control"
                                                    id="nowShowingTopFontOutlineColor" name="nowShowingTopFontOutlineColor"
                                                    value="<?php echo $nowShowingTopFontOutlineColor; ?>">

                                                <label for="nowShowingTopFontOutlineColorPicker" class="btn btn-sm btn-faux">
                                                    Browse Colors
                                                </label>

                                                <input type="color" name="nowShowingTopFontOutlineColorPicker" id="nowShowingTopFontOutlineColorPicker" class="field-hideInput"
                                                    value="<?php echo $nowShowingTopFontOutlineColor; ?>"
                                                    onchange="setColor('nowShowingTopFontOutlineColorPicker', 'nowShowingTopFontOutlineColor')">

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
                                                <input type="checkbox" name="nowShowingTopFontEnabled" id="nowShowingTopFontEnabled" value="1"
                                                <?php if ($nowShowingTopFontEnabled) echo " checked"?>>

                                                <!-- <p class="help-block">
                                                </p> -->
                                            </td>
                                            <td>
                                                Custom Font: &nbsp;
                                                <?php
                                                    // PHP 7.x
                                                    findFontFamily_Full(FALSE, TRUE, "nowShowingTopFontID");
                                                    // PHP 8.x
                                                    //findFontFamily(CSSPath: "../assets/plexmovieposter/", CSSFile: "fonts_stock.css", HTMLdropdown: TRUE, fieldID: "nowShowingTopFontID");
                                                ?>

                                                <!-- <p class="help-block">
                                                </p> -->
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group advanced-setting">
                                    Auto-scale text:&nbsp;
                                    <input type="checkbox" name="nowShowingTopAutoScale" id="nowShowingTopAutoScale" value="1"
                                    <?php if ($nowShowingTopAutoScale) echo " checked"?>>

                                    <!-- <p class="help-block">
                                    </p> -->
                                </div>

                                <div class="form-group">
                                    <hr>
                                    <h3>Bottom Text Option:</h3>

                                    <div class="input-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nowShowingBottom" id="csb1" value="title"
                                            <?php if($nowShowingBottom == 'title' || $nowShowingBottom == '') echo " checked"?> onChange="nowShowingBottomSelected()">
                                            Title
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nowShowingBottom" id="csb2" value="summary"
                                            <?php if($nowShowingBottom == 'summary') echo " checked"?> onChange="nowShowingBottomSelected()">
                                            Summary
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nowShowingBottom" id="csb3" value="tagline"
                                            <?php if($nowShowingBottom == 'tagline') echo " checked"?> onChange="nowShowingBottomSelected()">
                                            Tagline
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nowShowingBottom" id="csb4" value="presented"
                                            <?php if($nowShowingBottom == 'presented') echo " checked"?> onChange="nowShowingBottomSelected()">
                                            Presented Info.
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nowShowingBottom" id="csb5" value="custom"
                                            <?php if($nowShowingBottom == 'custom') echo " checked"?> onChange="nowShowingBottomSelected()">
                                            Custom
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    Custom Text:

                                    <input type="text" class="form-control"
                                        id="nowShowingBottomText" name="nowShowingBottomText"
                                        placeholder="Custom Text"
                                        value="<?php echo $nowShowingBottomText; ?>" readonly="readonly">

                                    <p class="help-block">
                                        <small>Optional</small>
                                    </p>

                                    <script>
                                        $(function(){
                                            //First call for the load
                                            nowShowingBottomSelected();

                                            //Second call for change event
                                            $("input[type=radio]").change( nowShowingBottomSelected );
                                        });

                                        function nowShowingBottomSelected() {
                                            // readonly: input can't be modified
                                            // disabled: input has no form function
                                            var result = document.querySelector('input[name="nowShowingBottom"]:checked').value;
                                            if(result=="custom") {
                                                // document.getElementById("nowShowingBottomText").setAttribute('disabled', true);
                                                document.getElementById("nowShowingBottomText").removeAttribute('readonly');
                                            }
                                            else {
                                                document.getElementById("nowShowingBottomText").setAttribute('readonly', true);
                                                // document.getElementById("nowShowingBottomText").removeAttribute('disabled');
                                            }
                                        }
                                    </script>
                                </div>

                                <div class="form-group advanced-setting">
                                    <table>
                                        <tr>
                                            <td>
                                                Font Size:
                                                <input type="text" class="form-control"
                                                    id="nowShowingBottomFontSize" name="nowShowingBottomFontSize"
                                                    value="<?php echo $nowShowingBottomFontSize; ?>">

                                                <p class="help-block">
                                                    px
                                                </p>
                                            </td>
                                            <td>
                                                Font Color:
                                                <input type="text" class="form-control"
                                                    id="nowShowingBottomFontColor" name="nowShowingBottomFontColor"
                                                    value="<?php echo $nowShowingBottomFontColor; ?>">

                                                <label for="nowShowingBottomFontColorPicker" class="btn btn-sm btn-faux">
                                                    Browse Colors
                                                </label>

                                                <input type="color" name="nowShowingBottomFontColorPicker" id="nowShowingBottomFontColorPicker" class="field-hideInput"
                                                    value="<?php echo $nowShowingBottomFontColor; ?>"
                                                    onchange="setColor('nowShowingBottomFontColorPicker', 'nowShowingBottomFontColor')">

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
                                                    id="nowShowingBottomFontOutlineSize" name="nowShowingBottomFontOutlineSize"
                                                    value="<?php echo $nowShowingBottomFontOutlineSize; ?>">

                                                <p class="help-block">
                                                    px
                                                </p>
                                            </td>
                                            <td>
                                                Font Outline Color:
                                                <input type="text" class="form-control"
                                                    id="nowShowingBottomFontOutlineColor" name="nowShowingBottomFontOutlineColor"
                                                    value="<?php echo $nowShowingBottomFontOutlineColor; ?>">

                                                <label for="nowShowingBottomFontOutlineColorPicker" class="btn btn-sm btn-faux">
                                                    Browse Colors
                                                </label>

                                                <input type="color" name="nowShowingBottomFontOutlineColorPicker" id="nowShowingBottomFontOutlineColorPicker" class="field-hideInput"
                                                    value="<?php echo $nowShowingBottomFontOutlineColor; ?>"
                                                    onchange="setColor('nowShowingBottomFontOutlineColorPicker', 'nowShowingBottomFontOutlineColor')">

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
                                                <input type="checkbox" name="nowShowingBottomFontEnabled" id="nowShowingBottomFontEnabled" value="1"
                                                <?php if ($nowShowingBottomFontEnabled) echo " checked"?>>

                                                <!-- <p class="help-block">
                                                </p> -->
                                            </td>
                                            <td>
                                                Custom Font: &nbsp;
                                                <?php
                                                    // PHP 7.x
                                                    findFontFamily_Full(FALSE, TRUE, "nowShowingBottomFontID");
                                                    // PHP 8.x
                                                    //findFontFamily(CSSPath: "../assets/plexmovieposter/", CSSFile: "fonts_stock.css", HTMLdropdown: TRUE, fieldID: "nowShowingBottomFontID");
                                                ?>

                                                <!-- <p class="help-block">
                                                </p> -->
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group advanced-setting">
                                    Auto-scale text:&nbsp;

                                    <input type="checkbox" name="nowShowingBottomAutoScale" id="nowShowingBottomAutoScale" value="1"
                                    <?php if ($nowShowingBottomAutoScale) echo " checked"?>>

                                    <!-- <p class="help-block">
                                    </p> -->
                                </div>

                                <div class="form-group advanced-setting">
                                    Bottom Scrolling Text: &nbsp;
                                    <select id="nowShowingBottomScroll" name="nowShowingBottomScroll">
                                        <option value="Disabled" <?php if ($nowShowingBottomScroll == 'Disabled') { echo "selected"; } ?>>
                                            Disabled
                                        </option>
                                        <option value="Enabled" <?php if ($nowShowingBottomScroll == 'Enabled') { echo "selected"; } ?>>
                                            Enabled
                                        </option>
                                    </select>

                                    <!-- <p class="help-block">
                                    </p> -->
                                </div>

                                <div class="form-group">
                                    <hr>
                                    Progress Bar:&nbsp;

                                    <select id="pmpDisplayProgress" name="pmpDisplayProgress">
                                        <option value="Disabled" <?php if ($pmpDisplayProgress == 'Disabled') {
                                            echo "selected";
                                        } ?>>Disabled
                                        </option>
                                        <option value="Enabled" <?php if ($pmpDisplayProgress == 'Enabled') {
                                            echo "selected";
                                        } ?>>Enabled
                                        </option>
                                    </select>

                                    <p class="help-block">
                                        Progress bar will be displayed above the poster art.
                                    </p>
                                </div>

                                <div class="form-group advanced-setting">
                                    <table>
                                        <tr>
                                            <td>
                                                Progress Bar Height:
                                                <input type="text" class="form-control"
                                                    id="pmpDisplayProgressSize" name="pmpDisplayProgressSize"
                                                    value="<?php echo $pmpDisplayProgressSize; ?>">

                                                <p class="help-block">
                                                    px
                                                </p>
                                            </td>
                                            <td>
                                                Progress Bar Color:
                                                <input type="text" class="form-control"
                                                    id="pmpDisplayProgressColor" name="pmpDisplayProgressColor"
                                                    value="<?php echo $pmpDisplayProgressColor; ?>">

                                                <label for="pmpDisplayProgressColorPicker" class="btn btn-sm btn-faux">
                                                    Browse Colors
                                                </label>

                                                <input type="color" name="pmpDisplayProgressColorPicker" id="pmpDisplayProgressColorPicker" class="field-hideInput"
                                                    value="<?php echo $pmpDisplayProgressColor; ?>"
                                                    onchange="setColor('pmpDisplayProgressColorPicker', 'pmpDisplayProgressColor')">

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
