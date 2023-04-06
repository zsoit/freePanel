#!/bin/bash
current_date=$(date +"%Y-%m-%d")

for n in $(cat backup.txt )
do
    echo "Kopia strony - $n"
    mkdir /backup/www/${n}
    tar -cvpzf /backup/www/${n}/${current_date}-${n}.tar.gz /www/${n}/public_html
done
ls -l /backup/www/
