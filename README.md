# MoRiNg (monitoring system)
![](https://img.shields.io/github/issues/TripleSD/moring)
![](https://img.shields.io/github/forks/TripleSD/moring)
![](https://img.shields.io/github/stars/TripleSD/moring)
![](https://img.shields.io/github/license/TripleSD/moring)

MoRiNg - open source система мониторинга. На данный момент реализованы следуюшие функции:
 - Мониторинг сайтов
    - проверка кода ответа сайта
    - проверка наличия SSL сертификата
    - проверка срока окончания SSL сертификата
    - проверка версии PHP интерпретатора
---
### Ветки

* Master [![](https://github.styleci.io/repos/220468288/shield?branch=master)](https://github.styleci.io/repos/220468288/shield?branch=master)
    
    Используется для получения актуальной версии системы, либо для обновления уже используемых копий.
    
    ---
    
* Dev [![](https://github.styleci.io/repos/220468288/shield?branch=dev)](https://github.styleci.io/repos/220468288/shield?branch=dev)

    Временная ветка используемая разработчиками для сохранения изменений до официального релиза новой версии.
    
    :heavy_exclamation_mark: Не рекомендуется к использованию в production системах.

---

### Системные требования

* PHP 7.3
* composer
* Fileinfo PHP Extension

---
### Установка
* клонируйте репозиторий

    ```git clone https://github.com/TripleSD/moring.git```
* внести изменения в ```.env``` файл
* запустите установку зависимостей
    
    ```composer install``` 
* запустите генерацию приватного ключа 
    
    ```php artisan key:generate```
   
* запустите миграции с установкой первоначальных данных

    ```php artisan migrate --seed``` 
* войдите в систему используя логин ```admin@localhost``` и пароль ```admin```

---
### Документация

Минимальная документация по использованию системой будет подготовлена и опубликована в ближайшее время.

---
### Техническая поддержка
Если у вас возникли трудности при использовании системы, Вы можете обратиться
 к команде разработчиков за получением консультации по адресу ```support@moring.ru```

Если Вы обнаружили неточность в работе системы, просьба открыть новое [обсуждение(issue)](https://github.com/TripleSD/moring/issues)
  

---

### Помощь проекту

Вы можете внести свой вклад в разработку системы.
Вам необходимо сделать копию проекта (fork).
Внести свои изменения и п 

Составление технической документации является такой же неотъемленной 
частью проекта как и код. 

---
### Авторы

 ![https://github.com/AleksandrGoriachev](https://avatars2.githubusercontent.com/u/31987632?s=30&v=4)
 ![https://github.com/AntonMZ](https://avatars3.githubusercontent.com/u/11585687?s=30&v=4)
---

### Используемые пакеты и фреймворки

* Фреймворк Laravel 6.5.0
* Тема AdminLTE
---

### License

MoRiNg является open source проектом. Лицезируется на основе MIT License.

---
### Лог изменений по версиям

[Build.001](https://github.com/TripleSD/moring/releases/tag/build.001)  
* Авторизация пользователей
* Создание пользователей
* 
