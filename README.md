<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about">About The Project</a>
    </li>
    <li>
      <a href="#backend">Backend</a>
      <ul>
        <li><a href="#requirements">Requirements</a></li>
        <li><a href="#installation">Installation</a></li>
        <li><a href="#endpoints">Endpoints</a></li>
      </ul>
    </li>
    <li>
        <a href="#frontend">Frontend</a>
        <ul>
            <li><a href="#requirements">Requirements</a></li>
            <li><a href="#installation">Installation</a></li>
        </ul>
    </li>
    <li>
        <a href="#unit-testing">Unit Testing</a>
    </li>
    <li>
        <a href="#contributing">Contributing</a>
    </li>
    <li>
        <a href="#license">License</a>
    </li>
  </ol>
</details>

## About:

Football Team Management API
This is an example API for managing football teams and players. It provides endpoints to create teams, add players to teams, transfer players between teams, list teams with players, list countries, and more.

## BACKEND

## Requirements:

1. PHP 8.1 or higher
2. Symfony 6.2 or higher (https://symfony.com/download)
3. Doctrine ORM
4. MySQL database

## Installation:

1. Clone the repository: git clone https://github.com/Rehmanjeff/football.git
2. Navigate to "backend" directory
3. Install dependencies: `composer install`
4. Create the database: `symfony console doctrine:database:create`
5. Configure your database connection in the .env file
6. Run database migrations: `symfony console doctrine:migrations:migrate`
7. Load fixtures: `symfony console doctrine:fixtures:load`
8. Start the development server: `symfony server:start -d`

## Endpoints:

```
Name: Creates a new team and its players
Endpoint URI: /teams
HTTP PROTOCOL: POST
Request Payload: 
    Format: JSON
    Sample: `{"name": "Team Name","money_balance": 1000,"country_id": 1,"players": [{"name": "Player 1","surname": "Surname 1"},{"name": "Player 2","surname": "Surname 2"}]}`
Response:
    Team Exist:
        Format: JSON
        HTTP Status Code: 409 (Conflict)
        Sample: `{ "message": "Team with the given name already exists" }`
    Invalid Country:
        Format: JSON
        HTTP Status Code: 400 (Bad Request)
        Sample: `{"message":"Invalid country supplied"}`
    Success:
        Format: JSON
        HTTP Status Code: 201 (Created)
        Sample: `{"message":"Team created successfully"}`

Name: Lists all teams and their players
Endpoint URI: /teams
HTTP PROTOCOL: GET
Request Payload: 
    Format: JSON
    Sample: ?page=1
Response:
    Success:
        Format: JSON
        HTTP Status Code: 200 (OK)
        Sample: `[{"id": 3,"name": "Team Name","money_balance": 1000,"country": {"name": "Angola","flag_file": "https://www.scorebar.com/images/flags/ao.webp?w=28&h=21"},"players": [{"id": 29,"name": "Player 1","surname": "Surname 1"},{"id": 30,"name": "Player 2","surname": "Surname 2"}]}]`

Name: Sell/Buy given player with given amount
Endpoint URI: /teams/transfer-player
HTTP PROTOCOL: POST
Request Payload: 
    Format: JSON
    Sample: `{"from_team":2,"to_team":1,"player":1,"amount": 1000}`
Response:
    Invalid Team/Player:
        Format: JSON
        HTTP Status Code: 400 (Bad Request)
        Sample: `{ "message": "Invalid team or player supplie" }`
    Insufficient Funds:
        Format: JSON
        HTTP Status Code: 400 (Bad Request)
        Sample: `{"message":"Insufficient funds"}`
    Success:
        Format: JSON
        HTTP Status Code: 200 (OK)
        Sample: `{"message": "Player transfer successful"}`
```

## FRONTEND

## Requirements:

1. NodeJS 19.7.0 or higher
2. VueJS 3

## Installation:
1. Clone the repository: `git clone https://github.com/Rehmanjeff/football.git`
2. Navigate to "frontend" directory
3. Install dependencies: `npm install`
4. Start the development server: `npm run dev`

## UNIT TESTING

1. Create a test database
2. Create or modify .env.test file and configure it for your test database
3. Run "php bin/phpunit" in terminal to initiate the tests

## CONTRIBUTING:

Contributions to this project are limited to team members and authorized collaborators. If you're a team member, please follow the guidelines above

## LICENSE:

This project is proprietary and confidential. Unauthorized use, reproduction, or distribution of any part of this repository is strictly prohibited.