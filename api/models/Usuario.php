<?php

namespace app\api\models;

use app\api\models\activeRecord\Model;

class Usuario extends Model {
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
    public function tableName() {
        return 'usuarios';
    }

    public function toApi($params = []) {
        $usuario = [
            'id'    => cryptS($this->id),
            'nome'  => $this->nome,
            'email' => $this->email,
            'cpf'   => $this->cpf,
        ];

        if (!empty($params['completed'])) {
            $usuario['senha'] = $this->senha;
        }

        return $usuario;
    }
}

?>