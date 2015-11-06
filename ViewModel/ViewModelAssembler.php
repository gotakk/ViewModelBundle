<?php

namespace gotakk\ViewModelBundle\ViewModel;

use gotakk\ViewModelBundle\ViewModel\ViewModelNode;

abstract class ViewModelAssembler
{
    protected $vmService;
    protected $skel = array();

    public function setViewModelService($vmService)
    {
        $this->vmService = $vmService;
    }

    public function validateViewModelBySkel(ViewModelNode $vm, $skel = null)
    {
        if ($skel === null) {
            $skel = $this->skel;
        }

        foreach ($skel as $key => $value) {
            if (!is_array($value)) {
                if (!isset($vm[$value])) {
                    throw new \InvalidArgumentException("$value not exists");
                }
            } elseif (empty($value)) {
                if (!isset($vm[$key])) {
                    throw new \InvalidArgumentException("$key not exists");
                }
                foreach ($vm[$key] as $k => $v) {
                    if (!is_numeric($k)) {
                        throw new \InvalidArgumentException("$key is not sequential array. Contains not numeric key ($k)");
                    }
                }
            } else {
                if (!isset($vm[$key])) {
                    throw new \InvalidArgumentException("$key not exists");
                }
                $this->validateViewModelBySkel($vm[$key], $value);
            }
        }

        return true;
    }
}
