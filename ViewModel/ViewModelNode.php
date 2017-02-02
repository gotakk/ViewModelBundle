<?php

namespace gotakk\ViewModelBundle\ViewModel;

class ViewModelNode implements \ArrayAccess
{
    static private $plurals =array();

    public static function addPlural($singular, $plural)
    {
        self::$plurals[$singular] = $plural;
    }

    public static function getPlurals()
    {
        return self::$plurals;
    }

    public function __construct($skel = array())
    {
        foreach ($skel as $key => $value) {
            $this->$key = (is_array($value)) ? new ViewModelNode($value) : $value;
        }
    }

    private function getNewIntIndex()
    {
        $vars = array();
        foreach (get_object_vars($this) as $k => $v) {
            if (is_numeric($k)) {
                $vars[$k] = $v;
            }
        }
        ksort($vars);
        end($vars);
        return (count($vars)) ? intval(key($vars)) + 1 : 0;
    }

    public function offsetSet($offset, $value)
    {
        $index = $this->getNewIntIndex();

        if (is_null($offset)) {
            $this->$index = $value;
        } else {
            $this->$offset = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }

    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }

    public function offsetGet($offset)
    {
        return isset($this->$offset) ? $this->$offset : null;
    }

    public function add($data)
    {
        $index = $this->getNewIntIndex();
        return $this->$index = (is_array($data)) ? $this->$index = new ViewModelNode($data) : $this->$index = $data;
    }

    public function __call($name, $args)
    {
        try {
            preg_match('/^[a-z]*/', $name, $matches);
            $action = $matches[0];
            preg_match('/[A-Z][a-zA-Z]*/', $name, $matches);
            $target = lcfirst($matches[0]);
        } catch (\Exception $e) {
            throw new \BadMethodCallException("Error while parsing method name '$name()'");
        }

        switch ($action) {
            case 'get':
                if (isset($this->$target)) {
                    return $this->$target;
                }
                break;

            case 'add':
                $arg = $args[0];
                $entityName = isset(self::$plurals[$target]) ? self::$plurals[$target] : $target . 's';

                if (isset($this->$entityName) && $this->$entityName instanceof ViewModelNode) {
                    return $this->{$entityName}->add($arg);
                } else {
                    $this->$entityName = new ViewModelNode($args);
                    return $this->{$entityName}[0];
                }
                break;

            case 'set':
                $arg = $args[0];
                $this->$target = is_array($arg) ? new ViewModelNode($arg) : $arg;
                break;

            default:
                throw new \BadMethodCallException("$name(): Undefined method");
                break;
        }
        return null;
    }

    public function toArray()
    {
        $arr = array();

        foreach (get_object_vars($this) as $key => $value) {
            $arr[$key] = ($value instanceof ViewModelNode) ? $value->toArray() : $value;
        }

        return $arr;
    }
}
