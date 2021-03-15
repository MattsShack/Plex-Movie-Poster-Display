<?php
//For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
include_once('../assets/plexmovieposter/loginCheck.php');
include '../assets/plexmovieposter/CommonLib.php';
require_once '../assets/plexmovieposter/tools.php';
include '../assets/plexmovieposter/CacheLib.php';
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
                            Coming Soon Configuration
                        </h2>
                        <?php AdvancedBar() ;?>
                        <form id="server-settings-form" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                            <!-- SEGMENT BLOCK START -->
                                <div class="form-group advanced-setting">
                                    <hr>
                                    Show Media:&nbsp;

                                    <select class="form-inline"
                                        id="comingSoonShowSelection" name="comingSoonShowSelection" onChange="comingSoonMediaType(this)">
                                        <option value="unwatched"
                                            <?php if ($comingSoonShowSelection == 'unwatched') { echo "selected"; } ?>>
                                            Unwatched
                                        </option>
                                        <option value="all"
                                            <?php if ($comingSoonShowSelection == 'all') { echo "selected"; } ?>>
                                            All
                                        </option>
                                        <option value="recentlyAdded"
                                            <?php if ($comingSoonShowSelection == 'recentlyAdded') { echo "selected"; } ?>>
                                            Recently Added
                                        </option>
                                        <option value="newest"
                                            <?php if ($comingSoonShowSelection == 'newest') { echo "selected"; } ?>>
                                            Newest
                                        </option>
                                    </select>

                                    <p class="help-block">
                                        If "Show Media" is set to Unwatched or All, Series posters are displayed by default for TV series.
                                    </p>
                                </div>

                                <div class="form-group advanced-setting">
                                    <hr>
                                    Background Art:&nbsp;
                                    <input type="checkbox" name="comingSoonBackgroundArt" id="comingSoonBackgroundArt" value="1" <?php if ($comingSoonBackgroundArt) echo " checked"?>>

                                    <p class="help-block">
                                        Set background art to match background of media in your library.
                                    </p>
                                </div>

                                <div class="form-group advanced-setting">
                                    <hr>
                                    Display TV Show information from:&nbsp;

                                    <select class="form-inline"
                                        id="comingSoonShowTVThumb" name="comingSoonShowTVThumb">
                                        <option value="episode"
                                            <?php if ($comingSoonShowTVThumb == 'episode') { echo "selected"; } ?>>
                                            Episode
                                        </option>
                                        <option value="season"
                                            <?php if ($comingSoonShowTVThumb == 'season') { echo "selected"; } ?>>
                                            Season
                                        </option>
                                        <option value="series"
                                            <?php if ($comingSoonShowTVThumb == 'series') { echo "selected"; } ?>>
                                            Series
                                        </option>
                                    </select>

                                    <p class="help-block">
                                        Display the poster, background art and information for TV Shows in your library.
                                    </p>

                                    <script>
                                        // Look at moving script to js file
                                        function comingSoonMediaType(obj) {
                                           var input = document.getElementById("comingSoonShowTVThumb");
                                           input.disabled = obj.value == "all" || obj.value == "unwatched";
                                        }
                                    </script>
                                </div>

                                <div class="form-group">
                                    <hr>
                                    <h3>Top Text Option:</h3>

                                    <div class="input-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="comingSoonTop" id="csb1" value="title"
                                            <?php if($comingSoonTop == 'title' || $comingSoonTop == '') echo " checked"?> onChange="comingSoonTopSelected()">
                                            Title
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="comingSoonTop" id="csb2" value="summary"
                                            <?php if($comingSoonTop == 'summary') echo " checked"?> onChange="comingSoonTopSelected()">
                                            Summary
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="comingSoonTop" id="csb3" value="tagline"
                                            <?php if($comingSoonTop == 'tagline') echo " checked"?> onChange="comingSoonTopSelected()">
                                            Tagline
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="comingSoonTop" id="csb4" value="custom"
                                            <?php if($comingSoonTop == 'custom') echo " checked"?> onChange="comingSoonTopSelected()">
                                            Custom
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    Custom Text:
                                    <input type="text" class="form-control"
                                        id="comingSoonTopText" name="comingSoonTopText"
                                        placeholder="COMING SOON"
                                        value="<?php echo $comingSoonTopText; ?>" readonly="readonly">

                                    <p class="help-block">
                                        <small>Optional</small>
                                    </p>

                                    <script>
                                        $(function(){
                                            //First call for the load
                                            comingSoonTopSelected();

                                            //Second call for change event
                                            $("input[type=radio]").change( comingSoonTopSelected );
                                        });

                                        // Look at moving script to js file
                                        function comingSoonTopSelected() {
                                            // readonly: input can't be modified
                                            // disabled: input has no form function
                                            var result = document.querySelector('input[name="comingSoonTop"]:checked').value;
                                            if(result=="custom") {
                                                // document.getElementById("comingSoonTopText").setAttribute('disabled', true);
                                                document.getElementById("comingSoonTopText").removeAttribute('readonly');
                                            }
                                            else {
                                                document.getElementById("comingSoonTopText").setAttribute('readonly', true);
                                                // document.getElementById("comingSoonTopText").removeAttribute('disabled');
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
                                                    id="comingSoonTopFontSize" name="comingSoonTopFontSize"
                                                    value="<?php echo $comingSoonTopFontSize; ?>">

                                                <p class="help-block">
                                                    px
                                                </p>
                                            </td>
                                            <td>
                                                Font Color:
                                                <input type="text" class="form-control"
                                                    id="comingSoonTopFontColor" name="comingSoonTopFontColor"
                                                    value="<?php echo $comingSoonTopFontColor; ?>">

                                                <label for="comingSoonTopFontColorPicker" class="btn btn-sm btn-faux">
                                                    Browse Colors
                                                </label>

                                                <input type="color" name="comingSoonTopFontColorPicker" id="comingSoonTopFontColorPicker" class="field-hideInput"
                                                    value="<?php echo $comingSoonTopFontColor; ?>"
                                                    onchange="setColor('comingSoonTopFontColorPicker', 'comingSoonTopFontColor')">

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
                                                    id="comingSoonTopFontOutlineSize" name="comingSoonTopFontOutlineSize"
                                                    value="<?php echo $comingSoonTopFontOutlineSize; ?>">

                                                <p class="help-block">
                                                    px
                                                </p>
                                            </td>
                                            <td>
                                                Font Outline Color:
                                                <input type="text" class="form-control"
                                                    id="comingSoonTopFontOutlineColor" name="comingSoonTopFontOutlineColor"
                                                    value="<?php echo $comingSoonTopFontOutlineColor; ?>">

                                                <label for="comingSoonTopFontOutlineColorPicker" class="btn btn-sm btn-faux">
                                                    Browse Colors
                                                </label>

                                                <input type="color" name="comingSoonTopFontOutlineColorPicker" id="comingSoonTopFontOutlineColorPicker" class="field-hideInput"
                                                    value="<?php echo $comingSoonTopFontOutlineColor; ?>"
                                                    onchange="setColor('comingSoonTopFontOutlineColorPicker', 'comingSoonTopFontOutlineColor')">

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
                                                <input type="checkbox" name="comingSoonTopFontEnabled" id="comingSoonTopFontEnabled" value="1"
                                                <?php if ($comingSoonTopFontEnabled) echo " checked"?>>

                                                <!-- <p class="help-block">
                                                </p> -->
                                            </td>
                                            <td>
                                                Custom Font: &nbsp;
                                                <?php
                                                    // PHP 7.x
                                                    findFontFamily_Full(FALSE, TRUE, "comingSoonTopFontID");
                                                    // PHP 8.x
                                                    //findFontFamily(CSSPath: "../assets/plexmovieposter/", CSSFile: "fonts_stock.css", HTMLdropdown: TRUE, fieldID: "commingSoonTopFontID");
                                                ?>

                                                <!-- <p class="help-block">
                                                </p> -->
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group advanced-setting">
                                    Auto-scale text:&nbsp;
                                    <input type="checkbox" name="comingSoonTopAutoScale" id="comingSoonTopAutoScale" value="1"
                                    <?php if ($comingSoonTopAutoScale) echo " checked"?>>

                                    <!-- <p class="help-block">
                                    </p> -->
                                </div>

                                <div class="form-group">
                                    <hr>
                                    <h3>Bottom Text Option:</h3>

                                    <div class="input-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="comingSoonBottom" id="csb1" value="title"
                                            <?php if($comingSoonBottom == 'title' || $comingSoonBottom == '') echo " checked"?> onChange="comingSoonBottomSelected()">
                                            Title
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="comingSoonBottom" id="csb2" value="summary"
                                            <?php if($comingSoonBottom == 'summary') echo " checked"?> onChange="comingSoonBottomSelected()">
                                            Summary
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="comingSoonBottom" id="csb3" value="tagline"
                                            <?php if($comingSoonBottom == 'tagline') echo " checked"?> onChange="comingSoonBottomSelected()">
                                            Tagline
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="comingSoonBottom" id="csb4" value="custom"
                                            <?php if($comingSoonBottom == 'custom') echo " checked"?> onChange="comingSoonBottomSelected()">
                                            Custom
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    Custom Text:

                                    <input type="text" class="form-control"
                                        id="comingSoonBottomText" name="comingSoonBottomText"
                                        placeholder="Custom Text"
                                        value="<?php echo $comingSoonBottomText; ?>" readonly="readonly">

                                    <p class="help-block">
                                        <small>Optional</small>
                                    </p>

                                    <script>
                                        $(function(){
                                            //First call for the load
                                            comingSoonBottomSelected();

                                            //Second call for change event
                                            $("input[type=radio]").change( comingSoonBottomSelected );
                                        });

                                        function comingSoonBottomSelected() {
                                            // readonly: input can't be modified
                                            // disabled: input has no form function
                                            var result = document.querySelector('input[name="comingSoonBottom"]:checked').value;
                                            if(result=="custom") {
                                                // document.getElementById("comingSoonBottomText").setAttribute('disabled', true);
                                                document.getElementById("comingSoonBottomText").removeAttribute('readonly');
                                            }
                                            else {
                                                document.getElementById("comingSoonBottomText").setAttribute('readonly', true);
                                                // document.getElementById("comingSoonBottomText").removeAttribute('disabled');
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
                                                    id="comingSoonBottomFontSize" name="comingSoonBottomFontSize"
                                                    value="<?php echo $comingSoonBottomFontSize; ?>">

                                                <p class="help-block">
                                                    px
                                                </p>
                                            </td>
                                            <td>
                                                Font Color:
                                                <input type="text" class="form-control"
                                                    id="comingSoonBottomFontColor" name="comingSoonBottomFontColor"
                                                    value="<?php echo $comingSoonBottomFontColor; ?>">

                                                <label for="comingSoonBottomFontColorPicker" class="btn btn-sm btn-faux">
                                                    Browse Colors
                                                </label>

                                                <input type="color" name="comingSoonBottomFontColorPicker" id="comingSoonBottomFontColorPicker" class="field-hideInput"
                                                    value="<?php echo $comingSoonBottomFontColor; ?>"
                                                    onchange="setColor('comingSoonBottomFontColorPicker', 'comingSoonBottomFontColor')">

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
                                                    id="comingSoonBottomFontOutlineSize" name="comingSoonBottomFontOutlineSize"
                                                    value="<?php echo $comingSoonBottomFontOutlineSize; ?>">

                                                <p class="help-block">
                                                    px
                                                </p>
                                            </td>
                                            <td>
                                                Font Outline Color:
                                                <input type="text" class="form-control"
                                                    id="comingSoonBottomFontOutlineColor" name="comingSoonBottomFontOutlineColor"
                                                    value="<?php echo $comingSoonBottomFontOutlineColor; ?>">

                                                <label for="comingSoonBottomFontOutlineColorPicker" class="btn btn-sm btn-faux">
                                                    Browse Colors
                                                </label>

                                                <input type="color" name="comingSoonBottomFontOutlineColorPicker" id="comingSoonBottomFontOutlineColorPicker" class="field-hideInput"
                                                    value="<?php echo $comingSoonBottomFontOutlineColor; ?>"
                                                    onchange="setColor('comingSoonBottomFontOutlineColorPicker', 'comingSoonBottomFontOutlineColor')">

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
                                                <input type="checkbox" name="comingSoonBottomFontEnabled" id="comingSoonBottomFontEnabled" value="1"
                                                <?php if ($comingSoonBottomFontEnabled) echo " checked"?>>

                                                <!-- <p class="help-block">
                                                </p> -->
                                            </td>
                                            <td>
                                                Custom Font: &nbsp;
                                                <?php
                                                    // PHP 7.x
                                                    findFontFamily_Full(FALSE, TRUE, "comingSoonBottomFontID");
                                                    // PHP 8.x
                                                    //findFontFamily(CSSPath: "../assets/plexmovieposter/", CSSFile: "fonts_stock.css", HTMLdropdown: TRUE, fieldID: "comingSoonBottomFontID");
                                                ?>

                                                <!-- <p class="help-block">
                                                </p> -->
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group advanced-setting">
                                    Auto-scale text:&nbsp;

                                    <input type="checkbox" name="comingSoonBottomAutoScale" id="comingSoonBottomAutoScale" value="1"
                                    <?php if ($comingSoonBottomAutoScale) echo " checked"?>>

                                    <!-- <p class="help-block">
                                    </p> -->
                                </div>

                                <div class="form-group advanced-setting">
                                    Bottom Scrolling Text: &nbsp;
                                    <select id="comingSoonBottomScroll" name="comingSoonBottomScroll">
                                        <option value="Disabled" <?php if ($comingSoonBottomScroll == 'Disabled') { echo "selected"; } ?>>
                                            Disabled
                                        </option>
                                        <option value="Enabled" <?php if ($comingSoonBottomScroll == 'Enabled') { echo "selected"; } ?>>
                                            Enabled
                                        </option>
                                    </select>

                                    <!-- <p class="help-block">
                                    </p> -->
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
