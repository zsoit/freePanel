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

# CREATE USER
sudo groupadd -f ${name}
sudo useradd -m  -d /www/$name -p  $(openssl passwd -1 $password) $name
sudo usermod -g sftp_users -s /dev/null ${name}

# useradd -g ${name} ${name}
# sudo usermod -g sftp_users -d /www/${name} -s /dev/null ${name}
# usermod -a -G www-data $name
# echo "${name}:dupa" | chpasswd
# echo -e "$password\n$password" | passwd $name

# MAKE DIRECTORY
sudo mkdir /www/${name}/
sudo mkdir /www/${name}/public_html
sudo mkdir /www/${name}/private

# COPY DEFAULT INDEX.PHP
cp /root/template/index.php /www/${name}/public_html/index.php

# LINUX RIGHT
sudo chown -R ${name}:sftp_users /www/${name}/public_html
sudo chown -R ${name}:sftp_users /www/${name}/private

# APACHE-2-CONFIGURE
touch /etc/apache2/sites-available/${domain}.conf
echo "
<VirtualHost *:80>
        DocumentRoot /www/${name}/public_html/
        ServerName ${domain}
</VirtualHost>
" > /etc/apache2/sites-available/${domain}.conf
cd /etc/apache2/sites-available/; a2ensite ${domain}.conf

echo "User $name has been added!"

sleep 1s && systemctl reload apache2