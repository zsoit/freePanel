#!/bin/bash
echo "============================="
echo "=   DELETE WEBSITE & SFTP    ="
echo "============================="
# cat /etc/passwd | awk -F':' '{ print x $1}' | xargs -n1 groups | grep 'sftp_users'

name=$1
domain=$2


if [ -z "$name"  ] || [ -z "$domain"  ]
then
    echo "Variables error !"
    exit 1
fi


#USUWA
sudo killall -u ${name}
sudo userdel -f ${name}
sudo rm -rf /www/${name}/
sudo rm -rf /etc/apache2/sites-available/${domain}.conf
# rm -rf /etc/apache2/sites-available/${domain}-le-ssl.conf
sudo sleep 1s && sudo systemctl reload apache2


