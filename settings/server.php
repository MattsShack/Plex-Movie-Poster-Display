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
                            Server Configuration
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
                                        Plex Server IP:&nbsp;

                                        <input type="text" style="display: inline;" class="fieldInfo-ipaddress form-control" id="plexServer" name="plexServer" maxlength="15"
                                            placeholder="Plex Server IP" value="<?php echo $plexServer; ?>" required>

                                        <!-- <p class="help-block">
                                        </p> -->

                                        <div class="invalid-feedback" style="width: 100%;">
                                            A Plex server IP address is required.
                                        </div>
                                    </div>

                                    <div class="form-group" id="token_view">
                                        Plex Token:&nbsp;
                                        <a href="https://support.plex.tv/hc/en-us/articles/204059436-Finding-your-account-token-X-Plex-Token" target=_blank>
                                            <span class="badge badge-primary">?</span>
                                        </a>
                                        &nbsp;

                                        <input type="password" style="display: inline;" class="fieldInfo-token form-control" id="plexToken" name="plexToken"
                                            placeholder="Plex Token" value="<?php echo $plexToken; ?>" required>
                                            &nbsp;
                                        <button class="btn btn-secondary" type="button" id="token_view_btn" onclick="tokenView()">Show</button>

                                        <!-- <p class="help-block">
                                        </p> -->

                                        <div class="invalid-feedback" style="width: 100%;">
                                            A Plex token is required.
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        Plex Movie Sections:&nbsp;

                                        <input type="text" style="display: inline;" class="fieldInfo-medium form-control" id="plexServerMovieSection"
                                            name="plexServerMovieSection" placeholder="Plex Movie Sections"
                                            value="<?php echo $plexServerMovieSection; ?>" required>

                                        <p class="help-block">
                                            <small>Comma Separated with no Spaces</small>
                                        </p>

                                        <div class="invalid-feedback" style="width: 100%;">
                                            At least one Plex movie sections is required.
                                        </div>
                                    </div>

                                    <div class="form-group advanced-setting">
                                        <input type="checkbox" name="plexServerSSL" id="plexServerSSL" value="1" <?php if ($plexServerSSL) echo " checked"?>>
                                        Plex SSL

                                        <!-- <p class="help-block">
                                        </p> -->
                                    </div>

                                    <div class="form-group advanced-setting">
                                        Plex Server Direct:
                                        <a href="https://support.plex.tv/articles/206225077-how-to-use-secure-server-connections/" target=_blank>
                                            <span class="badge badge-primary">?</span>
                                        </a>
                                        &nbsp;

                                        <input type="text" class="fieldInfo-3xlarge form-control" id="plexServerDirect" name="plexServerDirect" maxlength="65"
                                            placeholder="Plex Server Direct" value="<?php echo $plexServerDirect; ?>" required>
                                        
                                        <p class="help-block">
                                            <small>A Plex server direct URL is required (.plex.direct).</small>
                                        </p>

                                        <div class="invalid-feedback" style="width: 100%;">
                                            A Plex server direct URL is required (.plex.direct).
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
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
