#! /bin/bash

docker tag sskorc/docker-symfony-dist:latest sskorc/docker-symfony-dist:$TRAVIS_BUILD_NUMBER

docker push sskorc/docker-symfony-dist

curl -u sskorc:$TUTUM_API_KEY -H "Content-Type: application/json" -X POST -d '{"reuse_volumes":false}' https://dashboard.tutum.co/api/v1/service/$PHP_SERVICE_UUID/redeploy/
