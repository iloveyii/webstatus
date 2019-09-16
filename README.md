Webstatus
=======
Wbstatus is a small web app developed in PHP, JS, Vue to find out if the given list of websites are live.

Demo is available [here](http://pct.softhem.se/).

![Wbstatus screen shot](http://pct.softhem.se/screen-shot.png)

## How it works
   * We have developed a backend MVC application in PHP which serves the API requests.  
   * We have used MySQL database which saves the list of web sites. 
   * When the user loads the application using web browser, it first fetch a list of websites and then makes ajax requests to backend to fetch web status.
   
## Development tools
   * We used PhpStorm IDE, Git, Composer, PHP 5.6, Docker, Ubuntu and Apache2 for development environment.
   * On programming side we used Javascript, jQuery, BS 3, Vue, Php, Mysql.
     
## Setup and first run

  * Clone the repository `https://github.com/iloveyii/webstatus`.
  * Run composer the root directory `composer dump-autoload`.
  * You need to create a database and make changes in config/app.php accordingly. You  can import the required sql from sql/bad.sql.
  
DEMO is here [DEMO](http://pct.softhem.se/).

## Task Description
    
   * You should modernize this application to comply with today's standards.
   * You should try to solve potential bugs and vulnerabilities.
   * You should structure the code so that it looks clean and is easy to maintain.
   * When I (the reviewer) review your results later, I should still be able to run this using "docker-compose up -d", and access it using http://0.0.0.0:8888.
   * The logic part of this application should be written in PHP.
   * You are not allowed to introduce any new libraries/dependencies/frameworks, with the exception of common PHP extensions that can be installed using php-* (php-json, php-mysql, php-xml ... etc. Basically we want you to write pure PHP and not rely on third-party libraries or frameworks). You are allowed to make use of external build tools, package managers and all of the sorts, however.
   * The main functionality of the application must still be the same after you are done. That is, it needs to fetch URLs from the MySQL database, then check the status of every page and return a result. After this it should display a unique UUID for the current session.
   * Your result must be PSR-1 and PSR-2 compliant.
   * You are not limited to only changing the code. If you want to change the docker configuration, web server and so on, you are free to do so. As long as the above requirements are still met when you are done, go nuts.

## Overall Structure

Bellow the directory structure used:

```

   |-config
   |-lib
   |-models
   |-views
   |-web
   |-app.js
   |-composer.json
   |-Dockerfile
   |-index.php
   |-README.md
   
```
 
 [Hazrat Ali](http://blog.softhem.se/) 
