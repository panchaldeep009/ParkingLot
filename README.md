# ParkingLot
This is A Car Parking Ticketing Application.
This app creates a ticket for a limited number of cars and count fees based on hours of parking.

## Setup
Following instructions will give a copy of this Parking Lot Application up and running in any local machine for testing purposes.

### Prerequisites

This app's back-end build with Laravel framework and font-end bundled with Node.
Following apps should installed in machine in order to config this app.
- [Docker](https://docker.com/).

### Installing
- Clone this App from the master branch,
- Config environment to run app in local machine by running following commands.
  ```sh
  // move to app dir
  cd <app cloned dir>
  // Copy environment file 
  cp .env.example .env
  // 
  ```
- Build and Run virtual environments for app
  ```sh
  docker-compose up -d
  ```
  _Note: in case of mysql container build faild, run : `docker-compose restart`_
- Setup Application key and Database migration
  ```sh
  // set app key
  docker-compose exec app php artisan key:generate
  // config catch 
  docker-compose exec app php artisan config:cache
  // migrate database
  docker-compose exec app php artisan config:cache
  ```
- Now you can run the app on [http://localhost:3000/](http://localhost:3000/) as per configured in `docker-compose.yml` file.
## Tests

  - To Run API Test:
  ```
  bash configApp --test-api
  ```

  - To Run Functions Test:
  ```
  bash configApp --test-fn
  ```

## API calls
* **POST** `/api/tickets` : It will return a ticket number
* **GET** `/api/tickets/{ticket#}` : With that ticket number, This Request will give back total time parked and counted amount that customer owes
* **POST** `/api/payments/{ticket#}` : With the ticket number and requested parameter `credit_card` number will pay for that ticket

## Built With

* [Laravel](https://laravel.com/) - PHP Framework;
* [Vue](https://vuejs.org/) - JavaScript Framework;
* [Vuetify](https://vuetifyjs.com/en/) - Style Library;

## Authors

* [Deep Panchal](http://deeppanchal.com/) - Developer;
