# Build development environment (first run)
### Docker
1. Run `docker compose build`
2. Run `docker compose up --build`
3. Open `https://localhost`

### Database
1. Run `php bin/console doctrine:database:create` to create database
2. Run `php bin/console doctrine:migration:migrate` to create database tables