# ViewModelBundle

A Symfony2 bundle to filter and organize data sent to the View from the Controller

# Installation

## Step 1: Add this bundle to your project in composer.json

```
$ composer require gotakk/view-model-bundle
```

## Step 2: Enable the bundle to your app/AppKernel.php

```php
// app/AppKernel.php
public function registerBundles()
{
  return array(
    // ...
    new gotakk\ViewModelBundle\gotakkViewModelBundle(),
    // ...
  );
}
```

## Step 3: Use it

Example of ViewModel structure in your project

```
src/Acme/FooBarBundle
|
...
|
`-- View
    |-- Assembler
    |   |-- Corporate
    |   |   |-- ContactViewAssembler.php
    |   |   `-- HomeViewAssembler.php
    |   `-- Travel
    |       |-- BelgiumViewAssembler.php
    |       `-- FranceViewAssembler.php
    `-- Model
        |-- Corporate
        |   |-- ContactViewModel.php
        |   `-- HomeViewModel.php
        `-- Travel
            |-- BelgiumViewModel.php
            `-- FranceViewModel.php
```

## License

ViewModelBundle is licensed under the MIT license (see LICENSE.md file).

