SHELL := /bin/bash

.DEFAULT: help
.PHONY: help behat tests

help: ## prints this help
	@echo; echo "main commands:"
	@grep '@main' $(MAKEFILE_LIST) | egrep -h '^[a-zA-Z0-9_-]+:.*?## .*$$' | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}' | sed 's/^/  /g' | sort -k3,3 -k1,1 | sed 's/@main //g'
	@echo; echo "secondary commands:"
	@grep -v '@main' $(MAKEFILE_LIST) | egrep -h '^[a-zA-Z0-9_-]+:.*?## .*$$' | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}' | sed 's/^/  /g'
	@echo

project-start: ## @main run all containers in background
	@make project-stop
	@php -S 127.0.0.1:8080 index.php &

project-stop: ## @main stop and remove all containers running in background
	@kill -9 `pgrep -a php|grep "127.0.0.1:8080 index.php"|awk '{print $$1}'` || true

tests: project-start behat ## @main run all tests

behat: behat-domain behat-e2e project-stop ## run all types of behat tests

behat-domain: project-start ## run "domain" part of behat tests
	@./vendor/bin/behat --colors -vvv --tags=~e2e

behat-e2e: project-start ## run "e2e" part of behat tests
	@./vendor/bin/behat --colors -vvv --tags=e2e
