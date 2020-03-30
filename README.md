
# Simple archive builder
Smart and simple PHP archive builder. You can create an archive, save it to disk or send it to the user. Supports adding files from local disc, URL or string. It allows saving the complex structure as a folder tree. Supports zip and tar archives. To create tar.gz archive please look at the following <a href="https://github.com/commando1251/archive/blob/master/examples/tar/CompressArchive.php">example</a>.
### Requirements
PHP >= 7.1.3, Composer<br />
For zip archives installed zlib
### Installing
```bash
$ composer require commando1251/archive
```

### Basic Usage

```php
<?php

require __DIR__.'/vendor/autoload.php';
use Commando1251\Archive\ArchiveCreator;

try {
    $archive = new ArchiveCreator('test' . time() . '.zip');
    $archive->add('/var/www/archive_test/pics/folder1/1.jpg');
    $archive->add('/var/www/archive_test/pics/folder1/2.jpg', 'test_folder');
    $archive->build();
} catch (Exception $exception) {
    echo $exception->getMessage();
}
```

Test folder with files named "pics" located in the examples folder. Place it in document root or other location and edit path to test .jpg files in data arrays. Current path is shown for informational purposes only.

### Laravel
To use the package in Laravel environment please do the following steps:

```bash
$ composer require commando1251/archive
```
Set the service provider fully qualified class name in the config.app:

**config/app.php**
```php
<?php

return [
  ...
  'providers' => [
  ....
    Commando1251\Archive\Laravel\ArchiveServiceProvider::class
  ]
];
```
To register facade add following code:

```php
<?php

return [
  ...
  'aliases' => [
  ....
    'Archive' => Commando1251\Archive\Laravel\Facades\Archive::class
  ]
];
```
Please look for Laravel <a href="https://github.com/commando1251/archive/blob/master/examples/laravel/">examples</a>

### About


###### Author
Andrey Dobrozhanskiy  - andrey.dobrozhanskiy@gmail.com


###### License
Simple archives builder is licensed under the MIT License - see the LICENSE file for details

