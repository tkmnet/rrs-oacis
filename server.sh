#!/bin/sh

cd `dirname $0`

php -S 0.0.0.0:3080 -t public -c php.ini public/_app.php
