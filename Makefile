up: docker-compose.yml
	docker-compose up -d application selenium
.PHONY: up

start: up
	./scripts/selenium.sh
.PHONY: start

behat: .behat-homepage.log
.PHONY: behat

.behat-homepage.log: features/*.feature
	docker-compose up behat-homepage > .behat-homepage.log
	cat .behat-homepage.log

clean:
	rm .*.log
.PHONY: clean

purge: clean
	docker-compose stop
	docker-compose rm -f
.PHONY: purge
