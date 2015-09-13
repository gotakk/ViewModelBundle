# ViewModelBundle

A Symfony2 bundle to filter and organize data sent to the View from the Controller

[![Build Status](https://travis-ci.org/gotakk/ViewModelBundle.svg?branch=master)](https://travis-ci.org/gotakk/ViewModelBundle)
[![Coverage Status](https://coveralls.io/repos/gotakk/ViewModelBundle/badge.svg?branch=master&service=github)](https://coveralls.io/github/gotakk/ViewModelBundle?branch=master) https://travis-ci.org/gotakk/ViewModelBundle.svg?branch=master
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gotakk/ViewModelBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gotakk/ViewModelBundle/?branch=master)

## Installation
### Step 1: Add this bundle to your project in composer.json

```
$ composer require gotakk/view-model-bundle
```

### Step 2: Enable the bundle to your app/AppKernel.php

```
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
