Projeto PHP-BR
========================

[![Build Status](https://travis-ci.org/php-br-org/php-br.png?branch=master)](https://travis-ci.org/php-br-org/php-br) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/php-br-org/php-br/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/php-br-org/php-br/?branch=master)

http://php-br.org

Este projeto tem como objetivo o desenvolvimento
de um portal para a comunidade ##php-br

Dúvidas? ##php-br - irc.freenode.net

```

         888                      888                                        
         888                      888                                        
         888                      888                                        
88888b.  88888b.  88888b.         88888b.  888d888   .d88b.  888d888 .d88b.  
888 "88b 888 "88b 888 "88b        888 "88b 888P"    d88""88b 888P"  d88P"88b 
888  888 888  888 888  888 888888 888  888 888      888  888 888    888  888 
888 d88P 888  888 888 d88P        888 d88P 888  d8b Y88..88P 888    Y88b 888 
88888P"  888  888 88888P"         88888P"  888  Y8P  "Y88P"  888     "Y88888 
888               888                                                    888 
888               888                                               Y8b d88P 
888               888                                                "Y88P"  
```


1) Instalação:
----------------------------------

    git clone https://github.com/php-br-org/php-br.git
    
    cd php-br
    
    docker-compose up -d
    
    docker run --name name_of_my_container -d -p 80:80 bash
    
    chmod +x install.sh
    
    ./install.sh

2) Front-end:
----------------------------------
Necessario: NodeJS + NPM. 

    apt-get install nodejs-legacy

Se voce instalou o node ao inves do nodejs-legacy, remova e instale novamente com os seguintes comandos:

    apt-get remove node
    apt-get autoremove
    apt-get install nodejs-legacy

Instale bower e grunt-cli em sua maquina:
    
    npm install -g bower grunt-cli

Para compilar os arquivos de estilo e JS (A executar na sua maquina):

    cd src/Phpbr/AppBundle/Resources/public/assets
    npm install && bower install --allow-root
    grunt build

Você verá na tela:

    Running "sass:dist" (sass) task
    File "css/app.css" created.

    Done, without errors

Para compilar automaticamente ao salvar (A executar na sua maquina):

    cd src/Phpbr/AppBundle/Resources/public/assets
    grunt watch
