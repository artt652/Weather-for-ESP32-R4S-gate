Upd.: PNG support temporary disabled

# Weather-for-ESP32-R4S-gate

Вывод прогноза погоды для устройств с экраном для проекта [ESP32 Ready4Sky (R4S) Gateway for Redmond+ devices](https://github.com/alutov/ESP32-R4sGate-for-Redmond) (@alutov).

  Описание скрипта: 

Данный скрипт позволяет на устройстве с экраном (например, [М5Stack](https://m5stack.com)) выводить прогноз погоды, используя веб-сервисы погодных информеров. 

Использование скрипта позволяет обойти следующие ограничения:

  1. Большинство современных погодных информеров это не картинки, а html код. 
Сервисы которые все же отдают картинки - например, [meteoservice.ru](https://www.meteoservice.ru/), [rp5.ru](https://rp5.ru/), [wttr.in](https://wttr.in/) - делают это в PNG а не JPG.

  2. Шлюз в текущей версии **2022.07.12.** не поддерживает отображение PNG.

Выполнение скрипта реализуется на базе PHP сервера в локальной сети с доступом к интернету, доступ к исполняемому файлу из инернета не обязателен.

Скрипт загружает с сервиса погоды по https PNG информер-картинку с прогнозом, изменяет разрешение под экран шлюза, конвертирует PNG в JPG и сохраняет эту картинку в свою папку, откуда шлюз уже может забрать её по http. Также, для удобства добвален штамп даты и времени генерации ринунка, файл шрифта для отрисовки должен находится в папке fonts.

Обновление данных происходит через запрос страницы в локальной сети либо через интернет, вручную или по таймеру (например, через автоматизацию в HA). 
Для отправки автоматического запроса может использоваться интеграция [Webhook Service Provider for Home Assistant](https://github.com/HCookie/Webhook-Service-home-assistant) (@HCookie).

Пример автоматизации с интервалом обновления 10 минут:
```yaml
alias: Обновление погоды
description: ''
trigger:
  - platform: time_pattern
    minutes: '00'
  - platform: time_pattern
    minutes: '10'
  - platform: time_pattern
    minutes: '20'
  - platform: time_pattern
    minutes: '30'
  - platform: time_pattern
    minutes: '40'
  - platform: time_pattern
    minutes: '50'
condition: []
action:
  - service: webhook_service.basic_webhook
    data:
      http://your.ip.or.hostname/your.path/weather.php
mode: single
```

В настройках шлюза указвается адрес генерируемой картинки в папке со скриптом и выставляется желаемое время обновления в секундах.  

Ссылка на изображение будет иметь вид:
http://your.ip.or.hostname/your.path/weather.jpg

Ссылки на конкретный город и тип информера, а так же их описание можно найти на сайтах соответствующих сервисов.
Данный скрипт адаптирован для работы через сервис wttr.in, для начала использования необходимо отредактировать ссылку для загрузки прогноза погоды в нужной локации.

Пример выводимого изображения:

![PROJECT_PHOTO](https://github.com/artt652/Weather-for-ESP32-R4S-gate/raw/main/weather.jpg)

Также можно настроить:

[Автоматическое изменение яркости экрана](https://github.com/artt652/Circadian-Lighting-for-ESP32-R4S-gate)

[Обсуждение в телеграм](https://t.me/ESP32_R4sGate)

