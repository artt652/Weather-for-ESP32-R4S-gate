<?php

// Вывод прогноза погоды для устройств с экраном для проекта ESP32 Ready4Sky (R4S) Gateway for Redmond+ devices (@alutov)

// загружаем картинку с прогнозом погоды; ниже еще 2 строки с ссылками на сервисы для примера:
$image = imagecreatefrompng('https://ru.wttr.in/Домодедово аэропорт_0qpn.png');
// $image = imagecreatefrompng('https://inf.meteoservice.ru/red/108.png');
// $image = imagecreatefrompng('https://rp5.ru/informer/120x60x2.php?f=10&id=5639');

// сохраняем временный файл для редактирования в папке со скриптом:
imagepng($image, 'weather_temp.png');
$filename = 'weather_temp.png';

// назначение нового размера рисунка, 320x172 - при использовании одной строки информации на шлюзе, 
// при использовании двух строк достаточно разрешения картинки 320x144.
list($width, $height) = getimagesize($filename);
$newwidth = 320;
$newheight = 172;

// задаем коэфициент для изменения размера изображения для вставки с сохранением пропорций оригинального изображения:
$rate = '1.32';
$pastewidth = $width * $rate;
$pasteheight = $height * $rate;

// загрузка переменных для конвертации:
$thumb = imagecreatetruecolor($newwidth, $newheight);
$source = imagecreatefrompng($filename);

// загрузка переменных для вставки даты:
$date = date('H:i:s, d.m.Y');
$font = "fonts/SourceCodePro-Regular.ttf"; // путь к шрифту
$color = imageColorAllocate($thumb, 252, 252, 238); //Цвет шрифта 
$text = "↺ $date"; // текст, который мы написали здесь
$font_size = 13; // размер шрифта

// изменение размера, смещение рисунка при необходимости:
imagecopyresampled($thumb, $source, 0, 0, 13, 6, $pastewidth, $pasteheight, $width, $height);

// вставка даты и времени генерации ринунка, смещение текста при необходимости:
imagettftext($thumb, $font_size, 0, 96, 168, $color, $font, $text);

// устанавливаем тип содержимого:
header('content-Type: image/jpg');

//  сохранение готового изображения, имя, качество, вывод изображения на экран браузера:
imagejpeg($thumb, 'weather.jpg', 95);
imagejpeg($thumb);

// удаляем временный файл и очищаем память:
unlink('weather_temp.png');
imagedestroy($image);
imagedestroy($thumb);

// автоматический редирект на картинку - работает в браузере но шлюз почему-то не подхватывает(.
//header('location:weather.jpg');

?>
