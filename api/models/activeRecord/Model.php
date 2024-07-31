<?php

namespace app\api\models\activeRecord;

use Exception;
use app\api\controller\InstanceController;
use PDO;
use ReflectionClass;

abstract class Model extends Query {
    protected $attributes = [];
    protected static $models = [];
    abstract protected function tableName();

    public function __construct() {
        $this->loadAttributes();
    }
    public function loadAttributes() {
        $table = $this->tableName();

        $sql = InstanceController::app()->Database::connectionPDO()->prepare("DESCRIBE $table");
        $sql->execute();

        $columns = $sql->fetchAll(PDO::FETCH_COLUMN);

        foreach ($columns as $column) {
            $this->attributes[$column] = null;
        }
    }

    public function getModelsClass() {
        $reflect   = new ReflectionClass(static::class);
        $class     = $reflect->getShortName();

        $classPath = "app\\api\\models\\{$class}";

        if (!class_exists($classPath)) {
            throw new Exception("{$class} does not exist");
        }

        return $classPath;
    }

    public static function model($className=__CLASS__) {
        if (isset(self::$models[$className])) {
            return self::$models[$className];
        } else {
            $model = self::$models[$className] = new $className(null);

            return $model;
        }
    }
    
    public function addAttributes($result) {
        $class = $this->getModelsClass();

        $clasDynamic = new $class();

        foreach ($result as $attribute => $value) {
            $clasDynamic->$attribute = $value;
        }

        return $clasDynamic;
    }

    public function getAttributes() {
        return $this->attributes;
    }

    public function __get($name) {
        if (array_key_exists($name, $this->attributes)) {
            if (empty($this->attributes[$name])) {
                return null;
            }

            return $this->attributes[$name];
        } else {
            throw new Exception("Propriedade '$name' não existe nesta instância.");
        }
    }

    public function __set($name, $value) {
        $this->attributes[$name] = $value;
    }

    public function __isset($name) {
        $this->__get($name);

        return array_key_exists($name, $this->attributes);
    }
}