<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Driver;

class Drivers extends Controller
{
    public function actionDefault()
    {
        $drivers = \App\Models\Driver::findAll();
        $this->view->drivers = $drivers;
        return $this->view->display(__DIR__ . '/../../templates/index.php');
    }

    public function actionAdd()
    {
        if (empty($_POST['name']) || empty($_POST['car']) ) {
           header('Location: /');
           die;
        }
        $driver = new Driver;
        $driver->name = $_POST['name'];
        $driver->car = $_POST['car'];
        $driver->reg_date = date('Y-m-d h:i:s');
        $driver->score = 0;
        $driver->save();

        header('Location: /');
        die;
    }

    public function actionDelete()
    {
        if (empty($_GET['id'])){
            header('Location: /');
            die;
        }
        Driver::delete((int) $_GET['id']);
        header('Location: /');
        die;
    }
}