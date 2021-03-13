<?php
//For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
include_once('../assets/plexmovieposter/loginCheck.php');
include '../assets/plexmovieposter/CommonLib.php';
// include '../assets/plexmovieposter/tools.php';
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
                            Client Configuration
                        </h2>
                        <?php AdvancedBar() ;?>
                        <form id="server-settings-form" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                            <!-- SEGMENT BLOCK START -->
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
                        <?php FooterInfo() ; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
