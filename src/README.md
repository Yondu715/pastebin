# Pastebin
Позволяет заливать куски текста/кода и получать на них короткую ссылку, которую можно отправить другим людям. Загружать данные можно как анонимно, так и зарегистрировавшись.

## Стек
- [Laravel] - Backend Фреймворк
- [Voyager] - Админ-панель
- [Docker] - Контейнерная платформа
- [MySql] - СУБД

## Установка

### Docker
```sh
docker-compose up --build -d
```
### Laravel
Необходимо зайти в контейнер app
```sh
docker-compose exec app bash
```
И установить зависимости
```sh
composer install
```
Поднимаем миграции
```sh
php artisan migrate
```
Далее инициализируем voyager
```sh
php artisan voyager:install
```
И запускаем сиды
```sh
php artisan db:seed
```