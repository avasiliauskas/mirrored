migrate:
	php bin/console make:migration
	php bin/console doctrine:migrations:migrate
seed:
	php bin/console doctrine:fixtures:load
debug-routes:
	php bin/console debug:router