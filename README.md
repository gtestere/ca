Notes:

Included, the .env settings used for convenience.

1.- Set the database settings in the .env
2.- Create a DB (default name ca-alliance)
3.- Run composer install
4.- Run php bin/console doctrine:migrations:migrate
5.- Run php bin/console doctrine:fixtures:load
6.- Run yarn
7.- Run yarn build
8.- Serve the app from the public folder