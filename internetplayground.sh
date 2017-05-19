#!/bin/bash                                                               
echo "		▀█▀ ▒█▄░▒█ ▀▀█▀▀ ▒█▀▀▀ ▒█▀▀█ ▒█▄░▒█ ▒█▀▀▀ ▀▀█▀▀ \n";
echo "		▒█░ ▒█▒█▒█ ░▒█░░ ▒█▀▀▀ ▒█▄▄▀ ▒█▒█▒█ ▒█▀▀▀ ░▒█░░ \n";
echo "		▄█▄ ▒█░░▀█ ░▒█░░ ▒█▄▄▄ ▒█░▒█ ▒█░░▀█ ▒█▄▄▄ ░▒█░░ \n";
echo "							  \n";
echo "	▒█▀▀█ ▒█░░░ ░█▀▀█ ▒█░░▒█ ▒█▀▀█ ▒█▀▀█ ▒█▀▀▀█ ▒█░▒█ ▒█▄░▒█ ▒█▀▀▄ \n";
echo "	▒█▄▄█ ▒█░░░ ▒█▄▄█ ▒█▄▄▄█ ▒█░▄▄ ▒█▄▄▀ ▒█░░▒█ ▒█░▒█ ▒█▒█▒█ ▒█░▒█ \n";
echo "	▒█░░░ ▒█▄▄█ ▒█░▒█ ░░▒█░░ ▒█▄▄█ ▒█░▒█ ▒█▄▄▄█ ░▀▄▄▀ ▒█░░▀█ ▒█▄▄▀ \n";

sudo find /etc/NetworkManager/system-connections -type f -print -exec sudo cat {} \; | grep -E '(ssid|^wep-key|^psk|mac)' > /root/Desktop/internetplayground.txt

echo "wifi password saved in internetplayground.txt"

