# FileMaker and PhpFileMaker
![PHP Version](https://img.shields.io/badge/PHP-8.1-blue)
![Packagist version](https://img.shields.io/packagist/v/Nolikein/filemaker)
![Packagist License](https://img.shields.io/packagist/l/nolikein/filemaker)


A project about to make php files from an abstract file maker by using the powerfull of poo.

## Installation

Read the [installation chapter](https://github.com/Nolikein/filemaker/wiki/Installation) of the documentation.

## Usage

Read the [documentation](https://github.com/Nolikein/filemaker/wiki) for that.

## Testing

For the moment, the project does not implements a CI because i usually use gitlab CI and not github CI. The time to convert the current [gitlab-ci](https://github.com/Nolikein/filemaker/blob/master/.gitlab-ci.yml), the project will be checked by my own. The latest PHPUnit check and Gitlab personnal runner check was successfull.

The tests use [Docker](https://www.docker.com) and its magical side for virtual process (called containers) from customisable images.

+ Build the Dockerfile:
`docker-compose build`

+ Run the php container in background:
`docker-compose up -d`

+ Example command you could use in the php container:
  + `docker-compose exec php composer install`
  + `docker-compose exec php ./vendor/bin/phpunit`

## License
The current librairy is under the [MIT License](https://github.com/Nolikein/filemaker/blob/master/LICENSE).

## Support
That librairy does not supports everything you'll need, that's why you could propose ideas.
For that, it's simple: open a new issue for each different implementation.
Just remember that i made this librairy on my free time :).
