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
                            Coming Soon Configuration
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
                                    <div class="form-group advanced-setting">
                                        Show Movies:&nbsp;

                                        <select style="display: inline;" 
                                            id="comingSoonShowSelection" name="comingSoonShowSelection">
                                            <option value="unwatched" <?php if ($comingSoonShowSelection == 'unwatched') {
                                                echo "selected";
                                            } ?>>Unwatched
                                            </option>
                                            <option value="all" <?php if ($comingSoonShowSelection == 'all') {
                                                echo "selected";
                                            } ?>>All
                                            </option>
                                            <option value="recentlyAdded" <?php if ($comingSoonShowSelection == 'recentlyAdded') {
                                                echo "selected";
                                            } ?>>Recently Added
                                            </option>
                                            <option value="newest" <?php if ($comingSoonShowSelection == 'newest') {
                                                echo "selected";
                                            } ?>>Newest
                                            </option>
                                        </select>

                                        <!-- <p class="help-block">
                                        </p> -->
                                        <hr>
                                    </div>

                                    <div class="form-group">
                                        <h3>Top Text Option:</h3>
                                        <div class="input-group">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="comingSoonTop" id="csb1" value="title"<?php if($comingSoonTop == 'title' || $comingSoonTop == '') echo " checked"?> onChange="comingSoonTopSelected()">
                                                Title
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="comingSoonTop" id="csb2" value="summary"<?php if($comingSoonTop == 'summary') echo " checked"?> onChange="comingSoonTopSelected()">
                                                Summary
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="comingSoonTop" id="csb3" value="tagline"<?php if($comingSoonTop == 'tagline') echo " checked"?> onChange="comingSoonTopSelected()">
                                                Tagline
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="comingSoonTop" id="csb4" value="custom"<?php if($comingSoonTop == 'custom') echo " checked"?> onChange="comingSoonTopSelected()">
                                                Custom
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        Custom Top Text:

                                        <input type="text" class="form-control"
                                            id="comingSoonTopText" name="comingSoonTopText"
                                            placeholder="Coming Soon Top Text"
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

                                    <div class="form-group advanced-setting row">
                                        <div class="col-md-6 mb-3"> <!-- Replace this type of div -->
                                            Top Font Size:

                                            <input type="text" class="form-control"
                                                id="comingSoonTopFontSize" name="comingSoonTopFontSize"
                                                value="<?php echo $comingSoonTopFontSize; ?>">

                                            <p class="help-block">
                                                px
                                            </p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            Top Font Color:

                                            <input type="text" class="form-control"
                                                id="comingSoonTopFontColor" name="comingSoonTopFontColor"
                                                data-position="bottom left"
                                                value="<?php echo $comingSoonTopFontColor; ?>">

                                            <!-- <p class="help-block">
                                            </p> -->
                                        </div>

                                        <script>
                                            $(function () {
                                                $('#comingSoonTopFontColor').colorpicker();
                                                $('#comingSoonTopFontColor').on('colorpickerChange', function (event) {
                                                    $('.jumbotron').css('background-color', event.color.toString());
                                                });
                                            });
                                        </script>
                                    </div>

                                    <div class="form-group advanced-setting row">
                                        <div class="col-md-6 mb-3">
                                            Top Font Outline Size:

                                            <input type="text" class="form-control"
                                                id="comingSoonTopFontOutlineSize" name="comingSoonTopFontOutlineSize"
                                                value="<?php echo $comingSoonTopFontOutlineSize; ?>">

                                            <p class="help-block">
                                                px
                                            </p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            Top Font Outline Color:

                                            <input type="text" class="form-control"
                                                id="comingSoonTopFontOutlineColor" name="comingSoonTopFontOutlineColor"
                                                data-position="bottom left"
                                                value="<?php echo $comingSoonTopFontOutlineColor; ?>">

                                            <!-- <p class="help-block">
                                            </p> -->
                                        </div>

                                        <script>
                                            $(function () {
                                                $('#comingSoonTopFontOutlineColor').colorpicker();
                                                $('#comingSoonTopFontOutlineColor').on('colorpickerChange', function (event) {
                                                    $('.jumbotron').css('background-color', event.color.toString());
                                                });
                                            });
                                        </script>
                                    </div>

                                    <div class="form-group advanced-setting">
                                        <input type="checkbox" name="comingSoonTopAutoScale" id="comingSoonTopAutoScale" value="1" <?php if ($comingSoonTopAutoScale) echo " checked"?>>
                                        Auto-scale top text

                                        <!-- <p class="help-block">
                                        </p> -->
                                    </div>

                                    <div class="form-group">
                                        <hr>
                                        <h3>Bottom Text Option:</h3>
                                        <div class="input-group">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="comingSoonBottom" id="csb1" value="title"<?php if($comingSoonBottom == 'title' || $comingSoonBottom == '') echo " checked"?> onChange="comingSoonBottomSelected()">
                                                Title
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="comingSoonBottom" id="csb2" value="summary"<?php if($comingSoonBottom == 'summary') echo " checked"?> onChange="comingSoonBottomSelected()">
                                                Summary
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="comingSoonBottom" id="csb3" value="tagline"<?php if($comingSoonBottom == 'tagline') echo " checked"?> onChange="comingSoonBottomSelected()">
                                                Tagline
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="comingSoonBottom" id="csb4" value="custom"<?php if($comingSoonBottom == 'custom') echo " checked"?> onChange="comingSoonBottomSelected()">
                                                Custom
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        Custom Bottom Text:

                                        <input type="text" class="form-control"
                                            id="comingSoonBottomText" name="comingSoonBottomText"
                                            placeholder="Coming Soon Bottom Text"
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

                                    <div class="form-group advanced-setting row">
                                        <div class="col-md-6 mb-3">
                                            Bottom Font Size:

                                            <input type="text" class="form-control"
                                                id="comingSoonBottomFontSize" name="comingSoonBottomFontSize"
                                                value="<?php echo $comingSoonBottomFontSize; ?>">

                                            <p class="help-block">
                                                px
                                            </p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            Bottom Font Color:

                                            <input type="text" class="form-control"
                                                id="comingSoonBottomFontColor" name="comingSoonBottomFontColor"
                                                data-position="bottom left"
                                                value="<?php echo $comingSoonBottomFontColor; ?>">

                                            <!-- <p class="help-block">
                                            </p> -->
                                        </div>

                                        <script>
                                            $(function () {
                                                $('#comingSoonBottomFontColor').colorpicker();
                                                $('#comingSoonBottomFontColor').on('colorpickerChange', function (event) {
                                                    $('.jumbotron').css('background-color', event.color.toString());
                                                });
                                            });
                                        </script>
                                    </div>

                                    <div class="form-group advanced-setting row">
                                        <div class="col-md-6 mb-3">
                                            Bottom Font Outline Size:

                                            <input type="text" class="form-control"
                                                id="comingSoonBottomFontOutlineSize" name="comingSoonBottomFontOutlineSize"
                                                value="<?php echo $comingSoonBottomFontOutlineSize; ?>">

                                            <p class="help-block">
                                                px
                                            </p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            Bottom Font Outline Color:

                                            <input type="text" class="form-control"
                                                id="comingSoonBottomFontOutlineColor" name="comingSoonBottomFontOutlineColor"
                                                data-position="bottom left"
                                                value="<?php echo $comingSoonBottomFontOutlineColor; ?>">

                                            <!-- <p class="help-block">
                                            </p> -->
                                        </div>

                                        <script>
                                            $(function () {
                                                $('#comingSoonBottomFontOutlineColor').colorpicker();
                                                $('#comingSoonBottomFontOutlineColor').on('colorpickerChange', function (event) {
                                                    $('.jumbotron').css('background-color', event.color.toString());
                                                });
                                            });
                                        </script>
                                    </div>

                                    <div class="form-group advanced-setting">
                                        <input type="checkbox" name="comingSoonBottomAutoScale" id="comingSoonBottomAutoScale" value="1" <?php if ($comingSoonBottomAutoScale) echo " checked"?>>
                                        Auto-scale bottom text

                                        <!-- <p class="help-block">
                                        </p> -->
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
