# Тестовое задание на вакансию Fullstack разработчик Laravel + Vue.
## IFK Hotel Management / Москва / Ссылка на вакансию https://hh.ru/vacancy/116222631

Письменный вопрос: какая в итоге получилась структура БД (включая все вышеописанные сущности, с учётом требований на фронтенде)? Укажите названия таблиц, поля и отношения в human-understandable-формате. Какие поля nullable? Какие ограничения на длины строк?

Ответ:  Проект рабочий. Его можно попробовать покликать запустив фронт + бек + бд локально.

По ссылке схема базы данных. 
https://paste.pics/f39f6f1473ef9f2af22636f8f47748fb
В проект добавлено каскадное удаление и внешнее связываение. Можно посмотреть в миграциях и сидерах.

### Таблицы и их поля:
1. Hotels (Отели)
id
name (название отеля)
address (адрес)
description (описание)
is_active (активен ли отель)
2. Customers (Клиенты)
id
name (имя клиента)
email (электронная почта)
phone (телефон)
notes (заметки, необязательно)
3. Bookings (Бронирования)
id
hotel_id (связь с отелем)
room_number (номер комнаты)
check_in (дата заезда)
check_out (дата выезда)
status (статус)
notes (заметки, необязательно)
deleted_at (для soft delete)

4. Booking_customer (Связывающая талица бронирований с клиентами)
booking_id (ID бронирования)
customer_id (ID клиента)
is_main (является ли основным гостем)
timestamps (created_at, updated_at)

5. Events (События в отеле)
id
user_id (кто создал событие)
booking_id (к какому бронированию относится, необязательно)
event_type (тип события: check_in/check_out/room_service/cleaning/maintenance)
event_info (информация о событии)
datetime (дата и время события)


### Отношения между таблицами:
1. Bookings
Один ко многим в таблице Hotels
Многие ко многим  в таблице Customers
Один ко многим Events 

2. Customers
Многие ко многим в таблице Bookings 

3. Hotels
Один ко многим в таблице Bookings

4. Events
Много к одному в таблице User
Много к одному в таблице Booking


### Nullable поля:
1. Events
booking_id - может быть null (событие может быть не привязано к бронированию)

2. Bookings
notes - необязательные заметки к бронированию

3. Hotels
description - описание отеля может быть пустым

4. Customers
notes - необязательные заметки о клиенте


### Какие ограничения на длины строк
1. Hotels
name, 100
address, 255
description, 64k

2. Customers
name, 100
email, 100
phone, 20
notes, 64k
});

3. Bookings
room_number, 10
status, 20
notes, 64k

4. Hotel_events (связывающая таблица)
event_type, 20
event_info, 64k


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
