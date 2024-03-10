## Build development environment (first run)
### Docker
1. Run `docker compose build`
2. Run `docker compose up --build`
3. Open `https://localhost`

### Database
1. Run `php bin/console doctrine:database:create` to create database
2. Run `php bin/console doctrine:migration:migrate` to create database tables

## Develop environment database config
- Host `127.0.0.1`
- Port `3306`
- User `root`
- Password `123456`

## Mailer
- http://localhost:8025/