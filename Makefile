all: help

.PHONY: help up test build shell run install

help: Makefile
	@sed -n 's/^##//p' $<

## shell:               Interactive shell to use commands inside docker
shell:
	docker compose exec vendor-machine bash

## test:               Run all tests
test:
	docker compose exec vendor-machine composer install
	docker compose exec vendor-machine npm install
	docker compose exec vendor-machine npm test

## build:                  Run the necessary services to build
build:
	docker compose build


## install:            Run the necessary services to build
install: build up test

## up:                  Run the necessary services to run repo
up:
	docker compose up -d


## run:                  Run the run such as make run EXPR="1, 0.25, 0.25, GET-SODA"
run:
ifndef EXPR
	$(error EXPR is undefined. Example: make run EXPR="1, 0.25, 0.25, GET-SODA")
endif
	docker compose exec vendor-machine ./bin/vendor-machine "$(EXPR)"
