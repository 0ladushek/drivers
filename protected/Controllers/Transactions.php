<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Driver;
use App\Models\Transaction;

class Transactions extends Controller
{
    public function actionDefault()
    {
        if (empty($_GET['id'])){
            header('Location: /');
            die;
        }
        $driver = Driver::findById((int) $_GET['id']);
        $this->view->driver = $driver;

        $transactions = Transaction::findByDriverId((int) $_GET['id']);
        $this->view->transactions = $transactions;
        $this->view->display(__DIR__ . '/../../templates/transactions.php');
    }

    public function actionAdd()
    {
        if (!isset($_POST['btn'])) {
            header('Location: /');
            die;
        }
        $driver = Driver::findById((int)$_POST['driver_id']);
        $score = $driver->score;

        if ((int) $_POST['type'] == 0) {
            $newScore = $score - (int) $_POST['summ'];
        }
        elseif($_POST['type'] == 1) {
            $newScore = $score + (int) $_POST['summ'];
        }

        if ($newScore >= 0) {
            // добавить транзакцию
            $transactions = new Transaction;
            $transactions->type = (int) $_POST['type'];
            $transactions->value = (int) $_POST['summ'];
            $transactions->driver_id = $_POST['driver_id'];
            $transactions->date = date('Y-m-d h:i:s');
            $transactions->save();
            // обновить баланс
            $driver->score = $newScore;
            $driver->save();

            header('Location: /transactions/default/?id=' . $driver->id);
            die;
        }
        else {
            $this->view->error = 'Вы не можете снять больше ' . $driver->score . ' руб';
            $this->view->display(__DIR__ . '/../../templates/error.php');
        }

    }
}
