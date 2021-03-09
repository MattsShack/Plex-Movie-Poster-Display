<?php
//For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
include '../assets/plexmovieposter/CommonLib.php';
include '../assets/plexmovieposter/setData.php';

$msg = NULL;
// $returnPageData = $_GET['returnPage'];
// $returnPage = "$returnPageData";
$returnPage = "general.php";

if (isset($_POST['username']) && !empty($_POST['password'])) {
    include_once '../config.php';
    if (($_POST['username'] == $pmpUsername) && ($_POST['password'] == $pmpPassword)) {
        session_start();
        $_SESSION['username'] = $pmpUsername;
        $_SESSION['access'] = '1';
        header("Location: $returnPage");
        die();
    } else {
        $msg = "Invalid Username or Password";
    }
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
                        <h2 class="SettingsPageHeader-header-1ugtIL" style="text-align:center;">
                            Movie Poster Display
                            <span class="hyphenSpace">—</span>
                            Login
                        </h2>
                        <form method="post" class="form-login needs-validation" novalidate action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
                            <!-- SEGMENT BLOCK START -->
                                <div class="form-group">
                                    <!-- <img class="d-block mx-auto mb-4" src="/../assets/images/android-chrome-192x192.png" alt="" width="100" height="100"> -->
                                </div>

                                <div class="form-group">
                                    <?php if ($msg != NULL) { echo "<h3 style=\"text-align:center;\">$msg</h3>"; } ?>
                                </div>

                                <div class="form-group" style="text-align:center;">
                                    <input type="username" class="fieldInfo-username-login form-control"
                                        id="username" name="username"
                                        placeholder="Username" required autofocus>

                                    <!-- <p class="help-block">
                                    </p> -->
                                </div>

                                <div class="form-group" style="text-align:center;">
                                    <input type="password" class="fieldInfo-password-login form-control"
                                        id="password" name="password"
                                        placeholder="Password" required>

                                    <!-- <p class="help-block">
                                    </p> -->
                                </div>
                            <!-- SEGMENT BLOCK END -->

                            <!-- GHOST BLOCK START -->
                            <!-- GHOST BLOCK END -->

                            <!-- SUBMIT BLOCK START -->
                                <?php signInForm(FALSE); ?>
                            <!-- SUBMIT BLOCK END -->
                        </form>
                        <?php FooterInfo() ; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    //Taken from https://getbootstrap.com
    //Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict';

        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');

            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

</body>
</html>