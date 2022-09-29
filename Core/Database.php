<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
    private $connection;
    private $quary;
    public $data;
    private $option = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=" . Config::DB_HOST . ";dbname=" . Config::DB_NAME, Config::DB_USERNAME, Config::DB_PASSWORD, $this->option);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
    public function select($column, $table)
    {


        $this->quary = "SELECT $column FROM $table";
        $stmt = $this->connection->prepare($this->quary);
        $stmt->execute();
        $data = $stmt->fetchAll();
        $this->data = $data;
        // Helper::dd($this->data);
        return $this;
    }
    public function where(array $key, array $operator, array $value)
    {
        if (sizeof($key) == 1) {
            $this->quary .= " WHERE $key[0] $operator[0] ? ";
            $stmt = $this->connection->prepare($this->quary);
            $stmt->execute([$value[0]]);
        } elseif (sizeof($key) == 2) {
            $this->quary .= " WHERE $key[0] $operator[0] ? AND $key[1] $operator[1] ?";
            $stmt = $this->connection->prepare($this->quary);
            $stmt->execute([$value[0], $value[1]]);
        }
        $data = $stmt->fetchAll();
        if (count($data) == 1) {
            $data = $data[0];
        }
        $this->data = $data;
        return $this;
    }
    public function andWhere($key, $operator, $value)
    {
        $this->quary .= " AND $key $operator $value";
        $stmt = $this->connection->prepare($this->quary);
        // $stmt->bindParam(":$key",$value);
        $stmt->execute();
        $data = $stmt->fetchAll();
        if (count($data) == 1) {
            $data = $data[0];
        }
        $this->data = $data;
        return $this;
    }
    public function orderby($column, $sort)
    {
        $this->quary .= " ORDER BY $column $sort";
        $stmt = $this->connection->prepare($this->quary);
        $stmt->execute();
        $data = $stmt->fetchAll();
        $this->data = $data;
        return $this;
    }
    public function get()
    {
        return $this->data;
    }

    public function insert($table, array $columns, array $values)
    {
        $row = "";
        $columns = implode(",", $columns);
        // $Unknown_value = implode(",",$values);
        // foreach($values as $value){
        //     $Unknown_valu=str_replace($value,"?",$Unknown_value);
        // }
        for ($x = 1; $x <= count($values); $x++) {
            if ($x == count($values)) {
                $row .= "?";
                break;
            }
            $row .= "?,";
        }
        $this->quary = "INSERT INTO $table ($columns) VALUES ($row)";
        try {
            $stmt = $this->connection->prepare($this->quary);
            $stmt->execute($values);
            return true;
        } catch (PDOException $e) {
            echo  $e->getMessage();
            return false;
        }
    }
    public function selectWithQuery($sql)
    {
        try {

            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll();
            // if (count($data) == 1) {
            //     $stmt = $this->connection->prepare($sql);
            //     $stmt->execute();
            //     $data = $stmt->fetch();
            // }
            return $data;
        } catch (PDOException $e) {
            echo  $e->getMessage();
            exit;
        }
    }
    public function update($table, array $column, array $values,$id)
    {
        $columns = "";
        $i = 0;
        foreach ($column as $col) {
            $i++;
            if ($i == sizeof($column)) {
                $col .= "=? ";
                $columns .= $col;
                break;
            }
            $col .= "=?, ";
            $columns .= $col;
        }
        $this->quary = "UPDATE $table SET $columns WHERE id = $id";
        try{
            $stmt = $this->connection->prepare($this->quary);
            $stmt->execute($values);
            return true;
        }catch (PDOException $e) {
            echo  $e->getMessage();
            exit;
        }
    }
}
