<?php

namespace app\api\controller;

class RouterController {
    private $routes = [];

    private $routesVerify = [];

    private $token;

    private $title;

    private $urlName;

    public function addRoute($name, $path, $accessLevel, $token = false, $title = null) {
        $this->routes[$name] = $path;
        $this->routesVerify[$accessLevel][$path] = $accessLevel;
        $this->token        = $token;
        $this->title[$name] = $title ?? 'PageView';
    }
    public function getUrl() {
        $url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : 'loginAccess';
        $url = trim($url, '/');

        $this->urlName = $url;

        return $url;
    }
    public function route() {
        $url = $this->getUrl();

        if (array_key_exists($url,  $this->routes)) {
            $pathFile = $this->routes[$url];

            if (array_key_exists($pathFile, $this->routesVerify['public'])) {
                if (file_exists($pathFile)) {
                    return require_once $pathFile;
                } else {
                    $this->notFoundPage();
                }
            }

            if (array_key_exists($pathFile, $this->routesVerify['adm']) && $this->token) {
                if (file_exists($pathFile) && InstanceController::app()->UsuarioService->verifySessionAndToken(true)) {
                    return require_once $pathFile;
                } else {
                    $this->notUnauthorizedPage();
                }
            } else {
                $this->notUnauthorizedPage();
            }
        } else {
            $this->notFoundPage();
        }
    }

    public function notFoundPage() {
        header('Location: /error/error404'); exit;
    }

    public function notUnauthorizedPage() {
        $_SESSION = array();
        session_destroy();

        header('Location: /error/unauthorized401');
        exit;
    }

}

?>
