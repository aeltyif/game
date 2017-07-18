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


# Stack Used
- Laravel 5.4 [PHP 7]
- Mysql DB
- AngularJs 1.5
- PHPUnit 6.2
