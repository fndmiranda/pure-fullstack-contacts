<?php

namespace App\Core;

use PDO;
use PDOException;

class Model
{
    /**
     * @var PDO
     */
    protected $db;

    protected $table;

    protected $primaryKey = 'id';

    protected $fillable = [];

    public function __construct()
    {
        try {
            $this->databaseConnection();
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function all(array $columns = ['*'])
    {
        $columns = implode(', ', $columns);

        $sql = "SELECT $columns FROM $this->table ORDER BY $this->primaryKey DESC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function find($id, array $columns = ['*'])
    {
        $columns = implode(', ', $columns);

        $sql = "SELECT $columns FROM $this->table WHERE $this->primaryKey = :id";
        $query = $this->db->prepare($sql);
        $query->execute([':id' => $id]);

        return $query->fetch();
    }

    public function create(array $attributes)
    {
        $attributes = array_intersect_key($attributes, array_flip($this->fillable));

        $columns = implode(', ', array_keys($attributes));

        $parameters = [];
        foreach ($attributes as $key => $value) {
            $parameters[':'.$key] = $value;
        }
        $keys = implode(', ', array_keys($parameters));

        $sql = "INSERT INTO $this->table ($columns) VALUES ($keys)";
        $query = $this->db->prepare($sql);
        $query->execute($parameters);
        return $this->find($this->db->lastInsertId($this->primaryKey));
    }

    public function update($id, array $attributes)
    {
        $attributes = array_intersect_key($attributes, array_flip($this->fillable));
        $keys = array_keys($attributes);
        $lastKey = end($keys);

        $parameters = [':id' => $id];
        $sets = '';
        foreach ($attributes as $key => $value) {
            $parameters[':'.$key] = $value;
            $sets .= $key.' = :'.$key;
            if ($key != $lastKey) {
                $sets .= ', ';
            }
        }

        $sql = "UPDATE $this->table SET $sets WHERE $this->primaryKey = :id";
        $query = $this->db->prepare($sql);
        $query->execute($parameters);
        return $this->find($id);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE $this->primaryKey = :id";
        $query = $this->db->prepare($sql);
        return $query->execute([':id' => $id]);
    }

    private function databaseConnection() {
        $options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING];

        if (DB_TYPE == 'pgsql') {
            $encoding = " options='--client_encoding=" . DB_CHARSET . "'";
        } else {
            $encoding = "; charset=" . DB_CHARSET;
        }

        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . $encoding, DB_USER, DB_PASS, $options);
    }
}