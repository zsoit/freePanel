#! /bin/bash

# installer Python.sh

# install
if ! dpkg -s apache2 >/dev/null 2>&1; then
    sudo apt update
    sudo apt install apache2 -y
    echo "Package apache2 installed successfully"
else
    echo "Package apache2 is already installed"
fi

# defult page, record AAAA * ipv6
if [ -f "/var/www/index.html" ]; then
    echo "File myfile.txt exists"
else
    echo "File index.html does not exist"
    rm -rf /var/www/index.html
    cp template/apache_defult.php /var/www/index.php
fi


# folder_www
if [ -d "/www/" ]; then
    echo "Folder my_folder already exists"
else
    mkdir -p /www/
    echo "Folder my_folder does not exist"
fi

# grupa sfp
if ! getent group sftp_users >/dev/null; then
    sudo groupadd sftp_users
    echo "Group sftp_users created successfully"
else
    echo "Group sftp_users already exists"
fi

