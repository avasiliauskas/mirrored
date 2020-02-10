migrate:
	php bin/console make:migration
	php bin/console doctrine:migrations:migrate
seed:
	php bin/console doctrine:fixtures:load
routes:
	php bin/console debug:router
test:
	./bin/phpunit
