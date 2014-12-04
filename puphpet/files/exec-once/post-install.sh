#!/bin/sh

echo "Setando acl no seu linux!"

cd /var/www/php-br/app/
mkdir logs
mkdir cache
#chmod 0777 logs
#chmod 0777 cache

sudo setfacl -R -m u:"vagrant":rwX -m u:`whoami`:rwX cache logs
sudo setfacl -dR -m u:"vagrant":rwX -m u:`whoami`:rwX cache logs

# Melhorar:
sed -i "s/user = www-data/user = vagrant/" /etc/php5/fpm/pool.d/www.conf
sed -i "s/group = www-data/group = vagrant/" /etc/php5/fpm/pool.d/www.conf
sed -i "s/listen.owner = www-data/listen.owner = vagrant/" /etc/php5/fpm/pool.d/www.conf
sed -i "s/listen.group = www-data/listen.group = vagrant/" /etc/php5/fpm/pool.d/www.conf
sed -i "s/user www-data/user vagrant/" /etc/nginx/nginx.conf

echo "Permissoes setadas!"
echo "Instalando os pacotes do composer.json na pasta vendors..."

cd /var/www/php-br/
composer install

echo "Pasta vendors instalada!"
echo "Configurando Nginx"

mv /var/www/php-br/php-br.dev.conf /etc/nginx/sites-available/
cd /etc/nginx/sites-enabled/
ln -s /etc/nginx/sites-available/php-br.dev.conf php-br.dev.conf
service php5-fpm restart
service nginx restart

cd /var/www/php-br/
chown -R vagrant: ./
chmod -R 0775 ./

echo "Nginx configurado!"