# Simple Rest API Example Using Laravel & Angular.js

This is a sample app using Angular and Laravel PHP that consists of:

- An API to create, read, and remove tasks.
- A front-end to create, read and remove tasks. 

It builds off the basic Angularjs tutorial concerning creating a todo list. In addition to having a list of todo items/tasks, 
I also utilize Json Web Tokens (JWT) to authenticate users and limit the lists and API actions to the logged in user.

The goal of this app it to mimic the basic minimum requirements of an API. 

* Noted missing features:
This API is not fully restful. It does not return hypermedia at part of its response objects. Nor does it handle content negotiation. 
See [Phil Sturgeon: Build APIs you Won't Hate](https://leanpub.com/build-apis-you-wont-hate) for more information on the four levels of REST

## System Requirments
* [composer](https://getcomposer.org/)
* PHP >= 5.5.9
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* [Node.js](https://nodejs.org/en/download/)
* [npm](https://www.npmjs.com/)

## How to Use

### Laravel Related Task:
* After cloning the project run "composer install"
* Copy the .env.example file to .env. and update the following values
**   DB_HOST=your host name
**   DB_PORT=your default port
**   DB_DATABASE=your database name
**   DB_USERNAME=your username
**   DB_PASSWORD=your password
* Run "php artisan key:generate" - this will create the apps encryption key
* Run "php artisan migrate" - this will create the users and tasks tables in the db you specified in the .env
* Run "php artisan db:seed" - this will add test user and tasks. All users have the default password of "password"
* Run "php artisan serve" - this will create a test locahost at loacahost:8000
 
### Angularjs Related tasks:
* Run "npm install angular satellizer angular-ui-router bootstrap" in the public directory - this will add required js and css files to the "node_modules" directory

## Testing the App:
* Enter the following url into your preferred browser "http://localhost:8000/index.html"
* Select any of the test user emails and enter the "password" into the password input
* You will see all tasks related to that specific user
Feel free to add, delete, or mark tasks as complete 

## Notes
I used modified UUID (UUID without "-" character) rather than int values for my primary keys. 
This approach will ensure resource uniqueness across multiple DBs and increase scalability.
In the case that key length is a concern, the modified UUID can easily be converted to binary(16) and is as
performant as bigint. See [UUIDs the optimized way](https://www.percona.com/blog/2014/12/19/store-uuid-optimized-way/) for more information

In a real work usage case, the angular app and API backend would be their own projects with sperate repositories. 
Being that this is an example app, I felt it acceptable to package them together.