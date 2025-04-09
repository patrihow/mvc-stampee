<?php
namespace App\Models;

abstract class CRUD extends \PDO
{
    final public function __construct()
    {
        parent::__construct('mysql:host=localhost; dbname=mvc_stampee; port=3306; charset=utf8', 'root', '');
    }

    final public function select($field = null, $order = 'ASC')
    {
        if ($field === null) {
            $field = $this->primaryKey;
        }
        $sql  = "SELECT * FROM $this->table ORDER BY $field $order";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }

    final public function selectId($value, $whereField = null)
    {
        $whereField = $whereField ? $whereField : $this->primaryKey;
        $sql        = "SELECT * FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
        $stmt       = $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $value);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count == 1) {
            return $stmt->fetch();
        } else {
            return false;
        }
    }

    final public function insert($data)
    {
        $data_keys = array_fill_keys($this->fillable, '');
        $data      = array_intersect_key($data, $data_keys);

        $fieldName  = implode(', ', array_keys($data));
        $fieldValue = ":" . implode(', :', array_keys($data));
        $sql        = "INSERT INTO $this->table ($fieldName) VALUES ($fieldValue);";

        $stmt = $this->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        if ($stmt->execute()) {
            return $this->lastInsertId();
        } else {
            return false;
        }
    }

    final public function update($data, $id)
    {
        if ($this->selectId($id)) {
            $data_keys = array_fill_keys($this->fillable, '');
            $data      = array_intersect_key($data, $data_keys);

            $fieldName = null;
            foreach ($data as $key => $value) {
                $fieldName .= "$key = :$key, ";
            }
            $fieldName               = rtrim($fieldName, ', ');
            $sql                     = "UPDATE $this->table SET $fieldName WHERE $this->primaryKey = :$this->primaryKey";
            $data[$this->primaryKey] = $id;
            $stmt                    = $this->prepare($sql);
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    final public function delete($value)
    {
        if ($this->selectId($value)) {
            $sql  = "DELETE FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
            $stmt = $this->prepare($sql);
            $stmt->bindValue(":$this->primaryKey", $value);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function unique($field, $value)
    {
        $sql  = "SELECT * FROM $this->table WHERE $field = :$field";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field", $value);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count == 1) {
            return $stmt->fetch();
        } else {
            return false;
        }
    }

// -- Fonction créée pour le Sprint 2

    final public function fetchAllById($fieldID, $conditionField, $sortField = null, $sortOrder = 'ASC')
    {

        if ($sortField === null) {
            $sortField = $this->primaryKey;
        }

        $query = "SELECT * FROM $this->table WHERE $conditionField = :fieldID ORDER BY $sortField $sortOrder";

        $statement = $this->prepare($query);

        $statement->bindValue(":fieldID", $fieldID);

        $statement->execute();

        return $statement->fetchAll();
    }

    // -- Nouvelles fonctions ajoutées pour Stampee
    final public function selectByLimit($field = null, $limit = 4, $order = 'ASC')
    {
        if ($field === null) {
            $field = $this->primaryKey;
        }
        $sql  = "SELECT * FROM $this->table ORDER BY $field $order LIMIT $limit";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }

    final public function selectIdWhere($whereField, $value)
    {
        $sql  = "SELECT * FROM $this->table WHERE $whereField = :value";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":value", $value);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count == 1) {
            return $stmt->fetch();
        } else {
            return false;
        }
    }

    final public function selectWhereIdMax($whereField, $value, $column)
    {
        $sql  = "SELECT * FROM $this->table WHERE $whereField = :value AND $column = (SELECT MAX($column) FROM $this->table WHERE $whereField = :value)";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":value", $value);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count == 1) {
            return $stmt->fetch();
        } else {
            return false;
        }
    }

}
