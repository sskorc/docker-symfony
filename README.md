# docker-symfony

This is a simple REST API project written in [Symfony](http://symfony.com/), running on multiple
[Docker](http://www.docker.com/) containers. [Docker Compose](http://docs.docker.com/compose/)
is used for orchestration.

## Requirements

Basically, you need to have [Docker Compose installed](http://docs.docker.com/compose/#installation-and-set-up)

### Mac OS X
If Mac OS X is your host OS and you use boot2docker to launch Docker you will probably encounter the [bug with writing
to shared volume](https://github.com/boot2docker/boot2docker/issues/581). The following workaround works perfectly:

1. SSH to boot2docker VM: `boot2docker ssh`
2. Edit the `/var/lib/boot2docker/profile` file: `sudo vi /var/lib/boot2docker/profile`
3. Paste the following line:
```
umount /Users
mount -t vboxsf -o uid=33,gid=33 Users /Users
```
4. Exit the VM and restart it: `boot2docker restart`

## How to use it?

### Start the environment

In the project root directory run the following command:

```
docker-compose up -d
```

This command will build `web` Docker image and run its container together with `db` container.

### Install dependencies

1. Log in to the container by running the following command:

```
docker exec -i -t dockersymfony_web_1 bash
```

2. Install dependencies by running the following command:
```
cd /var/www/html/docker-symfony && composer install -n
```

### Update your hosts

#### Mac OS X

1. Check boot2docker IP address: `boot2docker ip`.
2. Assuming its 192.168.59.103, add the following line to your `/etc/hosts` file:

```
192.168.59.103 docker-symfony.dev
```

#### Linux

TBA

#### Windows

1. Check boot2docker IP address: `boot2docker ip`.
2. Assuming its 192.168.59.103, add the following line to your `%SystemRoot%\System32\drivers\etc\hosts` file:

```
192.168.59.103 docker-symfony.dev
```

### Test the application

- You can test the application by sending POST request with `name` parameter to `http://docker-symfony.dev/api/products`.
- You can get all products by sending GET request to `http://docker-symfony.dev/api/products`.
- You can get single product by sending GET request to `http://docker-symfony.dev/api/products/` followed by product's
id eg.: `http://docker-symfony.dev/api/products/548dab4ed021251d008b4567`.
