## Change Logs:

**v2 Beta 1**\
PHP7 compatibility.\
Support for multiple Movie Sections.\
Completely new admin page.\
Basic username and password protection of admin page.\
New options for font size and colors.\
New options for font outline size and colors.\
New poster stats and cache clearing.\
New custom image stats and cache clearing.\
New options for multiple custom images uploaded. (Can still only select one for now).\
First try at installation documentation.\

**v2 Beta 2**\
Login page now shows message if username / password does not match.\
New Progress bar for Movies and TV Shows.\
New options for Progress Bar size and colors.\
Add menu to admin page with links to sections.\
Optimized some code. Still need to do more…\

**v2 Beta 3**\
Add custom poster transition timer.\
Changed font size from select to input. (This will allow for a lot more customization.)\
Fixed “Use of undefined constant” error.\
Clean up unused assets.\
More optimization.\

**v2 Beta 4**\
A lot of changes in this release. Prior Beta releases refresh the top, middle, and bottom divs every time the Poster Transition Speed timer expired. This would cause scrolling bottom text to refresh also, cutting off text or causing bad transition. I am working on a solution, but so far I am not happy with it.\
Code optimization:

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;– Movies and TV Show parsing is no longer two different sections.\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;– Rearranged some code.

Add status.php to keeps status / stats of script. Will be used more in the future.\
Add Scrolling bottom text.\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;– Using jquery.marquee and jquery.easing
Move Poster Transition Speed location.\
Change Free space is now shown in GB.\
Logging into admin page and saving config, even without changing anything, will upgrade the config file.

**v2 RC1**\
Recommend a fresh Plex Movie Poster Display install with this release.\
Add Username and Password change to admin page.\
Add change font size and color for bottom text while scrolling is enabled.\
Add Coming Soon selection for UnWatched, All, Recently Added, and Newest.\
Fix more typos.\
Fix clean cache directory error message.\
More optimization.\

**v2 RC2**\
Add no-cache, no-store, must-revalidate options to admin.php page.\
Fix blank image while playing media with no art (Example: Live TV).\

**v2 Final**\
RC2 is now v2 Final.

**v2.5 Community Updates**\
Admin UI/UX updates\
Security fix to prevent exposing Plex Token\
Updates to clean up formatting in CSS files\
Misc. formatting adjustments\
Docker Support\
Documentation integration\
GitVersion integration

**v2.6 Community Updates**\
New configuration and administration pages

**v2.7.0 Community Updates**\
Add integration of Fonts into the Plex Movie Poster system.

Updates - Custom Font Integration (Issue #16)
- Importing of Fonts (ttf and zip)
- Exporting of Fonts (zip)
- Displaying sample of fonts
- Add list of fonts and configuration for Top/Bottom of Coming Soon, Now Showing, Custom.
- Option to set font and enable/disable font (per Top/Bottom)
- Update documentation for Font update.
- Update Dockerfile to install php-zip as required for import/export functions.

Updates and Bug Fixes:
- Bump version to v2.7
- Prep for centralized cache count function
- Move import/export of config function to importExportLib and minor updates and adjustments.
- Minor adjustments to cache display format
- Fix issue with customCache was pulling Poster cache value.
- Fix issue in Now Showing page that Top/Bottom Auto Scale was pointing to comingSoon variables.
- Add/Change the footer message. (Resolves #19)
- Misc. documentation updates.
- Add PHPInfo file to show PHP version. This is in preparation for upgrade to PHP 8
- Add (commented out) lines in Dockerfile in preparation for PHP 8
- Add backup.php (prototype) to backup all custom fonts and config, using date stamp.

Bugs:
- Color font picker not displaying correctly (known issue from previous release)
- Sometimes configuration value is not reflected on Save Changes and require a refresh on the page to display the updated values.

**v2.7.1 Community Updates**\
Address issue when having a TV Show library as part of the library scan, the TV Show metadata is not being read correctly and art is not being displayed for Coming Soon.

Updates (Issue #23):
- Add read information for metadata of TV Shows for Coming Soon
- Add support (not configured) to allow for displaying either cover art for Show or Season as part of Now Playing
- Start documentation for how the media is defined (not linked)

Updates and Bug Fixes:
- Fix issue with SSL displaying blank page when loading.
- Add showCacheImgs.php file to display all the images in the poster cache
- Add logging system to capture log information for debugging

**v2.8.0 Community Updates**\
Updates - Background Theme ~ Backend (Issue #27):
- getData.php: Update the '$art' var to mediaThumb to better reflect the naming from xml
- add $pmpArtDir in config for cache path
- change variable names to more align with XML naming

Updates and Bug Fixes:
- Extend more logging info
- refactor cache folder creation and preparation

ToDos:
- Figure out how to pass mediaArt to index page as the mediaThumb is currently
- Set background to mediaArt value

**v2.8.1 Community Updates**\
Updates - Background Theme ~ Frontend (Issue #27):
- getData.php: Setup data to pass to index.php
- Add options to turn on/off of Background art for Coming Soon and Now Showing
- Update bottom css to disable the background color.

Updates and Bug Fixes:
- Misc. File formatting cleanup
- Update how setData refreshes the file on save

**v2.9.0 Community Updates**\
Updates – TV Show Integration (Issue #23):
- Add new variables: $nowShowingShowTVThumb (Default: series)
- Add new dropdown in 'Now Showing' (Episode/Series/Season) to set Thumb (Poster)
- Add new variables: $comingSoonShowTVThumb (Default: series)

Updates - Music Integration (Issue #30):
- Add check to see if playing video is 'video' or 'track'
- Add metadata check for 'track'

Updates and Bug Fixes:
- Create UpdateVersion.py to update all the versions in a single update.
- Update the url for cache images to use the 'encrypted’ url like the non-cached version (Issue #25)
- Add Blur to mediaArt (Background) (Issue #27)
- Fix issue with background art and poster do not match (Issue #27)
- Move some actions out of the getData.php to its own PlexLib.php file to split into functions for better organization and scale.
- Update 'Coming Soon' metadata reader to use PlexLib functions so to share same business logic.

ToDos:
- Add switches to Enable/Disable TV Shows within the 'Coming Soon' and/or 'Now Playing' (Issue #23)
- Add switches to Enable/Disable Music within the 'Coming Soon' and/or 'Now Playing' (Issue #30)
    - 'Coming Soon' for music does not work when using 'unwatched'; currently music is skipped in this mode.
- Add switches to Enable/Disable Thumb (Poster) within the 'Coming Soon' and/or 'Now Playing' - If you only want 'art' only
    - This will also require a small rework to how the blur function works.
- Add Music metadata to 'Coming Soon' rotation - Currently shows as blank data

**v2.9.1 Community Updates**\
Updates - Two Admins (Issue #33):
- Remove Legacy Pages:
    - admin.php
    - login.php
    - loginCheck.php
    - logout.php

R&D - Research Plex Webhooks (Issue #31):
- Build Webhook backend decoding functionality
- Add test scripts for Webhook validation

**v2.9.2 Community Updates**\
Updates - Color Picker Desktop (Issue #35)
- Change color picker from 'bootstrap-colorpicker' to built in color picker system.  This changes how we select the color picker from just selecting the filed to pressing the 'browse color' button.
 
**v2.9.3 Community Updates**\
Updates - Color Picker Desktop (Issue #35)
- Fix missing color picker for the Progress Bar

Update - Theme Idea (Enhancement) (Issue #27)
- Fix issue with poster and background art not displaying.  Issue was around how the getPoster was reading the mimetype for the image.  It is still unclear why it's failing but a fallback to the unsecure URL is now in place.
- Fix issue with log files not generating correctly based on path.
