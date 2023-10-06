<?php

namespace MyFramework\ORM;
use PDO;
use PDOStatement;

class Model
{

    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dbname = 'my_framework';
    private PDO $pdo;
    protected $table_name = null;
    public $query;

    public function __construct()
    {
        $this->connect();

        if (is_null($this->table_name)) {
            $this->table_name = strtolower(self::class) . "s";
        }
    }

    private function connect()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname";
        $this->pdo = new PDO($dsn, $this->user, $this->pass);
    }

    public function statement($sql, $params = []): bool|PDOStatement
    {
        $this->query = $this->pdo->prepare($sql);
        $this->query->execute($params);
        return $this->query;
    }

    public function query($sql, $params = []): bool
    {
        if ($this->statement($sql, $params)) {
            return $this->query->fetch(PDO::FETCH_ASSOC);
        }

        return false;
    }


    public function all()
    {
        $sql = "SELECT * FROM ?";
        $params = [$this->table_name];

        $result = $this->query($sql, $params);

        if (!$result) {
            return null;
        }

        return $result;
    }


    public function find($id)
    {
        $sql = "SELECT * FROM ? WHERE id = ?";
        $params = [$this->table_name, $id];

        $stmt = $this->statement($sql, $params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return $result;
    }

}