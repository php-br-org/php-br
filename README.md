Projeto PHP-BR
========================

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

Instalação por Vagrant:

Necessário:

- Virtualbox

- Vagrant

- rsync (se Windows)


Vá até a raiz do projeto e execute:

    vagrant up

Uma vez a VM configurada, execute o seguinte comando para sincronizar os arquivos alterados entre sua maquina e a VM:

    vagrant rsync-auto

---

2) Instalação em seu próprio server:
-------------------------
Se você estiver em uma máquina rodando UBUNTU:

Exemplo de config do apache:

    cd /var/www/html

    git clone https://github.com/php-br-org/php-br.git

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

3) Front-end:
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

    cd src/Phpbr/Bundle/AppBundle/Resources/public/assets
    npm install && bower install --allow-root
    grunt build

Você verá na tela:

    Running "sass:dist" (sass) task
    File "css/app.css" created.

    Done, without errors

Para compilar automaticamente ao salvar (A executar na sua maquina):

    cd src/Phpbr/Bundle/AppBundle/Resources/public/assets
    grunt watch


4) Observações:
----------------------------------

Para acessar a VM, execute o seguinte comando na raiz do projeto:

    vagrant ssh

Para limpar o cache da apliacao (a executar diretamente na VM):

    vagrant ssh
    cd /var/www/php-br
    php app/console cache:clear
    # ou
    sudo rm -rf app/cache/*

Para cada alteracao feita no .gitignore, execute (na raiz do projeto):

    git rm -r --cached .
    git add .
    git commit -m "Atualizando .gitignore"