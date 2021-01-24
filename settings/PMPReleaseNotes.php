<?php
function PMPReleaseNotesDisplay() {
    include 'PMPInfo.php';

    // echo '<div class="modal-backdrop fade in"></div>';
    // echo '<div class="modal fade in" aria-hidden="false" style="display: block;">';
    echo '<div class="modal-backdrop fade "></div>';
    echo    '<div class="modal fade " aria-hidden="true" style="display: none;">';
    echo        '<div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal">
                                <i class="glyphicon remove-2"></i>
                            </button>
                            <h4 class="modal-title">
                                <i class="modal-icon glyphicon circle-info"></i>
                                Plex Movie Poster Display Release Notes
                            </h4>
                        </div>
                        <div class="modal-body modal-body-scroll dark-scrollbar">
                            <span class="text-muted">';
    echo                         "Version $version ";
    echo                    '</span>
                            <h4 class="update-list-title">New</h4>
                            <ul>
                                <li></li>
                            </ul>
                            <h4 class="update-list-title">Fixes</h4>
                            <ul>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                  </div>';
    echo    '</div>';
    echo '</div>';
}

?>