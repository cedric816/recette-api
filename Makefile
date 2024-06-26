check:
	composer check
	
update:
	composer install

migration:
	php bin/console make:migration

migrate:
	php bin/console doctrine:migrations:migrate -n

admin.crud:
	php bin/console make:admin:crud