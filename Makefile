up: docker-compose.yml
	docker-compose up -d --build phpfpm selenium nginx apache24
.PHONY: up

start: up
	./scripts/selenium.sh
.PHONY: start

behat: .behat-homepage-nginx.log .behat-homepage-apache24.log
.PHONY: behat

.behat-homepage-nginx.log: features/*.feature
	docker-compose up behat-homepage-nginx > .behat-homepage-nginx.log
	cat .behat-homepage-nginx.log

.behat-homepage-apache24.log: features/*.feature
	docker-compose up behat-homepage-apache24 > .behat-homepage-apache24.log
	cat .behat-homepage-apache24.log

clean:
	rm .*.log
.PHONY: clean

purge: clean
	docker-compose stop
	docker-compose rm -f --all
.PHONY: purge
