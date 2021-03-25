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

**v2.10.0 Community Updates**\
Refactor - Remove all Plex Assets (Issue #38)

    Update to conform to PLEX trademarks and guidelines
    - Remove all PLEX images and assets
    - Change color scheme
    - Rename project
- Create new set of 'clean' css files for the settings and the display pages.
- Change out hard coded naming of project to variables
- Remove all PLEX assets from assets folder
- Segregation of PLEX settings into a dedicated PLEX page
- Replace color scheme with new design
- Clean up none required 'extra' formatting that had no impact on end product
- Restructure some 'duplicate' components to be more central and reusable (eg. 'Save Changes' button)
- Retained a similar skeletal structure, but streamlined and made enhancements
- Update/reformat preexisting stock images for use for icons.

ToDo:
- Continue to refactor and rename some CSS elements.
- Clean out more unnecessary code in php and css files.
- Update more of the color and font once updated design change becomes available
- Continue to Move/Remove PLEX references and keep isolated to a limited locations within the code.


Bug - Coming Soon Show Movies - Recently Added & Newest TV Show Poster/Backgrounds (Issue #45)
- Add better logic to allow for the information of the media when using 'Recently Added' and 'Newest' for TV shows as the xml from the API changes between these options.
- Add a dropdown option in 'Coming Soon' (same as Now Showing) for TV Shows to allow settings for Episode/Season/Series
- Add fixes for how the poster is found for TV Shows if a poster is not found it will try to check its next level up

Updates and Bug Fixes:
- Fix issue with the 'Custom Image Upload' and 'Custom Image Select' not working correctly
- Start to build out more 'tests' for better debugging of future issues.

**v2.10.1 Community Updates**\
Updates and Bug Fixes:
- Address issue with custom fonts not displaying correctly.
- Add link to the GITHub page as part of the footer.

**v2.10.2 Community Updates**\
Enhancement - Font Enhancements (Issue #44)
- Update export to unzip into subdirectory for better organization.
- Add font extraction for only font files
- Expand font scanner for multiple font files and added to font_custom.css
- Fix duplicate entries in font_custom.css

    Design:
    1. __Complete__: Add 'Clear Fonts' to clear out all custom uploaded fonts.
    2. __Canceled__: Add a check to see if a font file is supported within a zip file
    3. __Complete__: Add support for multiple font formats (eg. OTF)
    4. __Complete__: Update the 'Unzip' to not unzip to the root of the fonts folder but to unzip to its 'Zip File Name' for better organization
    5. __TODO__: Using the 'Zip File Name' folder method, append the name to the actual name of the font file when displaying in the lists. Currently it only uses the name of the font file itself and and can become a bit harder to identify the type we require.
    6. __Complete__: When unzipping the fonts, only unzip the font files supported and ignore all other files and folders. This will allow for a cleaner storage and organization.
    7. __Canceled__: Remove _MACOSX folder when unzipping.

Coming Soon - Show Media: ALL - Not Displaying TV Show Posters (Issue #51)
- Add logic to address when in 'Coming Soon' and either 'All' or 'Unwatched' would not display poster when set to 'series' or 'season'.
- When using 'All' or 'Unwatched' the cover poster for the series is used even though Episode/Season/Series may be selected.  This is based on the xml data provided by the PLEX API
- Disable Episode/Season/Series option when using 'All' or 'Unwatched' is set for Coming Soon

Scrolling Summary Bottom Text for Now Showing (Issue #39)
- Fix issue with summary display on single line - Unreadable
- Add bottomScroll for text to be individually controlled in 'Now Showing' and 'Coming Soon'
- TODO: Remove the 'Common' version of 'bottomScroll'

Updates and Bug Fixes:
- Add logging to import Zip File
- Updates to test suite
- Fix issue with 'GeneralPath_Remove' not running correctly as no default values where provided.
- Update documentation to reflect some changes that has been made to the system. (Issue #52)
- Modify CSS for userText, disabling the 'white-space: nowrap' element as it was causing issues with how the text was displaying.

Known Issues:
- If summary text is too large and bottom scroll is disabled, summary becomes unreadable.

**v2.10.3 Community Updates**\
Coming Soon - Show Media: ALL - Not Displaying TV Show Posters (Issue #51)
- Add a more documentation around when using Unwatched and All for show media that the poster will default to the Series poster.

Enhancement - Font Enhancements (Issue #44)
- Address issues with 'Bad Gateway'
- Add filter to remove bad directories when uploading font (_MACOSX)

Updates and Bug Fixes:
- Address nginx errors in error log (tail /var/log/nginx/error.log)
- Add more misc. logging information
- Add missing fields in config.php

**v2.10.4 Community Updates**\
Enhancement - Font Enhancements (Issue #44)
- Add flag for files with '._' as there name.  Future update should remove these files directly.
- Add a more dynamic font css generation to only add the 'fonts' that truly exist.  Any fonts that have the same font with multiple ext. will need to be validated.

Updates and Bug Fixes:
- Update to ChangeLog for v2.10.3 as missing additional information.
- Move getPoster from to plexMoviePoster assets.  This is to help isolate potential issues with relative paths.
- Update how to handle issues with the getPoster functions when receiving invalid image.

Trouble Shooting:
- If poster is not returning correctly, attempt to reinstall dependencies.  Sometimes issue could be because of an issue with the pmp-curl dependency.

**v2.10.5 Community Updates**\
Enhancement - Font Enhancements (Issue #44)
- Add Fix for when font = None that it defaults back to system font not generic font.

Enhancement - Digital Picture Frame Mode (Issue #48)
- Separate timer to give timer to each one of the types of display options.
- Cleanup javascript to use switch case vs. if statement to better organize load options, and to allow for future data promotion to the front end.
- Update to how the index page takes in changes to refresh time.  Previously if a refresh time was set and you load index page that refresh was locked in until you did a full page reload.  Now, if refresh is adjusted the page will validate and if the current and new refresh times are out of sync the page will do a full reload
- Add some hooks for Digital picture frame to disable CSS blur

ToDo:
- Look into moving index JavaScripts to dedicated js file for better reuse of functions as a good portion are duplicated.

Known Bugs:
- For page refresh if out of sync there may be a poster flash/skip as its loading the new 'session'

Updates and Bug Fixes:
- Disable frontend for 'Poster Transition/Refresh Speed' and 'Bottom Scrolling Text' options in the 'Common Configuration' page as these options are now available as individuals for the 'Coming Soon' and 'Now Showing' pages.
- Add more Plex API metadata read.  Collecting content rating and if nowPlaying is directplay or transcode, also getting information on video and audio codecs.
- Update log system to better organize logs.  First isolate PLEXLib logs to PLEX isolated log files.

**v2.10.6 Community Updates**\
Enhancement - Digital Picture Frame Mode (Issue #48)
- Update image upload to support Zip files and sub-folders
- Adjust 'Background Art' logic checkbox to set the image as a 'Full Screen' image.
- Disable 'blur' for background image when 'Background Art' is selected for custom configuration.
- Update custom image select to support sub-folders

Updates and Bug Fixes:
- Attempt to address an issue that users are experiencing when upgrading from 2.10.4 to 2.10.5.  Possible issue around how the refresh system as implemented and an adjustment for that now has been done.  Recreation unsuccessful. (Issue #27 Issue #56)
- Minor adjustments to the backend as discovered when working on Issue #48

**v2.11.0 Community Updates**\
Enhancement - Digital Picture Frame Mode (Issue #48)
- Fix issue with 'Custom Image Select' not reloading to its proper position.
- Add 'Random' option for list of images for future use.
- Update 'Custom Images' count to support sub-folders
- When digital picture frame is not active, enable CSS blur and other changes that got applied
- TODO: Adjust Unzip to work as 'Albums' when using Custom Images

Bug: Config values how showing correctly on Save (Issue #62)
- Adjust Save Sleep time from 2 seconds to 5 seconds
- Move the include of config.php up to the second call in all the settings files
- Should also address problem reported in Issue #27

Enhancement: Cache Config Options (Issue #63)
- Add 'Cache' configuration to 'Common Configuration' to control cache paths and enable/disable 24h cleanup.

Cache Images Enabled but Posters disappearing (Issue #58)
- Addressed in Issue #63

Enhancement: Plex Function Isolation (Issue #64)
- Migrate metadata reading from getData to PlexLib for Now Showing and Coming Soon.
- Continue to migrate Plex related actions from getData to PlexLib

Enhancement: Multiple IP Clients for Now Showing (Issue #59)
- Update Plex Client IP field to support 3 ip addresses (length of 47char)
- Add function to process multiple IP address and client names in the PlexLib

Cache Images - No file extensions (Issue #26)
- Adjustment was addressed in v2.10.x
- Bug: The images that come from PLEX lose there metadata when saved to cache folder.  New way to get files will need to be found.

Updates and Bug Fixes:
- Update 'Posters' count to support sub-folders
- Add 'Background Art' to count display
- Add 'logs' to count display
- Clean up old un-used fonts.

**v2.11.1 Community Updates**\
Enhancement: Cache Config Options (Issue #63)
- Enable 'Clear Cache' for Background Art and Logs.

**v2.11.2 Community Updates**\
Enhancement: Cache Config Options (Issue #63)
- Consolidate all CacheClear functions into a single reusable function.
- Add placeholder for Cache config input fields

Enhancement: Full Screen Poster (Issue #57)
- Full Screen Poster using 'FullScreenArtMode'.

Updates and Bug Fixes:
- Update Custom Image upload to support only the following file types: zip/jpg/jpeg/gif/png