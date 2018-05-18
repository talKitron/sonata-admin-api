Inside the project folder please find diagrams:
- Use case UML
- Database design model

The application was developed using Docker, but should work with any web server.
The database used was an external MYSQL one, for that purpose exactly.

If run using docker, don't forget to use these commands inside the project's folder
`docker-compose build` - in order to build the images for the containers.
`docker-compose up` - in order to turn the container on.

Docker Services:
- php - php-fpm process (as well as basic image for test execution)
- nginx - www server

Application has been developed with symfony 4 framework - modern, well designed and modular framework.
Additionally I used a few common modules (Bundles) to speed up development and avoid code duplication (DRY principle)
- FOSRestBundle for easy REST service implementation
- JMSSerializerBundle for better serialisation and deserialisation support
- NelmioAPIDocBundle - for automatic documentation generation using OpenAPI specification
- SonataAdminBundle - for easy user and group management

For testing I used PHPUnit bridge to design simple functional tests.
Running tests:
`docker-compose run php ./vendor/bin/simple-phpunit`