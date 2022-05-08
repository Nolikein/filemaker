# FileMaker

A project about to make files by using shortcuts and the powerfull of poo

## Run from docker

Build le Dockerfile
`docker-compose build`

Lancer le process en fond:
`docker-compose up -d`

Exécuter des commandes dans le process php
`docker-compose exec php composer install`
`docker-compose exec php ./vendor/bin/phpunit`