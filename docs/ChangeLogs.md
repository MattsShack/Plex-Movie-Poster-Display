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