<?php

if (!is_file($autoloaderFile = __DIR__ . '/../vendor/autoload.php') && !is_file($autoloaderFile = __DIR__ . '/../../../../../../vendor/autoload.php')) {
    throw new \LogicException('Could not find autoload.php in vendor/. Did you run "composer install"?');
}

require $autoloaderFile;
