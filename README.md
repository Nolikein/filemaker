# FileMaker and PhpFileMaker

A project about to make php files from an abstract file maker by using the powerfull of poo.

## Wiki

[Read the doc](https://github.com/Nolikein/filemaker/wiki)

## Testing

The tests use [Docker](https://www.docker.com) and its magical side for virtual process (called containers) from customisable images.

+ Build the Dockerfile:
`docker-compose build`

+ Run the php container in background:
`docker-compose up -d`

+ Example command you could use in the php container:
  + `docker-compose exec php composer install`
  + `docker-compose exec php ./vendor/bin/phpunit`
