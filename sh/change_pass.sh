#!/bin/bash

echo "============================"
echo "=      ZMIANA HASLA SFTP   ="
echo "============================"
# cat /etc/passwd | awk -F':' '{ print x $1}' | xargs -n1 groups | grep 'sftp_users'
echo "============================"

name=$1
password=$2

echo "${name}:${password}" | chpasswd

echo "> Haslo dla ${name} zostalo zmienione!"
