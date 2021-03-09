<?php
//For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
include_once('../assets/plexmovieposter/loginCheck.php');
include '../assets/plexmovieposter/CommonLib.php';
include '../assets/plexmovieposter/CacheLib.php';
include '../assets/plexmovieposter/setData.php';
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
                            PLEX Configuration
                        </h2>
                        <?php AdvancedBar() ;?>
                        <form id="server-settings-form" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                            <!-- SEGMENT BLOCK START -->
                                <div class="form-group">
                                    <h3>Server Configuration</h3>
                                </div>

                                <div class="form-group">
                                    Plex Server IP:&nbsp;

                                    <input type="text" class="fieldInfo-ipaddress form-control form-inline" id="plexServer" name="plexServer" maxlength="15"
                                        placeholder="Plex Server IP" value="<?php echo $plexServer; ?>" required>

                                    <!-- <p class="help-block">
                                        A Plex server IP address is required.
                                    </p> -->
                                </div>

                                <div class="form-group" id="token_view">
                                    Plex Token:&nbsp;

                                    <a href="https://support.plex.tv/hc/en-us/articles/204059436-Finding-your-account-token-X-Plex-Token" target=_blank>
                                        <span class="badge badge-primary">?</span>
                                    </a>
                                    &nbsp;

                                    <input type="password" class="fieldInfo-token form-control form-inline" id="plexToken" name="plexToken"
                                        placeholder="Plex Token" value="<?php echo $plexToken; ?>" required>
                                        &nbsp;
                                    <button class="btn " type="button" id="token_view_btn" onclick="tokenView()">Show</button>

                                    <!-- <p class="help-block">
                                        A Plex token is required.
                                    </p> -->
                                </div>

                                <div class="form-group">
                                    Plex Movie Sections:&nbsp;

                                    <input type="text" class="fieldInfo-medium form-control form-inline" id="plexServerMovieSection"
                                        name="plexServerMovieSection" placeholder="Plex Movie Sections"
                                        value="<?php echo $plexServerMovieSection; ?>" required>

                                    <p class="help-block">
                                        <small>Comma Separated with no Spaces.  At least one Plex movie sections is required.</small>
                                    </p>
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
                                </div>

                                <div class="form-group">
                                    <hr>
                                    <h3>Client Configuration</h3>
                                </div>

                                <div class="form-group">
                                    Plex Client IP:&nbsp;
                                    <input type="text" class="fieldInfo-ipaddress form-control form-inline" id="plexClient" name="plexClient" maxlength="15"
                                        placeholder="Plex Client IP" value="<?php echo $plexClient; ?>" required>

                                    <!-- <p class="help-block">
                                        A Plex client IP address is required.
                                    </p> -->
                                </div>

                                <div class="form-group">
                                    Plex Client Name:&nbsp;

                                    <input type="text" class="fieldInfo-xlarge form-control form-inline" id="plexClientName" name="plexClientName"
                                        placeholder="Plex Client Name" value="<?php echo $plexClientName; ?>">

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
                        <?php FooterInfo(4) ; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
