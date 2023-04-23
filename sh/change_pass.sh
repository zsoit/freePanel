#!/bin/bash

echo "============================"
echo "=      ZMIANA HASLA SFTP   ="
echo "============================"
# cat /etc/passwd | awk -F':' '{ print x $1}' | xargs -n1 groups | grep 'sftp_users'
echo "============================"

name=$1
password=$2


if [ -z "$name"  ] || [ -z "$password"  ]
then
    echo "Variables error !"
    exit 1
fi


# echo "${name}:${password}" | chpasswd


echo -e "$(openssl passwd -1 $password)\n$(openssl passwd -1 $password)" | passwd $name
echo "> Password for ${name} was changed"
