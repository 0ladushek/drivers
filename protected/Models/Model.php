<?php

namespace App\Models;

use App\Loger;
use App\MagicTrait;
use App\MultiException;

/**
 * Class Model
 * @package App\Models
 * @property const TABLE
 */


abstract class Model
{

    use MagicTrait;

    const TABLE = '';


    public function fill(array $data)
    {

        foreach ($data as $k => $v) {
            $this->$k = $data[$k];
        }
        return $this;
    }

    public static function findAll()
    {
        $db = new \App\Db;
        $sql = 'SELECT * FROM ' . static::TABLE;
        return $db->query($sql, static::class);
    }

    public static function findById($id)
    {
        $db = new \App\Db;
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id = :id';
        $data = $db->query($sql, static::class, ['id' => $id]);

        if (empty($data)) {
            return false;
        }

        return $data[0];
    }

    protected function isNew()
    {
        if (empty($this->data['id'])) {
            return true;
        }

        $sql = 'SELECT id FROM ' . static::TABLE;
        $db = new \App\Db;
        $arr = $db->query($sql);

        foreach ($arr as $value) {
            if ($this->data['id'] == $value->id) {
                return false;
            }
        }
        return true;
    }

    public function insert()
    {
        $rows = $values = [];
        foreach ($this->data as $key => $val) {
            if($key == 'id') {
                continue;
            }
            $rows[] = $key;
            $values[$key] = $val;
        }
        $sql = 'INSERT INTO ' . static::TABLE . ' (' .  implode(', ', $rows) . ') ' .
            'VALUES ' . '(:' . implode(', :', $rows) . ')';
        $db = new \App\Db;
        $db->execute($sql, $values);
        $this->data['id'] = $db->lastInsertId();
        return $sql;
    }

    public function update() {
        if (empty($this->data['id'])) {
            return false;
        }

        $rows = $values = [];
        foreach ($this->data as $key => $val) {
            if('id' === $key) {
                continue;
            }
            $rows[] = $key . '=:' . $key;
            $values[$key] = $val;
        }
        $sql = 'UPDATE ' . static::TABLE . ' SET ' . implode(", ", $rows)  . ' WHERE id=' . $this->data['id'];
        $db = new \App\Db;
        return $db->execute($sql, $values);
    }

    public static function delete($id)
    {
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE id = :id';
        $db = new \App\Db;
        return $db->execute($sql, ['id' => $id]);
    }

    public function save() {
        if($this->isNew()) {
            return $this->insert();
        }
        return $this->update();

    }
}