#!/bin/sh
###################################################################
#
# src/Phpbr/AppBundle/Resources/public/assets
#
###################################################################

echo 'Compiling SCSS';
cd src/Phpbr/AppBundle/Resources/public/assets
grunt build

cd ../../../../../..


echo 'Removing css and js';
rm -rf web/css/*
rm -rf web/js/*


echo 'Dumping and Installing assets';
php app/console assetic:dump
php app/console assets:install
