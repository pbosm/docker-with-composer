<?php

namespace app\api\models;

use app\api\models\activeRecord\Model;

class NumeroRomano extends Model {
    private static $numerosRomanos = [
        1000    => 'M', 
        900     => 'CM',
        500     => 'D',
        400     => 'CD',
        100     => 'C',
        90      => 'XC',
        50      => 'L',
        40      => 'XL',
        10      => 'X',
        9       => 'IX',
        5       => 'V',
        4       => 'IV',
        1       => 'I'
    ];

    public function tableName() {
        return 'numero_romano';
    }

    public static function paraRomano(int $numero)
    {
        if ($numero < 1 || $numero > 1000) {
            throw new \InvalidArgumentException("Número fora do intervalo suportado (1 a 1.000).");
        }

        $resultado = '';

        foreach (self::$numerosRomanos as $valor => $simbolo) {
            while ($numero >= $valor) {
                $resultado .= $simbolo;
                $numero -= $valor;
            }
        }

        return $resultado;
    }

    public static function paraReal(string $romano)
    {
        $romano  = strtoupper($romano);
        $romanos = array_flip(self::$numerosRomanos);
        $tamanho = strlen($romano);
        $resultado = 0;
        $i = 0;

        for ($j = 0; $j < $tamanho; $j++) {
            if (!isset($romanos[$romano[$j]])) {
                throw new \InvalidArgumentException("Símbolo romano inválido: {$romano[$j]}. Favor preencher um valor entre o intervalo suportado (1 a 1.000).");
            }
        }

        while ($i < $tamanho) {
            $simboloAtual = $romano[$i];

            $valorAtual = $romanos[$simboloAtual];

            if ($i + 1 < $tamanho) {
                $simboloProximo = $romano[$i + 1];
                $valorProximo = $romanos[$simboloProximo];

                if ($valorAtual < $valorProximo) {
                    $resultado += $valorProximo - $valorAtual;
                    $i += 2;
                } else {
                    $resultado += $valorAtual;
                    $i++;
                }
            } else {
                $resultado += $valorAtual;
                $i++;
            }
        }

        if ($resultado < 1 || $resultado > 1000) {
            throw new \InvalidArgumentException("Número fora do intervalo suportado (1 a 1.000).");
        }

        return $resultado;
    }
}

?>
