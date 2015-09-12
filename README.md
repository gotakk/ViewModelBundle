# ViewModelBundle
A Symfony2 bundle to filter and organize data sent to the View from the Controller

# Installation

## Step 1: Add this bundle to your project in composer.json

```
$ composer require gotakk/view-model-bundle
```

## Step 2: Enable the bundle to your app/AppKernel.php

```
// app/AppKernel.php
public function registerBundles()
{
  return array(
    // ...
    new gotakk\gotakkViewModelBundle(),
    // ...
  );
}
```
