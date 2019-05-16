thumbnails
===================

Component for resize images on php. Creates thumbnails of pictures with various handlers: resize, crop, fill, watermark.
You can also create your handlers, and add them to the description of the thumbnail.

### Features:
* Supports different types of source image storage.
* Supports various types of thumbnail storage
* Ability to create your own storage types (ftp, Database, Http)
* Simple apply of new handlers In the previously described thumbnails
* Ability to create your own custom image handlers

In the library everywhere is used interfaces, you can implementation necessary logic in your classes

For those who are developing on YII2 there is an adapter of this library [svsoft/yii2-thumbnails](https://github.com/svsoft/yii2-thumbnails)

Installation
---

### Composer
add to composer.json
```json
{
	"require
  		"svsoft/thumbnails": "*"
	}
}
```
and run ```php composer.phar update```

Or
 
run ```php composer.phar require svsoft/thumbnails ```

Configuring and initializing the component
---

Create component with local source image storage and local thumbnail storage
```php
// Creating local image storage
$imageStorage = new ImageLocalStorage(); 

// Create local thumbnail storage
// $dirPath - path to direcrory where storage thambnail files 
// $webDirPath - public url the same folder
$thumbStorage = new ThumbLocalStorage($dirPath, $webDirPath); 

// Based on these storages we create an object that creates thumbnails.
$creator = new ThumbCreator($imageStorage, $thumbStorage);

// Create thumbnail manager, where description thumbnails 
$thumbManager = new ThumbManager();
$thumbManager->setThumbs([
    'content' => new Thumb([
        // simple resize 1140x1140
        new Resize(1140, 1140),
    ]),
    
    'favicon' => new Thumb([
        // Resize fixed size filled with transparent fields
        new ResizeFillingHandler(40, 40),
    ]),
    
    'productDetail' => new Thumb([
        // image handler fixed size with crop centered
        new ResizeCropHandler(600, 600),
        // watermark handler with transparent 30%
        new WatermarkHandler('/var/www/site.ru/....', 30)
    ]),
    
    // ...
]);

// Create component that create thumbnails.
$thumbnails = new Thumbnails($thumbManager, $creator);
```

Using
---

How to get the component where it will be used depends on the application and developer. via service locator, singleton, container, etc.

Example output favicon
```html
    <? /** @var ThumbnailsInterface $thumbnails */ ?>
    <link rel="shortcut icon" href="<?=$thumbnails->thumb('/var/www/site.ru/images/1.jpg', 'favicon') ?>" type="image/png">
```

Example output image of product in tag img 
```html
     <? /** @var ThumbnailsInterface $thumbnails */ ?>
     <img src="<?=$thumbnails->thumb('/var/www/site.ru/images/product/product-1.jpg', 'product') ?>">
 ```
 
An example of creating from an object that implements the interface ThumbInterface
```php
    $thumb = new Thumb([
        // Resize fixed size filled with transparent fields
        new ResizeCropHandler(100, 100),
        ]);
    
     /** @var ThumbnailsInterface $thumbnails */
     // $url - thumbnail url     
     $url = $thumbnails->getCreator()->create('/var/www/site.ru/images/product/product-1.jpg', $thumb);        
 ```


  
 