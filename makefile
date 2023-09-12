run:
	test $$(docker images -q fop) || docker build -t fop .
	docker run -v $$(pwd)/src:/var/www/src fop php src/index.php
