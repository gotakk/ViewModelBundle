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
    ///////////////////////
    // UNDER CONSTRUCTION
    ///////////////////////

    // $vm = array(
    //     'date' => '2015-06-12',              // CHECK IF in_array($skel, 'date') IS TRUE
    //     'authors' => array(                  // CHECK IF skel['authors'] EXISTS
    //         'gotakk',                           // ARRAY IS SEQUENTIAL => CHECK IF skel['authors'] IS EMPTY ARRAY OR CONTAIN ONLY ONE ARRAY
    //         'remiii',
    //     ),
    //     'movies' => array(                   // CHECK IF skel['movies'] EXISTS 
    //         array(                              // ARRAY IS SEQUENTIAL => CHECK IF skel['movies'] IS EMPTY ARRAY OR CONTAIN ONLY ONE ARRAY
    //             'title' => 'Lord Of Rings',        
    //             'resume' => 'resume of lord of rings',
    //         ),
    //     ),
    //     'repair' => array(
    //         'brand' => array(
    //             'apple',
    //             'google',
    //         ),
    //     ),
    // );

    // $skel = array(
    //     'date',                              // CHECK IF vm['date'] EXISTS
    //     'authors' => array(),                // CHECK IF vm['authors'] EXISTS + CHECK IF vm['authors'] is empty OR SEQUENTIAL ARRAYq
    //     'movies' => array(                   // CHECK IF vm
    //         array(
    //             'title',
    //             'resume',
    //         ),
    //     ),
    //     'repair' => array(
    //         'brand' => array(),
    //     ),
    // );

    // public function validateSkelByViewModel(ViewModelNode $vm, $skel = null)
    // {
    //     if ($skel === null) {
    //         $skel = $this->skel;
    //     }

    //     foreach ($vm as $key => $value) {
    //         file_put_contents('/tmp/skel', $key . ' - ' . print_r($value, true) . PHP_EOL, FILE_APPEND);
    //         if (!($value instanceof ViewModelNode)) {
    //             if (!in_array($key, $skel)) {
    //                 throw new \InvalidArgumentException("$key not exists");
    //             }
    //         } elseif (empty($value)) {
    //             if (!isset($vm[$key])) {
    //                 throw new \InvalidArgumentException("$key not exists");
    //             }
    //             foreach ($vm[$key] as $k => $v) {
    //                 if (!is_numeric($k)) {
    //                     throw new \InvalidArgumentException("$key is not sequential array. Contains not numeric key ($k)");
    //                 }
    //             }
    //         } else {
    //             if (!array_key_exists($key, $skel)) {
    //                 throw new \InvalidArgumentException("$key not exists");
    //             }
    //             file_put_contents('/tmp/args', $key . ' ' . print_r($vm[$key], true) . PHP_EOL . '-' . PHP_EOL . print_r($skel[$key], true) . PHP_EOL, FILE_APPEND);
    //             $this->validateSkelByViewModel($vm[$key], $skel[$key]);
    //         }
    //     }

    //     return true;
    // }
}
