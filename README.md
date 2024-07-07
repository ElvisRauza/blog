# ICT Blog example

Create `.env` file from `.env.example` file. Remember to set env variables.

## To run project

Recomended to use [Laravel Sail](https://laravel.com/docs/11.x/sail).
Sail requires [Docker desktop](https://www.docker.com/products/docker-desktop/)!
On Windows you also will need [WSL2](https://learn.microsoft.com/en-us/windows/wsl/install)

To run sail after pulling project, checkout [documentation](https://laravel.com/docs/11.x/sail#installing-composer-dependencies-for-existing-projects)
You need to run following command:

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

If using Sail make sure you have set `DB_PASSWORD` in `.env` file

Next run following commands:

```
# Start sail
vendor/bin/sail up -d

# Install composer
vendor/bin/sail composer install

# Restart sail using latest composer deps
vendor/bin/sail up -d

# Create app key
vendor/bin/sail artisan key:generate

# Create DB
vendor/bin/sail artisan migrate

# Seed DB
vendor/bin/sail artisan db:seed

# Install front-end dependencies
vendor/bin/sail yarn

# Build front-end assets
vendor/bin/sail yarn build
```

Now you can view blog in http://localhost


## Extras
You can access mailpit to view emails under http://localhost:8025

You can access adminer to manage database under http://localhost:8080
