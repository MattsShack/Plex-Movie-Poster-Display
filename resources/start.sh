#!/bin/bash

#start ssh
service ssh start
service ssh enable
service ssh status

#start nginx
service nginx start &

#start php
service php7.3-fpm start &

sleep 10s
supervisord -n
