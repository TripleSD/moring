[v.0.1.10 (Build.032)](https://github.com/TripleSD/moring/releases/tag/0.1.10)
- **(New)** - Enabled site's check from moring file.
- **(New)** - Added Backup FTP section.
- **(New)** - Added Backup Yandex Disk section (connectors/tasks/buckets)
- **(New)** - Added alerts on a header.
- **(Fix)** - Bug fixes and other improvements.

[v.0.1.9 (Build.029)](https://github.com/TripleSD/moring/releases/tag/0.1.9)
- **(Upd)** - Refactoring sites repository.
- **(Upd)** - Refactoring old migrations.
- **(Upd)** - Refactoring templates.
- **(Upd)** - Upgraded ping commands.
- **(Upd)** - Refactoring SitesChecker. Added options (web/cli/debug). Removed pcntl_fork & added curl for sites check.
- **(Fix)** - Refactoring SitesChecker. Added check only enabled sites.
- **(Fix)** - Refactoring SitesSslChecker. Added check only enabled sites.

[v.0.1.8 (Build.028)](https://github.com/TripleSD/moring/releases/tag/0.1.8)
- **(New)** - Added threshold pings values of sites.
- **(New)** - Added showing site's ip address.
- **(Upd)** - Updated some templates.
- **(Upd)** - Updated values of .env file.

[v.0.1.7 (Build.027)](https://github.com/TripleSD/moring/releases/tag/0.1.7)
- **(New)** - Added showing errors list for SNMP device.
- **(New)** - Added showing errors counts for SNMP devices list.
- **(New)** - Added Telegram notifications for SNMP device (up/down).
- **(New)** - Added new Grafana integration (export sites list with SSL certificate expiration date).
- **(Fix)** - Fixed showing snmp port in devices list.

[v.0.1.6 (Build.026)](https://github.com/TripleSD/moring/releases/tag/0.1.6)
- **(New)** - Added enable/disable SNMP device status.
- **(New)** - Added showing ENV (local/staging/dev/production).
- **(New)** - Added Grafana integration (sites list with ping for export).
- **(Fix)** - Fixed SNMP console command.
- **(Fix)** - Fixed default value enable/disable status SNMP devices.

[v.0.1.5 (Build.025)](https://github.com/TripleSD/moring/releases/tag/0.1.5)
 - **(New)** - Добавлен вывод серийного номера SNMP устройства в карточке устройства
 - **(New)** - Добавлены быстрые web/ssh/telnet ссылки в карточке SNMP устройства
 - **(New)** - Добавлены тесты для Device классов
 - **(Upd)** - Выполнен рефакториг Device классов
 - **(Upd)** - Обновлены SNMP/Device тесты с учетом удаления неиспользуемого кода

[v.0.1.4 (Build.023)](https://github.com/TripleSD/moring/releases/tag/0.1.4)
 - **(New)** - Добавлены новые автотесты для SNMP классов
 - **(New)** - Добавлена проверка на повторное добавление SNMP устройства
 - **(Upd)** - Дополнены текущие автотесты для SNMP классов 
 - **(Upd)** - Выполнен рефакторинг SNMP классов
 - **(Upd)** - Выполнен рефакторинг Device классов
 - **(Fix)** - Исправлена передача порта SNMP устройства из формы в обработчик
 
[v.0.1.3 (Build.020)](https://github.com/TripleSD/moring/releases/tag/0.1.3)
 - **(Add)** - Добавлен пакет [delimitry/snmp-server](https://github.com/delimitry/snmp-server) для эмуляции snmp устройств
 - **(Upd)** - Осуществлен рефакторинг SNMP классов для ускоения запроса и получения SNMP информации
 - **(Upd)** - Осуществлен рефакторинг SNMP тестов под измененные SNMP классы
 - **(Del)** - Удален старый код

[v.0.1.2 (Build.016)](https://github.com/TripleSD/moring/releases/tag/0.1.2)
 - **(New)** - Добавлены новые автотесты для SNMP классов
 - **(New)** - Добалена поддержка PHP 7.2 / 7.4 версий
 - **(Upd)** - Осуществлен рефакторинг действующих SNMP классов
 
[v.0.1.1 (Build.014)](https://github.com/TripleSD/moring/releases/tag/0.1.1)
 - **(New)** - Добавлены автотесты
 - **(New)** - Добавлен пакет [hirak/prestissimo](https://github.com/hirak/prestissimo) для параллельной установки composer пакетов в Unit тестах.
 - **(Fix)** - Исправлены уязвимости JS пакетов

[v.0.1.0 (Build.013)](https://github.com/TripleSD/moring/releases/tag/0.1.0)
- **(New)** - Добавлены Telegram уведомления о проверке работоспособности системы
- **(New)** - Добавлено именование версий в human style (v.0.1.0)
- **(Upd)** - Добавлена поддержка перемещения виджетов на главной странице 
- **(Upd)** - Опрос устройств по SNMP исправлен на более короткий интервал (1мин)
- **(Upd)** - По-умолчанию в env файле отключен вывод debug информации
- **(Upd)** - В списке сетевых устройств добавлен вывод статуса устройства
- **(Fix)** - Исправлена главная страница для нормального отображения на маленьких экранах
- **(Fix)** - Исправлен вывод ошибок о deprecated версия PHP интерпретаторов
- **(Fix)** - Исправлен сбор данных для фильтра deprecated версий PHP интерпретатора
- **(Fix)** - Исправлен сбор данных о сайтах для главной страницы
- **(Fix)** - Исправлена логика выбора версий в SitesChecker'е при добавлении в очередь
 сайтов не отдающих заголовок веб сервера и PHP интерпретатора
- **(Del)** - Удалены лишние фильтры на странице сайтов

[Build.012](https://github.com/TripleSD/moring/releases/tag/build.012)
- **(New)** - Добавлен загрузка данных о deprecated версиях PHP интерпретаторов
- **(New)** - Добавлен фильтр сайтов с deprecated версиями PHP интерпретаторов
- **(New)** - Добавлен раздел сетевых устройств с опросом по SNMP
- **(Upd)** - Обновлен вывод flash уведомлений
- **(Fix)** - Исправлен вывод дат у графиков пингов в карточке сайта
- **(Fix)** - Исправлены заголовки графиков на центральном дашборде
- **(Fix)** - Исправлена регистрация консольных команд для cron
- **(Upd)** - Кодовая база приведена к общему стилю

[Build.011](https://github.com/TripleSD/moring/releases/tag/build.011)
- **(New)** - Добавлена выгрузка информации о deprecated версиях PHP интерпретаторов
- **(New)** - Добавен вывод информации о deprecated версиях PHP интерпретаторов в списке сайтов
- **(Fix)** - Исправлен вывод информации о SSL сертификате в списке сайтов
- **(Upd)** - Добавлен вывод количества записей в базе скачиваемых с бриджа
- **(Upd)** - Кодовая база приведена к общему стилю 

[Build.010](https://github.com/TripleSD/moring/releases/tag/build.010)
- **(Upd)** Обновлен порядок сбора данных для быстрых фильтров в разделе сайтов
- **(New)** Включены быстрые кнопки фильтров в разделе сайтов
- **(Fix)** Исправлен редирект со страницы авторизации
- **(Fix)** Переписан сбор данных для главной страницы

[Build.009](https://github.com/TripleSD/moring/releases/tag/build.009)
- **(New)** Добавлен график количества используемых веб серверов на главной странице
- **(New)** Добавлен раздел документации
- **(New)** Добавлен блок документации со списком изменений по версиям
- **(Fix)** Исправлен сбор и вывод `ping` данных на главной странице для исключения ошибки вывода нового сайта/сервера
- **(Fix)** Исправлены тексты в некоторых шаблонах

[Build.008](https://github.com/TripleSD/moring/releases/tag/build.008)
- **(New)** Добавлен раздел настроек с данными о последних синхронизациях с бриджем 
- **(New)** Добавлена возможность ручного запроса данных с бриджа

[Build.007](https://github.com/TripleSD/moring/releases/tag/build.007)
- **(Fix)** Исправлена ошибка выборки необходимых данных по регулярному выражению в Linux системах
- **(New)** Добавлена кнопка обновления данных для каждого сайта

[Build.006](https://github.com/TripleSD/moring/releases/tag/build.006)
- **(Fix)** Исправлена ошибка выбора строки запуска в ping сервисе
- **(New)** Создан раздел документации для дальнейшего наполнения

[Build.005](https://github.com/TripleSD/moring/releases/tag/build.005)
- **(Fix)** Исправлена ошибка в сервисе получения информации с бриджа о новых версиях PHP
- **(Upd)** Добавлена информации о редактировании env файле при первичной установке системы 

[Build.004](https://github.com/TripleSD/moring/releases/tag/build.004)
- **(New)** Добавлена `ping` проверка всех сайтов с выводом графика показаний
- **(New)** Добавлена интеграция с `Telegram`
- **(Fix)** Добавлены значения по умолчанию в настройках панели
- **(Fix)** Исправлен подсчет значений счетчиков быстрых кнопок на странице сайтов
- **(Fix)** Исправлена передача переменных в конструкторах классов   
- **(Fix)** Исправлена передача переменных в SiteCheker
- **(Fix)** Рефакторинг кода (перенос в другие контроллеры/репозиории | удаление старого кода)

[Build.003](https://github.com/TripleSD/moring/releases/tag/build.003)
- **(Fix)** Исправлены столбцы назначения в скрипте получения сведений о новых версиях PHP
- **(Fix)** Исправлен порядок назначения default значений в скрипте проверки сайтов

[Build.002](https://github.com/TripleSD/moring/releases/tag/build.002)
- **(Fix)** Исправлены ошибки в таблице хранения новых версий
- **(Upd)** Добавлено минимальное описание проекта в README.md

[Build.001](https://github.com/TripleSD/moring/releases/tag/build.001)  
- **(New)** - Начало разработки основной системы на базе фреймворка Laravel 6.5.0
- **(New)** - Добавлена основная тема оформления системы
- **(New)** - Осуществлена настройка авторизации пользователей в системе без разделения прав
- **(New)** - Добавлено автоматическое получение сведений о бридже
- **(New)** - Добавлено автоматическое получение сведений о версиях системы
- **(New)** - Добавлено автоматическое получение сведений о новых версиях PHP интерпретатора
- **(New)** - Добавлен раздел мониторинга http/https сайтов
- **(New)** - Доработка темы оформления
- **(New)** - Добавлена проверка http кодов
- **(New)** - Добавлено получение версии web сервера
- **(New)** - Добавлена проверка версии php интерпретатора
- **(New)** - Добавлена проверка ssl сертификата
- **(New)** - Добавлена проверка сайта через moring файл
- **(New)** - Добавлена автоматическая проверка нового сайта при добавлении
- **(New)** - Добавлен быстрый опрос состояния всех сайтов
- **(New)** - Доработка карточки сайта (просмотр, редактирование, удаление)
