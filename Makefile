all: validate update pds phpcs test

clean:
	git clean -f -d -X

validate:
	composer validate --strict

update:
	composer update

pds:
	composer run-script pds

phpcs:
	composer run-script phpcs

phpcbf:
	composer run-script phpcbf

test:
	composer run-script test
