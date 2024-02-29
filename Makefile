all: clean validate install test

clean:
	git -rm -f -X

validate: composer.json
	composer validate --strict

install:
	composer install --prefer-dist --no-progress

test:
	composer run-script test
