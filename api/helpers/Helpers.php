<?php

use app\api\controller\InstanceController;

define('HASH1', '$%m#XoQkVc65');
define('HASH2', '9Ed*J7Icx!2K');
define('HASH3', 'Oa3&K^2a0SZY');
define('HASH4', '1p%m2VjHinCS');

function cryptS($string)
{
    $hash1 = md5(HASH1);
    $hash2 = md5(HASH2);
    $hash3 = md5(HASH3);
    $hash4 = md5(HASH4);

    $string = base64_encode($string);

    $count1 = strlen($string);
    $count2 = intval($count1 / 2);

    $split1 = substr($string, 0, $count2);
    $split2 = substr($string, $count2, $count1);

    return substr($hash1, 0, 8) . $split1 . substr($hash2, 0, 4) . substr($hash3, 0, 4) . $split2 . substr($hash4, 0, 8);
}

function descryptS($string)
{
    // $string = is_object($string) ? $string->scalar : $string; se api for como object

    $hash1 = md5(HASH1);
    $hash2 = md5(HASH2);
    $hash3 = md5(HASH3);
    $hash4 = md5(HASH4);

    $string = str_replace(substr($hash1, 0, 8), '', $string);
    $string = str_replace(substr($hash2, 0, 4), '', $string);
    $string = str_replace(substr($hash3, 0, 4), '', $string);
    $string = str_replace(substr($hash4, 0, 8), '', $string);

    return base64_decode($string);
}

function verifyCPF($cpf)
{
    $cpf = preg_replace('/[^0-9]/is', '', $cpf);

    if (strlen($cpf) != 11) {
        return false;
    }

    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

// Limpa uma string (remove caracteres especiais)
function clearString($string)
{
    $string = str_replace('(', '', $string);
    $string = str_replace(')', '', $string);
    $string = str_replace('.', '', $string);
    $string = str_replace('/', '', $string);
    $string = str_replace('-', '', $string);
    $string = str_replace(' ', '', $string);

    return $string;
}

function parseInput() {
    $input = file_get_contents('php://input');
    parse_str($input, $putVars);

    return $putVars;
}

function parseInputClassName() {
    $input = file_get_contents('php://input');
    parse_str($input, $putVars);

    if (empty($putVars['function'])) {
//        throw new Exception("Function não existe");
        return false;
    }

    return $putVars['function'];
}

function retiredBearer($header) {
    if (strpos($header, 'Bearer ') === 0) {
        return substr($header, 7);
    }

    return null;
}

?>