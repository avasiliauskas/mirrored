migrate:
	php bin/console make:migration
	php bin/console doctrine:migrations:migrate
migrate-test:
	php bin/console doctrine:migrations:migrate --env=test
seed:
	php bin/console doctrine:fixtures:load
routes:
	php bin/console debug:router
test:
	./bin/phpunit
