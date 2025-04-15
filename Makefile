#---VARIABLES---------------------------------#
sy := symfony
bc := php bin/console
cp := composer
bn := bun
#---------------------------------------------#

## === 🆘  HELP ==================================================
help: ## Show this help.
	@echo "Symfony-And-Docker-Makefile"
	@echo "---------------------------"
	@echo "Usage: make [target]"
	@echo ""
	@echo "Targets:"
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
#---------------------------------------------#

## === ✨ Server ==================================================
init: vendor/autoload.php ## Init the project.
	$(MAKE) install
	$(MAKE) update
	$(MAKE) seed
	$(MAKE) serv
	$(MAKE) compile
.PHONY: init

serv: vendor/autoload.php
	$(MAKE) update
	$(sy) server:start
.PONHY: serv

install:
	$(cp) install
.PHONY: install

update:
	$(cp) update
.PHONY: update
#---------------------------------------------#

## === #️⃣  Database ==================================================
migration: vendor/autoload.php ## Create migration file.
	$(bc) make:migration
.PHONY: migration

migrate: vendor/autoload.php ## Do latest migration. (doctrine:migration:migrate)
	$(bc) d:m:m --no-interaction
.PHONY: migrate
#---------------------------------------------#

## === ✨ Prod ==================================================
compile: ## Compile for prod
	rm -rf ./public/assets
	php bin/console tailwind:build --minify
	php bin/console asset-map:compile
.PHONY: compile
#---------------------------------------------#

## === 💻 Dev ==================================================
seed: ## Clear database and load fixtures.
	@echo "\033[32mLoad fixtures\033[0m"
	$(MAKE) migrate
	$(bc) hautelook:fixtures:load --env=dev -vvv --no-interaction
	@echo "\033[32mFixtures loaded.\033[0m"
.PHONY: seed

watch:
	$(bn) watch
.PHONY: watch

clean: ## Clear the cache.
	$(bc) cache:clear
.PHONY: clean

console: vendor/autoload.php ## make symfony shortcut. (args: cmd)
	$(bc) $(cmd)
.PHONY: console

consume: vendor/autoload.php
	$(bc) messenger:consume -vv
.PHONY: consume

secrets: vendor/autoload.php
	$(bc) secrets:list --reveal
.PHONY: secrets

routes: vendor/autoload.php
	$(bc) debug:router
.PHONY: routes
#---------------------------------------------#

#---RULES---------------------------------#
vendor/autoload.php: composer.lock
	$(cp) install
	touch vendor/autoload.php
