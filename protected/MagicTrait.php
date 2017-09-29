<?php


namespace App;

trait MagicTrait
{
    protected $data = [];

    public function __get($key)
    {
        return $this->data[$key];
    }

    public function __set($key, $val)
    {
        $methodName = 'validate_' . $key;
        if (method_exists($this, $methodName)) {
            $this->$methodName($val);
        }
        return $this->data[$key] = $val;
    }

    public function __isset($key)
    {
        return isset($this->data[$key]);
    }
}