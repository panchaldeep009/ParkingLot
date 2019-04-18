# ParkingLot
This is A Car Parking Ticketing Application.
This app creates a ticket for a limited number of cars and count fees based on hours of parking.

## Setup
Following instructions will give a copy of this Parking Lot Application up and running in any local machine for testing purposes.

### Prerequisites

This app's back-end build with Laravel framework and font-end bundled with Node.
Following apps should installed in machine in order to config this app.
- [Bash](https://www.gnu.org/software/bash/).
- [PHP](https://www.php.net/downloads.php).
- [Composer CLI](https://getcomposer.org/download/).
- [Node Package Manager CLI](https://nodejs.org/en/download/)

### Installing
- Clone this App from the master branch,
- Open Terminal/Bash and run following comands:
  - To Config App:
  ```
  cd <app cloned dir>
  bash configApp --app
  ```
  - Config MySQL Connection
  ```
  bash configApp --sql
  ```
## Run
  - To Run back-end server for App:
  ```
  cd <app cloned dir>
  bash configApp --run
  ```
  - To Run front-end development watch:
  ```
  bash configApp --watch
  ```
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
