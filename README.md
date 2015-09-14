# ViewModelBundle

A Symfony2 bundle to filter and organize data sent to the View from the Controller

[![Build Status](https://travis-ci.org/gotakk/ViewModelBundle.svg?branch=master)](https://travis-ci.org/gotakk/ViewModelBundle)
[![Coverage Status](https://coveralls.io/repos/gotakk/ViewModelBundle/badge.svg?branch=master&service=github)](https://coveralls.io/github/gotakk/ViewModelBundle?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gotakk/ViewModelBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gotakk/ViewModelBundle/?branch=master)
[![Total Downloads](https://poser.pugx.org/gotakk/view-model-bundle/downloads)](https://packagist.org/packages/gotakk/view-model-bundle)
[![License](https://poser.pugx.org/gotakk/view-model-bundle/license)](https://packagist.org/packages/gotakk/view-model-bundle)  
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/78a4326b-43d1-4c2e-917c-dc1e013fca95/big.png)](https://insight.sensiolabs.com/projects/78a4326b-43d1-4c2e-917c-dc1e013fca95)

## Installation

### Step 1: Add this bundle to your project in composer.json


```
$ composer require gotakk/view-model-bundle
```

### Step 2: Enable the bundle to your app/AppKernel.php

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

### Step 3: Use it

Example of ViewModel structure in your project

```
src/Acme/FooBarBundle
|
...
|
`-- ViewModel
    |-- Corporate
    |   |-- ContactViewModelAssembler.php
    |   `-- HomeViewModelAssembler.php
    `-- Travel
        |-- BelgiumViewModelAssembler.php
        `-- FranceViewModelAssembler.php
```

Declarer assemblers as a service.

```yml
# src/Acme/FooBarBundle/Resouces/config/services.yml
services:
    # ...
    # Service ViewAssembler
    acme_foobar.contact_view_model_assembler:
        class: Acme\FooBarBundle\ViewModel\Corporate\ContactViewModelAssembler
        arguments: [@gotakk.view_model.service]
    # ...
...

```

Use service in your controler

```php
// src/Acme/FooBarBundle/Controller/CorporateController.php

// ...

$vm = $this->get('acme_foobar.contact_view_model_assembler')->generateViewModel($model1, $model2, $model3);

// ...

```

Assemble it

```php
<?php

// src/Acme/FooBarBundle/ViewModel/Corporate/ContactViewModelAssembler.php

namespace acme\FooBarBundle\ViewModel\Corporate;

use gotakk\ViewModelBundle\ViewModel\ViewModelAssembler;
use gotakk\ViewModelBundle\ViewModel\ViewModelNode;

use acme\FooBarBundle\Entity\Model1;
use acme\FooBarBundle\Entity\Model2;
use acme\FooBarBundle\Entity\Model3;

class ContactViewModelAssembler extends ViewModelAssembler
{
    // TODO
}
```

That's it!

## License

ViewModelBundle is licensed under the MIT license (see LICENSE.md file).

## Authors

Thanks to
* [Remiii](https://github.com/Remiii)

