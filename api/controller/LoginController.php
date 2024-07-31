<?php 

namespace app\api\controller;

use app\api\models\Usuario;
use app\api\core\Request;

use Exception;

class LoginController {
    public function registerUser(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|min:5',
            'email'     => 'required|string|email|max:255',
            'password'  => 'required|string|min:8',
            'cpf'       => 'required|string|min:5',
        ]);

        if (!empty($request->errors())) {
            throw new Exception($request->errors()[0]);
        }

        $verifyExistEmail = Usuario::model()->countFindByAttributes([
            'email' => $request->email,
        ]);

        $verifyExistCpf = Usuario::model()->countFindByAttributes([
            'cpf' => clearString($request->cpf),
        ]);

        if ($verifyExistEmail || $verifyExistCpf > 0) {
            throw new Exception("E-mail ou CPF já cadastrados!");
        }

        if (InstanceController::app()->UsuarioService->addUser($request)) {
            return true;
        }

        return false;
    }

    public function loginClient(Request $request) {
        session_start();

        $password = cryptS($request->password);

        $request->validate([
            'email'     => 'required|string|email|max:255',
        ]);

        if (!empty($request->errors())) {
            throw new Exception($request->errors()[0]);
        }

        $verifyLogin = Usuario::model()->countFindByAttributes([
            'email' => $request->email,
            'senha' => $password,
        ]);

        if ($verifyLogin <= 0) {
            throw new Exception("E-mail ou senha inválidas!");
        }

        $usuario = Usuario::model()->findByAttributes([
            'email' => $request->email,
            'senha' => $password
        ]);

        if (empty($usuario)) {
            throw new Exception("Usuario não encontrado!");
        }

        try {
            // $usuario = (object) $usuarioFind->toApi(['completed' => true]);
            $_SESSION["isLogged"] = true;
            $_SESSION['user'] = [
                'exp'       => time() + 3600,
                'iat'       => time(),
                'id'        => $usuario->id,
                'name'      => $usuario->nome,
                'email'     => $usuario->email,
            ];

            $jwt               = instanceController::app()->JWTAuthenticationController->generateToken($_SESSION['user'], 'HS256');
            $_SESSION['token'] = $jwt;
            // setcookie("token", $jwt, time() + 3600, "/", "", false, true); // Cookie, Expira em 1 hora

            return array($_SESSION["isLogged"], $usuario->getAttributes(), $jwt);
        } catch (exception $e) {
            return "Erro: {$e}";
        }
    }
}

?>