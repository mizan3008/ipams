# IP Address Management Solution (IPAMS)


## Technologies

The technology we are using for this app development

```
- Freamwork: Laravel 8.79.0
- Language: PHP 7.4.27
- Server: nginx 1.17 
- Database: MySQL 5.7
- Composer: 2.2.4
- React
- Inertia.js (as an adapter to communicate between the client and server)
- Testing freamwork: PHPUnit 9.5.10
```

## Installation using docker

>Make sure you have `docker` and `docker-compose` installed in your machine

Set the following local dns entries in your /etc/hosts file

``` 
127.0.0.1 www.ipams-dev.com
```

>The default password for MySQL is `password` and the username is `root`

## Database host

>`host.docker.internal` will be the host address for the database

## Run application
Set executable permission to the `start` file, which is located at the root directory of the project

Run below command to run application. This command will set up the entire application automatically.
```
./start
```
behind the scene, this command will execute the following steps--

- Set up app and test database
- Create and .env file based on the .env.example
- Install composer
- Run migration
- Run npm install
- Run npx mix and
- Generate dummy data

## To execute command manually
```
// update composer
docker exec -it ipams-app composer update

// run migration
docker exec -it ipams-app php artisan migrate

// install npm
docker exec -it ipams-app npm install

// install mix
docker exec -it ipams-app npx mix

// setup dummy data
docker exec -it ipams-app php artisan setup:dummy-data

// run test
docker exec -it ipams-app php artisan test
```

> For this app the container name `ipams-app`

## Authors
* **Mizanur Rahman** - *Backend Engineer*
