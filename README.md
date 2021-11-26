# Example App for Core Framework

This is a demonstration subject for a basic core-based application.

## Requirements

- docker, docker-compose
- PHP 7.4+ and Composer on the local host (if you don't want to install it inside the container)

## Contents

- docker-compose.yml that provides
  - a basic Apache-based Webserver
  - a preconfigured MariaDB/MySQL database server
  - a memcached host
- a Dockerfile that serves a minimal configuration/runtime environment

## Installation

- Clone the repository
- execute `composer install` or `composer update` in the repository directory
  You might need `--ignore-platform-reqs` if you're encountering issues with missing PHP extensions
- Explore the project
- To run the webserver, see below.

## Running provided containers

You can simply launch the full set of services using docker-compose.
The service 'app' is available via local port 8381.
The provided configuration for Apache webserver has a VHost configuration for two access cases:
- http://localhost:8381 will launch the application itself
- http://example.localhost:8381 is an alias to it
- http://architect.localhost:8381 will launch the architect (you can leave out the localhost if you want to)

NOTE: this method of using localhost subdomains won't work on every system out-of-the-box.
You might have to create an entry in your `/etc/hosts` pointing f.e. `architect.localhost` to `127.0.0.1`.

The docker-compose.yml comes with a memcached service, too.
You may enable it/use it, by setting the respective config in config/environment.json.
By default, a 'memory' driver is used to improve usage during experimenting with it.

## Explanation of contents

Runtime-related (to ensure you can start it):
- `docker/app`: Dockerfile providing Apache Webserver and a preconfigured PHP 7.4 based on `php:7.4-apache`
- `docker/volumes/app/apache2/sites-enabled`: Apache Configuration
- `docker/volumes/app/log`: Log directory (for debugging purposes)
- `docker/volumes/app/www/app`: Document root (.htaccess and index.php) for starting the app
- `docker/volumes/app/www/architect`: Document root (.htaccess and index.php) for starting the architect
- `docker/volumes/app/www/src`: Source-Directory placeholder
- `bootstrap.php`: Helper file to register Composer Autoloader

App-related (the sourcecode of the application):
- `backend/class/app.php`: Application base class
- `backend/class/context/start.php`: An example context
- `config/app.json`: Application/Context configuration
- `config/environment.json`: Environment/runtime configuration
- `frontend/view/start/default.twig`: Simple template for context `start` with view `default`
- `frontend/view/start/create.twig`: Simple template for context `start` with view `create`

The app also injects the **rest** package, which allows flexible usage of regular 'browser-compatible' responses or JSON/REST-responses depending on the headers.
Try it out yourself by accessing:
http://localhost:8381/start using your browser or accessing it via a REST-Client using the header `Accept: application/json`.
The same goes for the data-manipulating endpoint http://localhost:8381/start/create.

When calling as a REST Client, you won't receive a human/browser-readable template/rendered page, obviously.
Instead, you're getting the response data itself.

## Notes

The application is meant to be run from this project root. **architect** is installed if you perform a composer install or update right in this directory (as in require-dev). If you create a more complex project, you might have to include architect separately in a parent composer.json that assembles your full project structure.
