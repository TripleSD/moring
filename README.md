# MoRiNg (система мониторинга)
![](https://img.shields.io/badge/OpenSource-%E2%AD%90-red)
![GitHub release (latest SemVer)](https://img.shields.io/github/v/release/TripleSD/moring)
![](https://img.shields.io/github/stars/TripleSD/moring)
![](https://img.shields.io/github/forks/TripleSD/moring)
![](https://img.shields.io/github/license/TripleSD/moring)

<p align="center">
<img src="docs/img/moring_readme.png" alt="drawing" width="300"/>
</p>

MoRiNg - opensource система мониторинга. На данный момент реализованы следуюшие функции:
 - Мониторинг сайтов
    - проверка кода ответа сайта
    - проверка наличия SSL сертификата
    - проверка срока окончания действия SSL сертификата
    - проверка версии PHP интерпретатора
---
### Ветки
* Master [![](https://github.styleci.io/repos/220468288/shield?branch=master)](https://github.styleci.io/repos/220468288/shield?branch=master)
    
    Используется для получения актуальной версии системы, либо для обновления уже используемых копий.
    
    ---
    
* Dev [![](https://github.styleci.io/repos/220468288/shield?branch=dev)](https://github.styleci.io/repos/220468288/shield?branch=dev)

    Временная ветка используемая разработчиками для сохранения изменений до официального релиза новой версии.
    
    :heavy_exclamation_mark: Не рекомендуется к использованию в production системах.
***
### Системные требования

* PHP 7.3
* composer
* Fileinfo PHP Extension
***
### Установка
* клонируйте репозиторий

  ```bash
  git clone https://github.com/TripleSD/moring.git
  ```
* скопируйте `.env.example` в `.env`
* запустите генерацию приватного ключа 
    ```bash
    php artisan key:generate
    ```
* внести изменения в ```.env``` файл
    ```bash
      APP_ENV=production
      APP_DEBUG=false
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=laravel
      DB_USERNAME=root
      DB_PASSWORD=
      TIMEZONE="Europe/Moscow"
    ```
* запустите установку зависимостей
    ```bash
    composer install
    ``` 
* запустите миграции с установкой первоначальных данных
    ```bash
    php artisan migrate --seed
    ``` 
* смените права на папки
    ```bash  
      chmod 755 storage
      chmod 777 storage/framework/sessions/
      chmod 777 storage/framework/views/
      chmod 777 storage/logs/
      chmod 777 storage/framework/cache
    ```
* войдите в систему используя логин `admin@localhost` и пароль `admin`
***
### Обновление

* скачайте обновления
    ```bash
    git pull origin master
    ```
* запустите установку зависимостей
    ```bash
    composer install
    ``` 
* запустите установку обновления таблиц базы данныз
    ```bash
    php artisan migrate
    ``` 
***
### Документация
Минимальная документация по использованию системой будет подготовлена и опубликована в ближайшее время.
***
### Техническая поддержка
Если у вас возникли трудности при использовании системы, Вы можете обратиться
к команде разработчиков для получения консультации по адресу ```support@moring.ru```
 
 Если Вы обнаружили неточность в работе системы, просьба открыть новое [обсуждение(issue)](https://github.com/TripleSD/moring/issues)
***
### Помощь проекту
Вы можете внести свой вклад в разработку системы.
Если Вы нашли ошибку в коде!
 * сделайте форк
 * внесите изменения
 * пришлите пулл реквест

Составление технической документации является такой же неотъемленной 
частью проекта как и код. 
***
### Авторы
 ![https://github.com/AleksandrGoriachev](https://avatars2.githubusercontent.com/u/31987632?s=30&v=4)
 ![https://github.com/AntonMZ](https://avatars3.githubusercontent.com/u/11585687?s=30&v=4)
***
### Используемые пакеты и фреймворки
* Фреймворк Laravel 6.5.0
* Тема AdminLTE
***
### Лицензия
MoRiNg является opensource проектом. Лицезируется на основе MIT License.
### Лог изменений по версиям
***

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
