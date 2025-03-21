## Развертывание

- `composer install`
- Указать данные в .env
- `php artisan migrate --seed`
- Для админ-панели используется пакет ##Laravel Orchid
- Создать администратора командой `php artisan orchid:admin` и затем следовать указаниям
- Админ-панель по адресу - `/admin`

##Уточнение
- Логика админ панели находится в `app/orchid`
- Основные страницы в `app/orchid/screens`
- `OrderEditScreen.php`, `OrderListScreen.php`, `layouts/OrderListLayout.php`
- Ссылка на документацию Laravel Orchid -><a href="https://orchid.software/ru/docs/">Click</a>
