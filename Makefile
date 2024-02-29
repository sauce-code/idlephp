all: validate update test

clean:
	git clean -f -d -X

validate:
	composer validate --strict

update:
	composer update

test:
	composer run-script test
