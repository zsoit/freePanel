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
killall -u ${name}
userdel -f ${name}
rm -rf /www/${name}/
rm -rf /etc/apache2/sites-available/${domain}.conf
rm -rf /etc/apache2/sites-available/${domain}-le-ssl.conf
# certbot delete --cert-name ${domain}

