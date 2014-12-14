# docker-symfony

This is a simple REST API project written in [Symfony](http://symfony.com/),
running on [Vagrant](http://www.vagrantup.com/) and [Docker](http://www.docker.com/).

## How to use it?

Basically, you need to have [Vagrant installed](https://docs.vagrantup.com/v2/installation/index.html).

### Start the environment

In the project root directory run the following command:

```
vagrant up --provider=docker
```

This command will bring up proxy VM based on Ubuntu, install Docker on it, build Docker image and run container with
Supervisor and other stuff like SSH, Apache2, PHP and MongoDB.

### Log in to the container

You can log in to the container by running the following command (the password is `symfony`):

```
vagrant ssh
```

### Update your hosts

Add the following line to your `/etc/hosts` file:

```
192.168.33.20 docker-symfony.dev
```

### Test the application

- You can test the application by sending POST request with `name` parameter to `http://docker-symfony.dev/api/products`.
- You can get all products by sending GET request to `http://docker-symfony.dev/api/products`.
- You can get single product by sending GET request to `http://docker-symfony.dev/api/products/` followed by product's
id eg.: `http://docker-symfony.dev/api/products/548dab4ed021251d008b4567`.
