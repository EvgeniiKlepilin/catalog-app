# Catalog App
Web Application to display a catalog of products with categories

## Getting Started
To start it out, initialize project with cloning the project, and then transferring to the project folder and executing:
```
git clone https://github.com/EvgeniiKlepilin/catalog-app.git
cd catalog-app
composer install
```
Make sure to provide all important parameters, like DB info in .env file.
Execute following commands to fill the Database with initial data:
```
php bin/console doctrine:make:migrations
php bin/console doctrine:fixtures:load
```
You can install it on any server you like. There is also an option of using PHP built-in server. You can launch it executing following commands:
```
php bin/console server:run
### or specify the ip and port
php bin/console server:start localhost:7777
```
After you got everything set up launch your browser and navigate to your launched server: http://localhost:7777/
