# Pastebin
Позволяет заливать куски текста/кода и получать на них короткую ссылку, которую можно отправить другим людям. Загружать данные можно как анонимно, так и зарегистрировавшись.
![изображение](https://github.com/Yondu715/pastebin/assets/116293533/cd7246da-2bee-473b-bc65-b49a88103078)
![изображение](https://github.com/Yondu715/pastebin/assets/116293533/43ea732b-41a0-483c-8aa7-2775f13d0c87)
![изображение](https://github.com/Yondu715/pastebin/assets/116293533/826c7abb-9368-4e5e-8cc2-09990f95db4f)

## Стек
- PHP (v8.2) - Язык программирования
- Laravel (v10.43.0) - Backend фреймворк
- Voyager (v1.7) - Админ-панель
- Passport (v11.10) - Пакет для авторизации
- Socialite (v5.12) - Пакет для авторизации через сторонние сервисы
- l5-repository (v2.9) - Пакет для репозиториев
- Docker Engine (v25.0.3) - Контейнерная платформа
- MySql (v8.3) - СУБД

## Алиасы
В корне проекта есть файл Makefile, в котором содержатся алиасы для часто используемых команд
![изображение](https://github.com/Yondu715/pastebin/assets/116293533/9f506c3e-96c5-433b-9030-3993d1460469)

Для их вызова необходимо выполнить
```sh
make {название_команды}
```

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

Далее создаем файл .env и описываем окружение по примеру .env.example
Главное указать следующие параметры (либо можно их поменять в docker-compose.yml)
```sh
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=database
DB_USERNAME=root
DB_PASSWORD=123
```

Для того, чтобы работала авторизация через гугл, необходимо указать следующие параметры в .env
```sh
GOOGLE_CLIENT_ID="ВАШ CLIENT_ID"
GOOGLE_CLIENT_SECRET="ВАШ SECRET"
GOOGLE_REDIRECT_URI="http://127.0.0.1:80/auth/login/google/callback"
```

Поднимаем миграции
```sh
php artisan migrate
```

Инициализируем Passport
```sh
php artisan passport:install
```

Далее инициализируем voyager
```sh
php artisan voyager:install
```

И запускаем сиды
```sh
php artisan db:seed
```
