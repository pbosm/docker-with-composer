<?php

namespace app\api\models\activeRecord;

use Exception;
use app\api\controller\InstanceController;
use PDO;

abstract class Query {
    public function findByPk($pk) {
        try {
            $tableName = $this->tableName();

            $stmt = InstanceController::app()->Database::connectionPDO()->prepare("SELECT * FROM $tableName WHERE id = :id");
            $stmt->bindParam(':id', $pk);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $this->addAttributes($result);
            }

            return [];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function findByAttributes($attributes, $condition = '', $params = [])
    {
        try {
            $tableName = $this->tableName();
            $conditions = [];

            foreach ($attributes as $name => $value) {
                $conditions[]     = "$name = :$name";
                $params[":$name"] = $value;
            }

            if (!empty($condition)) {
                $conditions[] = $condition;
            }

            $stmt = InstanceController::app()->Database::connectionPDO()->prepare("SELECT * FROM $tableName WHERE " . implode(' AND ', $conditions));
            $stmt->execute($params);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $this->addAttributes($result);
            }

            return [];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function findAllByAttributes($attributes, $condition = '', $params = [])
    {
        try {
            $tableName = $this->tableName();
            $conditions = [];

            foreach ($attributes as $name => $value) {
                $conditions[]     = "$name = :$name";
                $params[":$name"] = $value;
            }

            if (!empty($condition)) {
                $conditions[] = $condition;
            }

            $stmt = InstanceController::app()->Database::connectionPDO()->prepare("SELECT * FROM $tableName WHERE " . implode(' AND ', $conditions));
            $stmt->execute($params);

            $results = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $results[] = $this->addAttributes($row);
            }

            return $results;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function countFindByAttributes($attributes, $condition = '', $params = [])
    {
        try {
            $tableName = $this->tableName();
            $conditions = [];
    
            foreach ($attributes as $name => $value) {
                $conditions[]     = "$name = :$name";
                $params[":$name"] = $value;
            }
    
            if (!empty($condition)) {
                $conditions[] = $condition;
            }
    
            $stmt = InstanceController::app()->Database::connectionPDO()->prepare("SELECT COUNT(*) FROM $tableName WHERE " . implode(' AND ', $conditions));
            $stmt->execute($params);
            $result = $stmt->fetchColumn();
    
            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function insert($modelOrAttributes = false)
    {
        try {
            $tableName  = $this->tableName();

            if ($modelOrAttributes instanceof Model) {
                $model      = $modelOrAttributes;
                $attributes = $model->getAttributes();
            } elseif (is_array($modelOrAttributes)) {
                $attributes = $modelOrAttributes;
            } else {
                return false;
            }
        
            $columns = [];
            $placeholders = [];
            $params = [];
        
            if (isset($attributes)) {
                foreach ($attributes as $name => $value) {
                    $columns[] = $name;
                    $placeholders[] = ":$name";
                    $params[":$name"] = $value;
                }
            }
        
            $columnsStr = implode(', ', $columns);
            $placeholdersStr = implode(', ', $placeholders);
        
            $stmt = InstanceController::app()->Database::connectionPDO()->prepare("INSERT INTO $tableName ($columnsStr) VALUES ($placeholdersStr)");
        
            $stmt->execute($params);

            // return InstanceController::app()->Database::connectionPDO()->lastInsertId();
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}