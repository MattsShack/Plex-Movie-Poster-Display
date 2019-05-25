FROM richarvey/nginx-php-fpm
LABEL Description="Scraps the Plex sessions page to display the current playing movie or TV show poster on a screen."

# Copy working files
COPY . /var/www/html/