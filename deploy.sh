#! /bin/bash

docker tag sskorc/docker-symfony-dist:latest sskorc/docker-symfony-dist:$TRAVIS_BUILD_NUMBER

docker push sskorc/docker-symfony-dist

curl -u sskorc:$DOCKER_CLOUD_API_KEY -H "Content-Type: application/json" -X POST -d '{"reuse_volumes":false}' https://cloud.docker.com/api/app/v1/service/$PHP_SERVICE_UUID/redeploy/
