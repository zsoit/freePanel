#!/bin/bash
echo "============================"
echo "=   DODAJ WORDPRESS/SFTP   ="
echo "============================"
echo "                        "
echo "> Podaj uzytkownika"
read name

echo "> Podaj haslo: "
read password

echo "> Podaj domene: "
read domain


#USUWA JESLI JEST
userdel -f ${name}
rm -rf /www/${name}/
rm -rf /etc/apache2/sites-available/${domain}.conf
rm -rf /etc/apache2/sites-available/${domain}-le-ssl.conf

#UZYTKOWNIK
groupadd -f ${name}
useradd -g ${name} ${name}
usermod -g sftp_users -d /www/${name} -s /dev/null ${name}
#usermod -g www-data ${name}
echo "${name}:${password}" | chpasswd

#KATALOG
sudo mkdir /www/${name}/
sudo mkdir /www/${name}/public_html
chown -R ${name}:sftp_users /www/${name}/public_html

#wordpress
link="https://pl.wordpress.org/latest-pl_PL.zip"
wget ${link} -O /www/${name}/public_html/latest.zip
cd /www/${name}/public_html/
unzip latest.zip
rm latest.zip
chown www-data:www-data -R wordpress


#baza danych
#query="create database if not exists ${name}_wp; CREATE USER if not exists '$name'@'localhost' IDENTIFIED BY '$password';GRANT ALL PRIVILEGES ON ${name}_wp.* TO '$name'@'localhost';"
# query="create database if not exists ${name}_wp;"
# mysql -uwp_creator -pFryz12 -e "$query"

#KONIFGURACJA-APACHE
touch /etc/apache2/sites-available/${domain}.conf
echo "
<VirtualHost *:80>
        DocumentRoot /www/${name}/public_html/wordpress/
        ServerName ${domain}
</VirtualHost>
" > /etc/apache2/sites-available/${domain}.conf
cd /etc/apache2/sites-available/; a2ensite ${domain}.conf
systemctl restart apache2
