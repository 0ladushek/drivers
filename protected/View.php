<?php


namespace App;


class View
{
    use MagicTrait;

    public function display($path)
    {
        include __DIR__ . '/../templates/template.php';
    }

}