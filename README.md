Projeto PHP-BR
========================

Este projeto tem como objetivo o desenvolvimento
de um portal para a comunidade PHP no Brasil.

Dúvidas? phpbr@yahoo.ca

```
irc.freenode.net
   _   _      _   _    _______           _______         ______   _______
  ( ) ( )    ( ) ( )  (  ____ )|\     /|(  ____ )       (  ___ \ (  ____ )
 _| |_| |_  _| |_| |_ | (    )|| )   ( || (    )|       | (   ) )| (    )|
(_   _   _)(_   _   _)| (____)|| (___) || (____)| _____ | (__/ / | (____)|
 _| (_) |_  _| (_) |_ |  _____)|  ___  ||  _____)(_____)|  __ (  |     __)
(_   _   _)(_   _   _)| (      | (   ) || (             | (  \ \ | (\ (
  | | | |    | | | |  | )      | )   ( || )             | )___) )| ) \ \__
  (_) (_)    (_) (_)  |/       |/     \||/              |/ \___/ |/   \__/
```

1) Instalação:
----------------------------------

Se você estiver em uma máquina rodando UBUNTU:

Exemplo de config do apache:

    cd /var/www/html

    git clone https://rodolfobandeira@bitbucket.org/rzarthuso/php-br.git

Edite seu arquivo de configuração do Apache:

    sudo vim /etc/apache2/sites-available/000-default.conf

    <VirtualHost *:80>
    	ServerAdmin webmaster@localhost
    	DocumentRoot /var/www/html/php-br/web
    <Directory /var/www/html/php-br/web>
        AllowOverride All
        Order allow,deny
        Allow from All
    </Directory>
    	ErrorLog ${APACHE_LOG_DIR}/error.log
    	CustomLog ${APACHE_LOG_DIR}/access.log combined
    </VirtualHost>

    sudo service apache2 restart

    cd php-br

    chmod +x install.sh

    ./install.sh

    curl -s http://getcomposer.org/installer | php

    php composer.phar install 


2) Front-end
----------------------------------
Necessario: NodeJS + NPM. 

    apt-get install nodejs-legacy

Se voce instalou o node ao inves do nodejs-legacy, remova e instale novamente com os seguintes comandos:

    apt-get remove node
    apt-get autoremove
    apt-get install nodejs-legacy

Instale bower e grunt-cli em sua maquina:
    
    npm install -g bower grunt-cli

Para compilar os arquivos de estilo e JS:

    cd src/Phpbr/Bundle/AppBundle/Resources/public/assets
    npm install && bower install --allow-root
    grunt build

Você verá na tela:

    Running "sass:dist" (sass) task
    File "css/app.css" created.

    Done, without errors

Para compilar automaticamente ao salvar:

    cd src/Phpbr/Bundle/AppBundle/Resources/public/assets
    grunt watch


Colaboradores:
----------------------------------

  * Rodrigo Z Arthuso;  IRC NICK: **rodd**

  * Rodolfo Bandeira;  IRC NICK: **ule**

  * Gabriel Novaes; IRC NICK: **codeman**

----------------------------------