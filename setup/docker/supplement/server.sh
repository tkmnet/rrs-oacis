#!/bin/sh

cd `dirname $0`

/home/oacis/oacis_start.sh &
php -S 0.0.0.0:3080 -t public -c php.ini public/_app.php