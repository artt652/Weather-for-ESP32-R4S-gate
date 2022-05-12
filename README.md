# Weather-for-ESP32-R4S-gate

Вывод прогноза погоды для устройств с экраном для проекта ESP32 Ready4Sky (R4S) Gateway for Redmond+ devices (@alutov)

  Описание скрипта: 

Данный скрипт позволяет на устройстве с экраном (например, М5 STACK) выводить прогноз погоды, используя веб сервис погодных информеров. 

Использование скрипта позволяет обойти следующие ограничения:

  1. Большинство современных погодных информеров это не картинки, а html код. 
Сервисы которые все же отдают картинки - например, meteoservice.ru, rp5.ru, и wttr.in - делают это в PNG а не JPG.

  2. Шлюз в текущей версии 2022.05.06 не поддерживает загрузки по https, а так же отображение PNG.

Выполнение скрипта реализуется на базе PHP сервера в локальной сети с доступом к интернету, доступ к исполняемому файлу из инернета не обязателен.

Скрипт грузит с сервиса по https информер-картинку с прогнозом, изменяет разрешение под экран шлюза, конвертирует в jpg и сохраняет картинку в свою папку, откуда шлюз уже может забрать её по http.
Обновление данных происходит через запрос страницы в локальной сети либо через интернет, вручную или по таймеру (например, через автоматизацию в HA). 
Для отправки автоматического запроса используется интеграция Webhook Service Provider for Home Assistant (@HCookie).

В настройках шлюза указвается адрес генерируемой картинки в папке со скриптом и выставляется желаемое время обновления в секундах.  

http://your.ip.or.hostname/your.path/weather.jpg



Ссылки на конкретный город и тип информера, а так же их описание можно найти на сайтах сервисов.
Данный скрипт написан для работы через сервис wttr.in, для начала работы необходимо отредактировать только ссылку для загрузки прогноза погоды в нужной локации.

Пример выводимого изображения:

![PROJECT_PHOTO](https://github.com/artt652/Weather-for-ESP32-R4S-gate/raw/main/weather.jpg)

Ссылка на обсуждение в телеграм:
https://t.me/ESP32_R4sGate
