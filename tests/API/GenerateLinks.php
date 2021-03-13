<?php
    // https://{IP or URL}:32400/library/sections/$LibraryID/$MediaStatusType?X-Plex-Token={TOKEN HERE}
    include '../../config.php';

    // Settings
        $LibraryID = 1;
        $MediaStatusArr = array("unwatched", "all","newest", "recentlyAdded");

        $Token = $plexToken;
        // $Server = $plexServer;
        $Server = $plexServerDirect;
    // Settings

    echo "Generate Links: <br>";
    foreach ($MediaStatusArr as $MediaStatusType) {
        $LinkGen = "https://$Server:32400/library/sections/$LibraryID/$MediaStatusType?X-Plex-Token=$Token";

        echo "<br>";
        echo "Checking: $MediaStatusType <br>";
        echo "<a href=\"$LinkGen\">$LinkGen</a>";
        echo "<br>";
    }

?>