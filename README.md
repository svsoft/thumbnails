thumbnails
===================

Компонет для ресайза картинок на php. Создает миниатюры картинок с различными обработчиками: ресайз, кроп, заливка, водяной знак. 
Также можно создовать свои обработчики, и добовлять их в описание миниатюры.

* Подерживает разные типы хранилища исходных картинок
* Подерживает разные типы хранилища для миниатюр
* Возможность создания своих хранилищ (ftp, БД, http)
* Простое наложение новых обработчиков на уже описаные миниаюры
* Возможность создания своих произвольных обработчиков изображений

В библиотеке везде используются интерфейсы, есть возможность переопределить любой класс реализацию. 

Есть также адаптер для фреймоврка YII2 svsoft/yii2-thumbnails

Установка
---

Добавить в composer.json
```json
{
	"require": {
  		"svsoft/thumbnails": "*"
	}
}
```
Или
```bash
    composer require svsoft/thumbnails
```

## Конфигурирование и инициализация компонента

Создание компонента с локальным хранилищем исходных картинко, и локальным хранилешем миниатюр
```php
// Создаем объек локального хранилища картинок
$imageStorage = new ImageLocalStorage(); 

// Создаем обьект локального хранилища миниатюр
// $dirPath - путь до папки на сервере где хранятся файлы миниатюр 
// $webDirPath - урл до этой же папки 
$thumbStorage = new ThumbLocalStorage($dirPath, $webDirPath); 

// На основе этих хранилищ создаем объект создающий миниатюры
$creator = new ThumbCreator($imageStorage, $thumbStorage);

// Создаем менеджер миниатюр и описываем миниатюры
$thumbManager = new ThumbManager();
$thumbManager->setThumbs([
    'content' => new Thumb([
        // Простой ресайз по ширине 1140, и высоте 1140
        new Resize(1140, 1140),
    ]),
    
    'favicon' => new Thumb([
        // Ресайз фиксированого размера с заливкой полей прозрачным
        new ResizeFillingHandler(40, 40),
    ]),
    
    'productDetail' => new Thumb([
        // обработчик фиксированого размера с обрезанием по центру
        new ResizeCropHandler(600, 600),
        // обработчик наложения водяного знака, с прозрачностью 30%
        new WatermarkHandler('/var/www/site.ru/....', 30)
    ]),
    
    // ...
]);

// Создаем сам компонент который будем вызывать когда нам надо будут создать миниатюру
$thumbnails = new Thumbnails($thumbManager, $creator);
```

Также если позволяет инфраструктура приложения можно использовать DI контейнер работать через соответствующии интерфейсы

## Использование

Как получить доступ к компоненту там где он будет использоваться зависит от приложения и разработчика. 
через сервис локатор, синглтон, контейнер, и т.д. 

Пример вывода для favicon
```html
    <? /** @var ThumbnailsInterface $thumbnails */ ?>
    <link rel="shortcut icon" href="<?=$thumbnails->thumb('/var/www/site.ru/images/1.jpg', 'favicon') ?>" type="image/png">
```

Пример вывода катринки товара
```html
     <? /** @var ThumbnailsInterface $thumbnails */ ?>
     <img src="<?=$thumbnails->thumb('/var/www/site.ru/images/product/product-1.jpg', 'product') ?>">
 ```
 
Пример создания из объекта реализующие интерфейс ThumbInterface
```php
    $thumb = new Thumb([
        // обработчик фиксированого размера с обрезанием по центру
        new ResizeCropHandler(100, 100),
        ]);
    
     /** @var ThumbnailsInterface $thumbnails */
     // $url - url миниатюры     
     $url = $thumbnails->getCreator()->create('/var/www/site.ru/images/product/product-1.jpg', $thumb);        
 ```


  
 