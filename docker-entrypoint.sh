#!/bin/bash
if [ "$1" = 'video-service' ]; then
    transmission-daemon -u wishbeen -v ts0705 -c /var/www/Torrent -w /var/www/Torrent -g /var/www/Torrent/.session
    exec apache2-foreground
fi
exec "$@"
