ifeq ($(STAGE),)
STAGE = dev
endif

OPT =
.PHONY: build clean

COMPOSE = docker-compose -p project \
	-f ./build/${STAGE}/docker-compose.yml \
	--project-directory ./build/${STAGE} \
	--compatibility

RUN_IN_PHP = docker exec -i project-php-fpm
RUN_IN_PERCONA = docker exec -i project-percona
RUN_IN_NGINX = docker exec -i project-nginx

up:
	${COMPOSE} up -d --build

build:
	make composer
	php ./build/${STAGE}/setup.php
	make migrate

upload:
	${RUN_IN_PHP} php /var/www/yii upload-db

composer:
	${RUN_IN_PHP} composer update --ignore-platform-reqs

migrate:
	${RUN_IN_PHP} php /var/www/yii migrate --interactive=0

ifeq ($(OS),Windows_NT)
migrate-create:
	${RUN_IN_PHP} php /var/www/yii migrate/create ${NAME} --interactive=0
else
migrate-create:
	${RUN_IN_PHP} php /var/www/yii migrate/create ${NAME} --interactive=0
endif

migrate-down:
	${RUN_IN_PHP} php /var/www/yii migrate/down ${AMOUNT} --interactive=0

restart:
	make down
	make up

down:
	${COMPOSE} down --remove-orphans

clean:
	make down
	docker volume rm project_db-data project_db-logs project_nginx-logs