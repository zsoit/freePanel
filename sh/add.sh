#!/bin/bash

echo "========================="
echo "=   ADD WEBSITE & SFTP  ="
echo "========================="

name=$1
password=$2
domain=$3

if [ -z "$name"  ] || [ -z "$password"  ] || [ -z "$domain"  ]
then
    echo "ERROR: Variables error !"
    exit 1
fi

echo $name $password $domain

# CHECK USER EXISTS
if id "$name" >/dev/null 2>&1; then
    echo "ERROR: THE USER $name EXISTS"
    exit 1
fi

# CHEC CATALOG EXISTS
if [ -d "/www/${name}/" ]
then
    echo "ERROR: THE CATALOG EXISTS!"
    exit 1
fi

# MAKE DIRECTORY
sudo mkdir /www/${name}/
sudo mkdir /www/${name}/public_html
sudo mkdir /www/${name}/private

# # CREATE USER
sudo useradd -m  -d /www/$name -p  $(openssl passwd -1 $password) $name
sudo usermod -a -G sftp_users -s /dev/null $name

# COPY DEFAULT INDEX.PHP
sudo cp /root/template/index.php /www/${name}/public_html/index.php

# LINUX RIGHT
sudo chown -R ${name}:sftp_users /www/${name}/public_html
sudo chown -R ${name}:sftp_users /www/${name}/private

# APACHE-2-CONFIGURE
sudo touch /etc/apache2/sites-available/${domain}.conf
echo "
<VirtualHost *:80>
        DocumentRoot /www/${name}/public_html/
        ServerName ${domain}
</VirtualHost>
" > /etc/apache2/sites-available/${domain}.conf
cd /etc/apache2/sites-available/; a2ensite ${domain}.conf

echo "User $name has been added!"

sudo sleep 1s && sudo systemctl reload apache2