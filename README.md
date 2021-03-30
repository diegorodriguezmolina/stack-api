## Laravel StackOverflow API

## Installation

To install the composer dependencies you can use:

```bash
composer install
```

## Tests

Navigate to the project root and run `vendor/bin/phpunit` after installing all the composer dependencies.

## API documentation
The project uses [Swagger](https://github.com/DarkaOnLine/L5-Swagger) to render the API docs, you can run the following command to compile and render the API docs
```bash
php artisan l5-swagger:generate
```
The path to view the documentation is: `/api/documentation`


