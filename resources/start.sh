#!/bin/bash

#start nginx
service nginx start &

#start php
service php7.3-fpm start &

sleep 10s
supervisord -n
