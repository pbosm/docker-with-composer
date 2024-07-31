<?php

namespace app\api\service;

use app\api\controller\InstanceController;
use app\api\models\Usuario;

use Exception;

class UsuarioService {
    private $usuarioCache;
    public function usuario() {
        if (!$this->usuarioCache) {
            if (!empty($_SESSION)) {
                $this->usuarioCache = Usuario::model()->findByPk($_SESSION['user']['id']);
            }

            return $this->usuarioCache;
        }
    }

    public function getToken()
    {
        if (empty($_SESSION) || empty($_SESSION['token'])) {
            return false;
        }

        return $_SESSION['token'];
    }

    public function verifySessionAndToken($isRouter = false): bool
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SERVER['HTTP_AUTHORIZATION']) && !$isRouter) {
            return false;
        }

        if (empty($_SESSION) || !isset($_SESSION['isLogged']) || !$_SESSION['isLogged']) {
            return false;
        }

        if ($_SESSION['token']) {
            return (bool) instanceController::app()->JWTAuthenticationController->decodeToken($isRouter ? $_SESSION['token'] : (retiredBearer($_SERVER['HTTP_AUTHORIZATION'])));
        }

        return true;
    }

    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        unset($_SERVER['HTTP_AUTHORIZATION']);
        $_SESSION = array();
        session_destroy();
        
        return true;
    }

    public function addUser($request)
    {
        if (empty($request)) {
            return false;
        }

        if (empty($request->name) || empty($request->email) || empty($request->password) || empty($request->cpf)) {
            return false;
        }

        if (strlen(clearString($request->cpf)) > 11) {
            throw new Exception("CPF inválido");
        }

        $usuario = Usuario::model();
        $usuario->nome  = $request->name;
        $usuario->email = $request->email;
        $usuario->senha = cryptS($request->password);
        $usuario->cpf   = clearString($request->cpf);

        if ($usuario->insert($usuario)) {
            return true;
        }

        return false;
    }
}

?>