# Plex Movie Poster Display
Scraps the Plex sessions page to display the current playing movie or TV show poster on a screen.

Disclaimer – I am a network engineer not a programmer. I play around with code. I am publishing this to give back to the communities that has helped me learn. There may be better ways of scraping the Plex Posters, but this is the way I chose to do it. I am open to suggestions. Use at your own risk.

I decided to rewrite the program in PHP and make it browser based. This allows me to have the Raspberry Pi boot to the desktop, automatically start a browser in kiosk mode, and open the PHP site.

This script scraps http://IP_ADDRESS_OF_PLEX_SERVER>:32400/status/sessions for clients and displays the poster of the currently playing movie or TV show. If nothing is currently playing it will pull a random poster of an unwatched movie.

## Dev Branch
I have added a dev branch to merge all changes too. I will be adding my changes to the branch in the future.

## My Setup
Plex Media Server is running on a dedicated server.
Plex Movie Poster Display is running on separate Raspberry Pi 3 connected to a screen via HDMI. On boot up the Pi launches Chromium in kiosk mode and loads the Plex Movie Poster Display URL.

## Help
https://www.mattsshack.com/plex-movie-poster-display/

## Plex Information for Setup
Plex Information that is required for setup can be found [here](docs/PlexData.md)

## Local Installation
If you would like to setup locally the installation instructions can be found [here](docs/Setup_local.md).

## Docker Setup
If you would like to create a docker image locally the instructions can be found [here](docs/Setup_docker.md).

## [Change Logs](documentation/ChangeLogs.md)

**v2.x To Do**\
Font Outline Size and Color for the Bottom Text.\
Installation script for Raspberry Pi.

**Ideas for Future Releases:**\
Art mode.\
Options to display audio and video information.\
Aspect ratio detection / fix (Example 3:2).\
Information from items being played from music section.

**Credits**\
Plex Movie Poster Display is built using Bootstrap , JQuery, Popper.js, jQuery – Marquee and bootstrap-colorpicker. The admin page is based on the Bootstrap “Checkout Example“.

PLEX, PLEX PASS, myPLEX, PLEX MEDIA SERVER, PLEX MEDIA CENTER, PLEX MEDIA MANAGER, PLEX HOME THEATER, PLEX TV, PLEX.TV, the Plex Play Logo (“>” in stylized format) are trademarks that are the exclusive property of Plex, Inc.