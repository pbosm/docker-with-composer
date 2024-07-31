<?php

namespace app\api;

use app\api\controller\InstanceController;
use app\api\core\Request;
use Exception;

require_once __DIR__ . '/../vendor/autoload.php';
require_once './helpers/Helpers.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE");

header('Access-Control-Allow-Headers: Authorization, Content-Type, x-xsrf-token, x_csrftoken, Cache-Control, X-Requested-With');

class Rest {
    public static function open($classMethod, Request $request) {
        try {
            list($class, $method) = explode('/', $classMethod);

            $fullClassNameController = "app\\api\\controller\\{$class}";
            $fullClassNameService    = "app\\api\\service\\{$class}";

            if (class_exists($fullClassNameController) || class_exists($fullClassNameService)) {
                $classToInstantiate = class_exists($fullClassNameController) ? $fullClassNameController : $fullClassNameService;

                if (method_exists($classToInstantiate, $method)) {
                    $return = call_user_func_array(array(new $classToInstantiate, $method), array($request));

                    return json_encode(array('status' => 'success', 'data' => $return));
                } else {
                    return json_encode(array('status' => 'error', 'data' => 'Método inexistente!'));
                }
            } else {
                return json_encode(array('status' => 'error', 'data' => 'Classe inexistente!'));
            }
        } catch (Exception $e) {
            $errorMessage 	= $e->getMessage();
            
            echo json_encode(array('status' => 'error', 'data' => $errorMessage));
        }
    }
}

if (isset($_REQUEST['function']) || parseInputClassName()) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET' || $_SERVER['REQUEST_METHOD'] === 'PUT' || $_SERVER['REQUEST_METHOD'] === 'DELETE') {
        $functionFreeAccess = ['LoginController/loginClient', 'LoginController/registerUser'];

        $request = new Request();

        if (in_array($_REQUEST['function'] ?? parseInputClassName(), $functionFreeAccess)) {
            echo Rest::open($_REQUEST['function'] ?? parseInputClassName(), $request);
        } else if (InstanceController::app()->UsuarioService->verifySessionAndToken()) {
            echo Rest::open($_REQUEST['function'] ?? parseInputClassName(), $request);
        } else {
            unset($_SERVER['HTTP_AUTHORIZATION']);

            echo json_encode(array('status' => 'error', 'data' => 'Unauthorized'));

            http_response_code(401); exit;
        }
    }
}

?>