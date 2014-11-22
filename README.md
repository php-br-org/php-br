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

    

Colaboradores:
----------------------------------

  * Rodrigo Z Arthuso;  IRC NICK: **rodd**

  * Rodolfo Bandeira;  IRC NICK: **ule**

  * Gabriel Novaes;

----------------------------------