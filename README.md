# docker-symfony

This is a simple REST API project written in [Symfony](http://symfony.com/), running on multiple
[Docker](http://www.docker.com/) containers. [Docker Compose](http://docs.docker.com/compose/)
is used for orchestration.

## Previous versions
- If you are looking for a multiple containers example with Apache,
check the [`apache` tag](https://github.com/sskorc/docker-symfony/tree/apache).
- If you are looking for a single container example with supervisor and Vagrant,
check the [`single-container` tag](https://github.com/sskorc/docker-symfony/tree/single-container).

## Multiple containers

This environment uses 3 containers:

1. The `php` container with PHP-FPM, being build from `Dockerfile`. It's based on `sskorc/symfony2-mongo` image. You can
find its `Dockerfile` in [this repo](https://github.com/sskorc/symfony2-mongo-dockerimage). This container shares
the application sources with the host machine.
2. The `nginx` container with nginx, pulled directly from the official nginx image on Docker Hub. This container shares
the application sources with the host machine.
3. The `db` container with MongoDB, pulled directly from the official MongoDB image on Docker Hub. This container shares
DB data with the Docker Machine VM.

Containers are managed by Docker Compose. The configuration is in the `docker-compose.yml`.

## Requirements

Basically, you need to have [Docker Compose installed](http://docs.docker.com/compose/#installation-and-set-up).

If you are using Mac OS X or Windows as your host OS, I recommend using [Docker Machine](https://docs.docker.com/machine/)
as the proxy VM to run Docker.

## How to use it?

### Start the environment

In the project root directory run the following command:
```
docker-compose up -d
```

This command will build the `php` Docker image and run its container together with `nginx` and `db` containers.

### Install dependencies

1. Log in to the `php` container by running the following command:
    ```
    docker exec -it dockersymfony_php_1 bash
    ```

2. Install dependencies by running the following command:
    ```
    cd /var/www/html/docker-symfony && composer install -n
    ```

### Update your hosts

#### Mac OS X

1. Check Docker Machine IP address: `docker-machine ip dev`.

2. Assuming it's 192.168.99.100, add the following line to your `/etc/hosts` file:
    ```
    192.168.99.100 docker-symfony.dev
    ```

#### Linux

TBA

#### Windows

1. Check Docker Machine IP address: `docker-machine ip dev`.

2. Assuming it's 192.168.99.100, add the following line to your `%SystemRoot%\System32\drivers\etc\hosts` file:
    ```
    192.168.99.100 docker-symfony.dev
    ```

### Test the application

- You can test the application by sending the POST request with the `name` parameter to `http://docker-symfony.dev/api/tasks`.
Example:
    ```
    curl -w "\n" -H "Content-Type: application/json" -X POST -d '{"name":"Hello!"}' http://docker-symfony.dev/api/tasks
    ```

- You can get all products by sending the GET request to `http://docker-symfony.dev/api/tasks`. Example:
    ```
    curl -w "\n" -X GET http://docker-symfony.dev/api/tasks
    ```

- You can get a single task by sending the GET request to `http://docker-symfony.dev/api/tasks/` followed by the
task's id. Example:
    ```
    curl -w "\n" -X GET http://docker-symfony.dev/api/tasks/548dab4ed021251d008b4567
    ```

