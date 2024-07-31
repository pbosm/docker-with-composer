<?php

use app\api\controller\RouterController;

$router  = new RouterController;

//rotas error
$router->addRoute('error/error404', 'src/pages/error/error404.php', 'public', null, 'Error 404');
$router->addRoute('error/unauthorized401', 'src/pages/error/unauthorized401.php', 'public', null, 'Unauthorized 401');

//rotas publicas
$router->addRoute('loginAccess', 'src/pages/public/loginForm.php', 'public', null, 'Login');
$router->addRoute('register', 'src/pages/public/register.php', 'public',null, 'Register User');

//token
$token = (isset($_SESSION) && !empty($_SESSION) && !empty($_SESSION['token'])) ? $_SESSION['token'] : null;

//rotas adm
$router->addRoute('adm/home', 'src/pages/adm/homePage.php', 'adm', $token, 'Home');
$router->addRoute('adm/treeMap', 'src/pages/adm/treeMap.php', 'adm', $token,'Tree Map');

$router->route();

?>