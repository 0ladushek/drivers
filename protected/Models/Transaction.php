<?php

namespace App\Models;


class Transaction extends Model
{
    const TABLE = 'transactions';

    public static function findByDriverId ($id)
    {
        $db = new \App\Db;
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE driver_id = :id';
        $data = $db->query($sql, static::class, ['id' => $id]);

        if (empty($data)) {
            return false;
        }

        return $data;
    }
}