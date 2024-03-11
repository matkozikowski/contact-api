# Install
- run `docker-compose up --build -d`
- run migrations: `docker exec h2h-tech_php-fpm php bin/console d:m:m`

# Rest API:
http://localhost:8000

# Open API available
http://localhost:8000/api/doc

# PGAdmin
http://localhost:16543
login: teste@teste.com
pass: teste

# Run tests
- phpunit `docker exec h2h-tech_php-fpm php vendor/bin/codecept run Unit`
- rest `docker exec h2h-tech_php-fpm php vendor/bin/codecept run Api`
