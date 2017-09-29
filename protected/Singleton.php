<?php

namespace App;


trait Singleton
{
    public static $instance = null;
    protected function __construct(){ }

    public static function instance () {
        if (static::$instance  == null) {
            static::$instance = new static;
        }
        return static::$instance;
    }
}