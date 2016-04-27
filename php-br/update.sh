#!/bin/sh

echo "Setando acl no seu linux!"
sudo apt-get install acl
HTTPDUSER=`ps aux | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs
sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs
echo "Permissoes setadas!"


echo "Download do composer... "
curl -s http://getcomposer.org/installer | php
echo "Instalando os pacotes do composer.json na pasta vendors..."
php composer.phar install
echo "Pasta vendors instalada!"

echo "Instalando and Dump para Assets: "
php app/console assets:install web
php app/console assetic:dump web
echo "ok!! "

echo "Removendo cache..."
rm -rf app/cache/*
php app/console cache:clear -e prod 
echo "ok!! "


