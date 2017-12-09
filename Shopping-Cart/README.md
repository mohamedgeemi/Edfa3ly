# Simple Shopping Cart 

## Stack:

- PHP 7.0.8
- Symfony Framework 3.4
- Doctrine ORM
- MySQL
 
## How to use:

- Clone the project
- Install composer
- Install the following bundles
```
composer req orm
composer require doctrine/doctrine-bundle
composer req twig-bundle
composer req profiler
composer require symfony/maker-bundle
composer require symfony/web-server-bundle
composer require sensio/framework-extra-bundle
composer require symfony/expression-language
```
- Install MySQL
- Create DB with name shopping_cart or whatever you want and edit the DATABASE_URL in .env file
- Migrate tables with doctrine
```
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate
```
- Insert some sample data for products
```
INSERT INTO product (id, name, description, quantity, price) VALUES (1, "Kitchen Machine", "bet Kitchen Machine", 10, 15);
```

