<?php 

namespace app\api\controller;

class InstanceController {
    private static $instance;

    private $components = [];

    public static function app() {
        if (self::$instance === null) {
            self::$instance = new InstanceController();
        }

        return self::$instance;
    }

    public function __get($name) {
        if (!array_key_exists($name, $this->components)) {
            $className = ucfirst($name);

            $fullClassName           = "app\\api\\service\\{$className}";
            $fullClassNameController = "app\\api\\controller\\{$className}";
            $fullClassNameDatabase   = "app\\Database\\{$className}";

            if (class_exists($fullClassNameController)) {
                $this->components[$name] = new $fullClassNameController();
            }

            if (class_exists($fullClassName)) {
                $this->components[$name] = new $fullClassName();
            }

            if (class_exists($fullClassNameDatabase)) {
                $this->components[$name] = new $fullClassNameDatabase();
            }
        }

        return $this->components[$name];
    }
}




















?>