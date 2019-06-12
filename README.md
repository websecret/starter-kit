# Установка backend

### Common
`composer install`

`cp .env.example .env`

`nano .env` - настроить подключение к базе данных

`php artisan key:generate`

### Local

`php artisan migrate:fresh -seed` - миграции и сиды

`php artisan db:seed --class=DatabaseFakeSeeder` - фейковые данные

### Production

`php artisan migrate` - миграции

`php artisan db:seed` - сиды реальных данных

# Установка frontend

### Local

`yarn && yarn dev` - сборка проекта

### Production

`yarn && yarn prod` - сборка проекта

# URL's

`/admin/logs` - Логи

# Доступы

`/admin` - url

login: *info@gmail.com*

password: *******

# Команды

* `php artisan `