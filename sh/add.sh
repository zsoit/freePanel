#!/bin/bash

echo "========================="
echo "=   ADD WEBSITE & SFTP  ="
echo "========================="


name=$1
password=$2
domain=$3

if [ -z "$name"  ] || [ -z "$password"  ] || [ -z "$domain"  ]
then
    echo "Variables error !"
    exit 1
fi



echo $name $password $domain

# USUWA JESLI JEST
userdel -f ${name}
rm -rf /www/${name}/
rm -rf /etc/apache2/sites-available/${domain}.conf
rm -rf /etc/apache2/sites-available/${domain}-le-ssl.conf

#UZYTKOWNIK
groupadd -f ${name}
useradd -g ${name} ${name}``
usermod -g sftp_users -d /www/${name} -s /dev/null ${name}
#usermod -g www-data ${name}
echo "${name}:${password}" | chpasswd

#KATALOG
if [ -d "/www/${name}/" ]
then
    echo "Katalog istnieje!"
    exit 1
fi
sudo mkdir /www/${name}/
sudo mkdir /www/${name}/public_html
sudo mkdir /www/${name}/private

cp /root/template/index.php /www/${name}/public_html/index.php
chown -R ${name}:sftp_users /www/${name}/public_html
chown -R ${name}:sftp_users /www/${name}/private

#KONIFGURACJA-APACHE
touch /etc/apache2/sites-available/${domain}.conf
echo "
<VirtualHost *:80>
        DocumentRoot /www/${name}/public_html/
        ServerName ${domain}
</VirtualHost>
" > /etc/apache2/sites-available/${domain}.conf
cd /etc/apache2/sites-available/; a2ensite ${domain}.conf
sleep 2s && systemctl reload apache2
