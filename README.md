<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Leaderboard Screen API Documentation

These APIs has been developed in Laravel 7.30.1 to serve a Leaderboard Screen. Front-end user can use these endpoints to create, delete and view players. Also there is an endpoint to increase/decrease the points of players on the screen. 

## Featues

- To list all the players on the leaderboard sort by their score from higher to lower.
- To add a new player, whose points will start from 0.
- To delete a player.
- To update (increment/decrement) points of the players.
- To show the details of a specific player.
- Unit test cases has been written for quick testing - Once application is setup, you can use following command-

```
$ php artisan test
```

## Installation

1. Clone repository
```
$ git clone https://github.com/amrikzira/leaderboard-demo.git
```
4. Change into the working directory
```
$ cd leaderboard-demo
```
5. Copy `.env.example` to `.env` and modify according to your database environment. First you need to cerate an empty MySQL database using phpmyadmin or command-line. Then you need to update the DB_DATABASE value and other db connection related settings in .env file.
```
$ cp .env.example .env
```
6. Install composer dependencies
```
$ composer install
```
7. An application key can be generated with the command
```
$ php artisan key:generate
```
8. Run these commands to create the tables within the defined database.
```
$ php artisan migrate
```

## Run

To start the server
```
$ php artisan serve 
```

Now you can start the API testing at [http://127.0.0.1:8000](http://127.0.0.1:8000)  🙌

## API Endpoints & payload details (You can use Postman or similar tool to test the APIs)

1. To get list of all players - 

Type - GET
URL - http://127.0.0.1:8000/api/getAllPlayers

Response Payload - 

```
[
    {
        "id": 1,
        "name": "Emma",
        "points": 6
    },
    {
        "id": 4,
        "name": "William",
        "points": 6
    },
    ...
]
```

2. To get a specific player details - 

Type - GET
URL - http://127.0.0.1:8000/api/getPlayer/3

Response Payload - 

```
[
    {
        "name": "James",
        "age": 20,
        "points": 4,
        "address": "third st. Vancouver BC V3L 4L8"
    }
]
```

