migrate:
	php bin/console make:migration
	php bin/console doctrine:migrations:migrate
seed:
	php bin/console doctrine:fixtures:load
