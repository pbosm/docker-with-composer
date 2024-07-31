<?php

namespace app\api\controller;

use app\api\core\Request;
use app\api\models\NumeroRomano;
use Exception;

class NumeroRomanoController {
    public function convertToRoman(Request $request) {
        $request->validate([
            'number'      => 'required|int',
        ]);

        if (!empty($request->errors())) {
            throw new Exception($request->errors()[0]);
        }

        $resultRomano = NumeroRomano::paraRomano($request->number);

        if (!empty($resultRomano)) {
            return $resultRomano;
        }

        return false;
    }

    public function convertToReal(Request $request) {
        $request->validate([
            'romanNumber' => 'required|onlyLetters',
        ]);

        if (!empty($request->errors())) {
            throw new Exception("Deve conter apenas letras");
        }

        $resultNumero = NumeroRomano::paraReal($request->romanNumber);

        if (!empty($resultNumero)) {
            return $resultNumero;
        }

        return false;
    }
}

?>