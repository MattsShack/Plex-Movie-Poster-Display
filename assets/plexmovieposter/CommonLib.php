<?php

function HeaderInfo($configPage) {
    if ($configPage == "index.php") {
        $paths = "";
    }
    else {
        $paths = "/..";
    }

    echo "<meta charset=\"utf-8\">\n";
    if ($configPage == "index.php") {
        echo "\t<title>Plex Movie Poster Display</title>\n";
    }
    else {
        echo "\t<title>Plex Movie Poster Display - Admin</title>\n";
    }

    echo "\n";
    echo "\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">\n";
    echo "\t<meta name=\"description\" content=\"\">\n";
    echo "\t<meta name=\"author\" content=\"www.mattsshack.com\">\n";

    if ($configPage != "index.php") {
        echo "\n";
        echo "\t<meta content=\"no-cache, no-store, must-revalidate\" http-equiv=\"Cache-Control\"/>\n";
        echo "\t<meta content=\"no-cache\" http-equiv=\"Pragma\"/>\n";
        echo "\t<meta content=\"0\" http-equiv=\"Expires\"/>\n";
    }

    HeaderInfoApple($configPage);

    echo "\n";
    echo "\t<!-- JQuery Javascript -->\n";
    echo "\t<script src=\"$paths/assets/jquery-3.4.0/jquery-3.4.0.min.js\"></script>\n";

    if ($configPage == "index.php") {
        echo "\t<script src=\"$paths/assets/jquery-3.4.0/jquery.marquee.min.js\"></script>\n";
        echo "\t<script src=\"$paths/assets/jquery-3.4.0/jquery.easing.min.js\"></script>\n";
    }

    if ($configPage != "index.php") {
        echo "\n";
        echo "\t<!-- Popper Javascript -->\n";
        echo "\t<script src=\"$paths/assets/popper/popper.min.js\"></script>\n";
    }

    if ($configPage == "index.php") {
        echo "\n";
        echo "\t<!-- Text Scaler Javascript -->\n";
        echo "\t<script src=\"$paths/assets/fitty/fitty.js\"></script>\n";
    }

    echo "\n";
    echo "\t<!-- Bootstrap Javascript & CSS -->\n";
    echo "\t<script src=\"$paths/assets/bootstrap-4.3.1/js/bootstrap.min.js\"></script>\n";
    echo "\t<link rel=\"stylesheet\" href=\"$paths/assets/bootstrap-4.3.1/css/bootstrap.min.css\">\n";

    if ($configPage != "index.php") {
        echo "\n";
        echo "\t<!-- Bootstrap Colorpicker Javascript & CSS -->\n";
        echo "\t<script src=\"$paths/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js\"></script>\n";
        echo "\t<link rel=\"stylesheet\" href=\"$paths/assets/bootstrap-colorpicker/css/bootstrap-colorpicker.css\">\n";
    }

    echo "\n";
    echo "\t<!-- Plex Movie Poster Display Javascript & CSS -->\n";
    echo "\t<link rel=\"stylesheet\" href=\"$paths/assets/plexmovieposter/fonts_stock.css\">\n";

    if ($debugMode == TRUE) {
        $font_custom_ver = date('his');
        echo "\t<link rel=\"stylesheet\" href=\"$paths/assets/plexmovieposter/fonts_custom.css?v=$font_custom_ver\">\n";
    }
    else {
        // echo "\t<link rel=\"stylesheet\" href=\"$paths/assets/plexmovieposter/fonts_custom.css\">\n";
        echo "\t<link rel=\"stylesheet\" href=\"$paths/cache/fonts/fonts_custom.css\">\n";
    }


    if ($configPage != "index.php") {
        echo "\t<script src=\"$paths/assets/plexmovieposter/CommonLib.js\"></script>\n";
        echo "\t<link rel=\"stylesheet\" href=\"$paths/assets/styles/default/style.css\">\n";
        echo "\t<link rel=\"stylesheet\" href=\"$paths/assets/styles/default/form-validation.css\">\n";
    }

    if ($configPage == "index.php") {
        echo "\t<link rel=\"stylesheet\" href=\"$paths/assets/styles/default/poster.css\">\n";
        // echo "\t<link rel=\"shortcut icon\" type=\"image/png\" href=\"$paths/assets/images/desktop/favicon.ico\"/>\n";
        // echo "\t<link rel=\"mask-icon\" href=\"$paths/assets/images/desktop/favicon-mask.svg\" color=\"#cc7b19\">\n";
    }

    echo "\n";
    echo "\t<!-- Plex CSS & Icons-->\n";
    if ($configPage != "index.php") {
        echo "\t<link rel=\"stylesheet\" href=\"$paths/assets/plex/Plex.css\">\n";
    }
    echo "\t<link rel=\"shortcut icon\" type=\"image/png\" href=\"$paths/assets/plex/images/desktop/favicon.ico\"/>\n";
    echo "\t<link rel=\"mask-icon\" href=\"$paths/assets/plex/images/desktop/favicon-mask.svg\" color=\"#cc7b19\">\n";
}

function HeaderInfoApple($configPage) {
    if ($configPage == "index.php") {
        $paths = "";
    }
    else {
        $paths = "/..";
    }

    echo "\n";
    echo "\t<meta name=\"apple-mobile-web-app-capable\" content=\"yes\">\n";
    echo "\t<meta name=\"apple-mobile-web-app-status-bar-style\" content=\"black\">\n";
    echo "\t<meta name=\"apple-touch-fullscreen\" content=\"yes\">\n";

    echo "\n";
    // echo "\t<!-- <link rel=\"apple-touch-icon\" href=\"$paths/assets/plex/images/apple-touch-icon.png\"> -->\n";
    echo "\t<link rel=\"apple-touch-icon-precomposed\" href=\"$paths/assets/plex/images/desktop/ios/icon-iphone.png\">\n";
    echo "\t<link rel=\"apple-touch-icon-precomposed\" sizes=\"72x72\" href=\"$paths/assets/plex/images/desktop/ios/icon-ipad.png\">\n";
    echo "\t<link rel=\"apple-touch-icon-precomposed\" sizes=\"114x114\" href=\"$paths/assets/plex/images/desktop/ios/icon-iphone@2x.png\">\n";
    echo "\t<link rel=\"apple-touch-icon-precomposed\" sizes=\"144x144\" href=\"$paths/assets/plex/images/desktop/ios/icon-ipad@2x.png\">\n";
    echo "\t<link rel=\"apple-touch-startup-image\" media=\"(device-width: 320px)\" href=\"$paths/assets/plex//images/desktop/ios/startup-iphone-portrait.png\">\n";
    echo "\t<link rel=\"apple-touch-startup-image\" media=\"(device-width: 320px) and (-webkit-device-pixel-ratio: 2)\" href=\"$paths/assets/plex//images/desktop/ios/startup-iphone-portrait@2x.png\">\n";
    echo "\t<link rel=\"apple-touch-startup-image\" media=\"(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)\" href=\"$paths/assets/plex/images/desktop/ios/startup-iphone5-portrait@2x.png\">\n";
    echo "\t<link rel=\"apple-touch-startup-image\" media=\"(device-width: 768px) and (orientation: portrait)\" href=\"$paths/assets/plex/images/desktop/ios/startup-ipad-portrait.png\">\n";
    echo "\t<link rel=\"apple-touch-startup-image\" media=\"(device-width: 768px) and (orientation: landscape)\" href=\"$paths/assets/plex/images/desktop/ios/startup-ipad-landscape.png\">\n";
    echo "\t<link rel=\"apple-touch-startup-image\" media=\"(device-width: 1536px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)\" href=\"$paths/assets/plex/images/desktop/ios/startup-ipad-portrait@2x.png\">\n";
    echo "\t<link rel=\"apple-touch-startup-image\" media=\"(device-width: 1536px)  and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)\" href=\"$paths/assets/plex/images/desktop/ios/startup-ipad-landscape@2x.png\">\n";

}

function NavBar() {
    echo "<div class=\"nav-bar\">\n";
    echo "            <div class=\"NavBar-container-1T0BJz\">\n";
    echo "                <div class=\"NavBar-left-2SrTGf NavBar-side-2kZrHV\">\n";
    echo "                    <a id=\"id-261\" aria-label=\"Home\" data-uid=\"id-262\" href=\"../index.php\" role=\"link\" class=\"NavBar-button-diriIs NavBarIconButton-button-eR0v0j IconButton-button-9An-7I Link-link-2n0yJn Link-default-2XA2bN     \">\n";
    echo "                        <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 560 560\" id=\"plex-icon-navbar-home-560\" aria-hidden=\"true\" class=\"PlexIcon-plexIcon-8Tamaj NavBarIconButton-icon-2gdVPu\">\n";
    echo "                        <path d=\"M84 448V291.598a28 28 0 0 1 8.201-19.799L280 84l187.799 187.799A28 28 0 0 1 476 291.598V448c0 15.464-12.536 28-28 28H322V336h-84v140H112c-15.464 0-28-12.536-28-28z\">\n";
    echo "                        </path>\n";
    echo "                        </svg>\n";
    echo "                    </a>\n";
    // Below is the 'Copyright Plex Logo" version of the NavBar
    // echo "                    <a data-uid=\"id-2\" href=\"#\" role=\"link\" class=\"NavBar-plexLogo-3_NNRw NavBarIconButton-button-eR0v0j IconButton-button-9An-7I Link-link-2n0yJn Link-default-2XA2bN     \">\n";
    // Below is the "Non-copyright Logo" version of the NavBar -- Coming Soon
    // echo "                    <a data-uid=\"id-2\" href=\"#\" role=\"link\" class=\"NavBar-plexLogo-3_NNRw NavBarIconButton-button-eR0v0j IconButton-button-9An-7I Link-link-2n0yJn Link-default-2XA2bN     \">\n";
    echo "                    </a>\n";
    echo "                </div>\n";
    echo "            </div>\n";
    echo "        </div>\n";
}

function sidebarInfo($configPage) {

    echo '<div class="SidebarContainer-sidebarContainer-2RAYT1">
              <div class="SidebarScroller-scroller-2wp83y Scroller-scroller-3GqQcZ Scroller-vertical-VScFLT Scroller-auto-LsWiWx ">
                  <div id="SideBar" class="SettingsSidebar-sidebarContent-3yMjj9">
                      <div role="navigation">
                          <div class="SidebarList-sidebarListHeaderContainer-2D2g-W">
                              <div class="SettingsSidebarList-header-1RCToc SidebarList-sidebarListHeader-1t0yzs" role="header">Settings</div>
                          </div>';

    // General PHP
    if ($configPage == "general.php") {
        sidebarInfoMeta("general.php","General","Active");
    }
    else {
        sidebarInfoMeta("general.php","General","NotActive");
    }

    // Security PHP
    if ($configPage == "security.php") {
        sidebarInfoMeta("security.php","Security Configuration","Active");
    }
    else {
        sidebarInfoMeta("security.php","Security Configuration","NotActive");
    }

    // Common PHP
    if ($configPage == "common.php") {
        sidebarInfoMeta("common.php","Common Configuration","Active");
    }
    else {
        sidebarInfoMeta("common.php","Common Configuration","NotActive");
    }

    // Server PHP
    if ($configPage == "server.php") {
        sidebarInfoMeta("server.php","Server Configuration","Active");
    }
    else {
        sidebarInfoMeta("server.php","Server Configuration","NotActive");
    }

    // Client PHP
    if ($configPage == "client.php") {
        sidebarInfoMeta("client.php","Client Configuration","Active");
    }
    else {
        sidebarInfoMeta("client.php","Client Configuration","NotActive");
    }

    // Coming Soon PHP
    if ($configPage == "comingSoon.php") {
        sidebarInfoMeta("comingSoon.php","Coming Soon","Active");
    }
    else {
        sidebarInfoMeta("comingSoon.php","Coming Soon","NotActive");
    }

    // Now Showing PHP
    if ($configPage == "nowShowing.php") {
        sidebarInfoMeta("nowShowing.php","Now Showing","Active");
    }
    else {
        sidebarInfoMeta("nowShowing.php","Now Showing","NotActive");
    }

    // Custom PHP
    if ($configPage == "custom.php") {
        sidebarInfoMeta("custom.php","Custom Configuration","Active");
    }
    else {
        sidebarInfoMeta("custom.php","Custom Configuration","NotActive");
    }

    // Fonts PHP
    if ($configPage == "fonts.php") {
        sidebarInfoMeta("fonts.php","Font Configuration","Active");
    }
    else {
        sidebarInfoMeta("fonts.php","Font Configuration","NotActive");
    }

    echo '            </div>
                  </div>
              </div>
          </div>';

}

function sidebarInfoMeta($configPage, $configString, $configStatus) {
    echo '<div class="SidebarListItem-sidebarListItem-GdcVsd">';

    if ($configStatus == "Active") {
        echo "<a href=\"$configPage\" role=\"link\" class=\"SidebarLink-sidebarLink-L2OPdE Link-default-2XA2bN Link-link-2n0yJn Link-isSelected-IRm9uM\">
              <div class=\"SidebarLink-container-24bhWp\">
              <div class=\"SettingsSidebarListLink-icon-eICe1t SidebarLink-icon-34JWqs SettingsSidebarListLink-selectedIcon-caIG1g\"></div>
              <div class=\"SidebarLink-title-2vaAAn\">$configString</div>
              <div class=\"SidebarLink-children-3Lh_RU\"></div>";
    }
    else {
        echo "<a href=\"$configPage\" role=\"link\" class=\"SidebarLink-sidebarLink-L2OPdE Link-default-2XA2bN Link-link-2n0yJn\">
              <div class=\"SidebarLink-container-24bhWp\">
              <div class=\"SettingsSidebarListLink-icon-eICe1t SidebarLink-icon-34JWqs\"></div>
              <div class=\"SidebarLink-title-2vaAAn\">$configString</div>";
    }

    echo '</div>
          </a>
          </div>';
}

function FooterInfo() {
    // https://www.plex.tv/about/privacy-legal/plex-trademarks-and-guidelines/
    // http://brand.plex.tv/d/qxmJ3odkK0fj/style-guide
    // http://brand.plex.tv/d/qxmJ3odkK0fj/style-guide#/style-guide/typography

    $CopyrightMsg[0] = "Plex is a copyright of the Plex Media Company";
    $CopyrightMsg[1] = "Works with Plex";
    $CopyrightMsg[2] = "Plex Move Poster Display for Plex";
    $CopyrightMsg[3] = "PLEX, PLEX PASS, myPLEX, PLEX MEDIA SERVER, PLEX MEDIA CENTER, PLEX MEDIA MANAGER, PLEX HOME THEATER, PLEX TV, PLEX.TV, the Plex Play Logo (\">\" in stylized format) are trademarks that are the exclusive property of Plex, Inc.";


    echo "<div style=\"position: absolute; left: 0; bottom: 0; width: 100%; text-align: center; \">";
    echo "<p>";
    echo "$CopyrightMsg[3]";
    echo "</p>";
    echo "</div>";
}

?>