# DevOps Test Caravelo

Docker infrastructure to run an small web server in order to see API in action

## How to start

    + `docker-compose build`
    + `docker-compose up`
    
There you go, run on your browser `http://$DOCKER_MACHINE_IP:8000/api/surveys` to see in action, see apiDoc for further information. Console will output with execution of PHPunit as well

If you want to run test suite:
    
    + `docker exec -it $CONTAINER_NAME sh /home/root/test.sh`
    
## Spec

    + php 7
    + symfony v3 build-in server
    
## Troubleshooting

Installing vendors with composer on with docker machine may takes too long. Is recomendable to install directly with host machine, simply use [composer](https://getcomposer.org/download/).
Navigate to `application` folder and run `$COMPOSERDIRECTORY/composer.phar install`.