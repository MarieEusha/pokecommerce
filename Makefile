# Setup ————————————————————————————————————————————————————————————————————————
include ./docker/.env
SHELL         = sh
EXEC_PHP      = $(EXEC) php
SYMFONY       = $(EXEC_PHP) bin/console
COMPOSER      = $(EXEC) composer
DOCKER        = docker-compose --env-file=./docker/.env
EXEC = $(DOCKER) exec php
.DEFAULT_GOAL = help

help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

## —— Application ————————————————————————————————————————————————————————————
install: ## Installe les packages selon le fichier composer.lock
	$(COMPOSER) install --no-progress --no-suggest --prefer-dist --optimize-autoloader

update: ## Met à jour les packages selon le fichier composer.json
	$(COMPOSER) update

cc: ## Clear les caches selon l'environnement
	$(SYMFONY) c:c --env=$(PROJECT_ENV) && $(EXEC) chown -R www-data:www-data var/ public/

warmup: ## Régénération du cache
	$(SYMFONY) cache:warmup --env=$(PROJECT_ENV) && $(EXEC) chown -R www-data:www-data var/ public/

yarn: ## Install assets prod environment
	$(EXEC) yarn encore $(PROJECT_ENV)

yarn-watch: ## Installation des assets et surveillance des changements
	$(EXEC) yarn encore dev --watch

assets: purge ## Installation des assets avec un lien symbolique dans le dossier public
	$(EXEC_PHP) assets:install public/ --symlink --relative

purge: ## Suppression du cache et des logs
	$(EXEC) rm -rf var/cache/* var/logs/*

migration-migrate: ## Éxécution des fichiers de migrations
	$(SYMFONY) d:m:m


## —— Docker ————————————————————————————————————————————————————————————————
up: ## Démarre les différents containers
	$(DOCKER) -f docker-compose.yml up -d

build-up: ## Rebuild les images et démarre des container
	$(DOCKER) -f docker-compose.yml up --build -d

up-dev: ## Démarre les différents containers
	BUILD_TARGET=dev $(DOCKER) up -d

build-up-dev: ## Rebuild les images et relance les containers en environnement dev
	BUILD_TARGET=dev $(DOCKER) up --build -d

down:  ## Stop les containers
	$(DOCKER) down --remove-orphans

dpsn: ## Liste les containers de ce projet
	$(DOCKER) images
	@echo "--------------------------------------------------------------------------------------------------------------"
	docker ps -a | grep "$(PROJECT_NAME)-"
	@echo "--------------------------------------------------------------------------------------------------------------"

bash: ## Lancement du bash à l'intérieur de l'application
	$(EXEC) $(SHELL)
