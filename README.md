# Plex-Movie-Poster-Display
Scraps the Plex sessions page to display the current playing movie or TV show poster on a screen.

Disclaimer – I am a network engineer not a programmer. I play around with code. I am publishing this to give back to the communities that has helped me learn. There maybe better ways of scraping the Plex Posters, but this is the way I chose to do it. I am open to suggestions. Use at your own risk.

I decided to rewrite the program in PHP and make it browser based. This allows me to have the Raspberry Pi boot to the desktop, automatically start a browser in kiosk mode, and open the PHP site.

This script scraps http://<IP Address of Plex server>:32400/status/sessions for clients and displays the poster of the currently playing movie or TV show. If nothing is currently playing it will pull a random poster of an unwatched movie.

## Prerequisites
 - Web Server – I am running NGINX
 - PHP – I am running version  5.6.22

## Features 
- Custom Text on top and bottom of posters.
- Cache posters locally.

## Installation
- Copy all the files into the root of your web server.
- Fix permission on cache folder (chmod 777 cache)
- Edit the config.php file.
- Open the URL to your server in a broswer.
