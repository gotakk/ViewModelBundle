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

### Step 3: Create your ViewModel folder structure

* Create a ViewModel folder in your bundle root
* Inside the ViewModel folder create subfolders to organize your files. The convention is to create a subfolder per each controller file.
* In these subfolders, create one ViewModelAssembler file per action.

Example of ViewModel structure in your project

```
src/Acme/FooBarBundle
|
|
|-- Controller
|   |-- CorporateController.php               # <- contactAction(), homeAction()
|   `-- TravelController.php                  # <- belgiumAction(), franceAction()
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

### Step 4: Create your Assembler!

```php
<?php
// src/Acme/FooBarBundle/ViewModel/Corporate/ContactViewModelAssembler.php

namespace Acme\FooBarBundle\ViewModel\Corporate;

use gotakk\ViewModelBundle\ViewModel\ViewModelAssembler;

use Acme\FooBarBundle\Entity\Model1;
use Acme\FooBarBundle\Entity\Model2;
use Acme\FooBarBundle\Entity\Model3;

class ContactViewModelAssembler extends ViewModelAssembler
{
  public function __construct()
  {
    $this->skel = array(
      'pageTitle',
      'mails' => array(),
    );
  }

  public function generateViewModel($model1, $model2, $model3)
  {
    $vm = $this->vmService->createViewModel();

    $vm->setPageTitle('Contact Us');
    $vm->addMail('abc@gmail.com');
    $vm->addMail('def@gmail.com');

    return $vm->toArray();
  }
}
```

### Step 5: Declare your assembler as a service.

```yml
# src/Acme/FooBarBundle/Resouces/config/services.yml

services:
    acme_foobar.contact_view_model_assembler:
        class: Acme\FooBarBundle\ViewModel\Corporate\ContactViewModelAssembler
	parent: gotakk.view_model.view_model_assembler
```

### Step 6: Use your assembler in your controler

```php
// src/Acme/FooBarBundle/Controller/CorporateController.php

namespace Acme\FooBarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MainController extends Controller
{
    /**
     * @Template
     */
    public function landingAction(Request $request)
    {
        $model1 = $this->get('doctrine')->getManager()->getRepository('AcmeFooBarBundleBundle:Model1')->findAll();
        $model2 = $this->get('doctrine')->getManager()->getRepository('AcmeFooBarBundleBundle:Model2')->findAll();
        $model3 = $this->get('doctrine')->getManager()->getRepository('AcmeFooBarBundleBundle:Model3')->findAll();

        $vm = $this->get('acme_foobar.contact_view_model_assembler')->generateViewModel($model1, $model2, $model3);

        return array(
            'vm' => $vm,
        );
    }
```

That's it!

## License

ViewModelBundle is licensed under the MIT license (see LICENSE.md file).

## Authors

Thanks to
* [Remiii](https://github.com/Remiii)
