# RPG Game - King Of Luck
Welcome to the king of luck, this is an luck based RPG game.
Your purpose in this game as a hero is to find & beat the villains in a dice rolling competition.
You can create characters with many hero types to choose from, then you can start your adventure of finding villains to fight.


# Features Implemented
- Creating characters with preset classes
- Exploring the game, with a chosen character
- If you choose to fight a villain and win, you gain levels
- Everything is stored in the DB.


# Installation
- Extract project !
- Terminal your way to the project directory
- Composer install
- Create a new mysql database schema
- Modify the .env file and set up the DB_DATABASE, DB_USERNAME, DB_PASSWORD keys
- php artisan migrate --seed
- php artisan serve
- go to your localhost port 8000
- Type "php artisan rpg:info" to run the game using the terminal
- Enjoy !!


# Stack Used
- Laravel 5.4 / PHP 7
- Mysql DB
- AngularJs 1.5


# Technical Difficulties
Symfony 3, last version i have used was 1.4 and it's quite different from this one,
so i wanted to avoid the risk, and i started learning laravel 5.4 because it supports php 7,
Also laravel learning curve is a bit forgiving unlike Symfony 3.


# Things i wanted to do
UI Level
- Optimize the HTML to use one modal, with different param
- Show the same modal when confirming a character deletion
- Show exploring/fighting indication
- Show proper messages for each action
- Show loading before the data gets retrieved

DB Level
- Create indexes on Match Table, its not straight forward in the laravel migrate

Code Level
- Implement a better algorithms for the hero & villain ability method
- Include CSRF into the creation form
- Create Authentication/Users layer, and api token to be used in each call (Route Group Rule)
- Create limitation for the character creation, so DB won't be flooded with characters
- Use memcached instead of file caching
- Make artisan command for creating characters
- Integrate filters with the restful listing api
- Map character type into the correct name while using command line
