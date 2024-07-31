<?php

namespace app\api\core;

class Validator
{
    protected $errors = [];

    public function validate(array $rules) {
        foreach ($rules as $field => $ruleSet) {
            $rulesArray = explode('|', $ruleSet);

            foreach ($rulesArray as $rule) {
                $ruleParts = explode(':', $rule);

                $ruleName = $ruleParts[0];

                $ruleParams = isset($ruleParts[1]) ? explode(',', $ruleParts[1]) : [];

                $this->applyRule($field, $ruleName, $ruleParams);
            }
        }

        return $this;
    }

    protected function applyRule($field, $ruleName, $ruleParams) {
        $value = $this->attributes[$field] ?? null;
        $field = ucfirst($field);

        switch ($ruleName) {
            case 'required':
                if (empty($value)) {
                    $this->errors[$field][] = "$field é obrigatório.";
                }
                break;
            case 'string':
                if (!is_string($value)) {
                    $this->errors[$field][] = "$field deve ser uma string.";
                }
                break;
            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->errors[$field][] = "$field deve ser um email válido.";
                }
                break;
            case 'max':
                if (strlen($value) > $ruleParams[0]) {
                    $this->errors[$field][] = "$field não pode ter mais que {$ruleParams[0]} caracteres.";
                }
                break;
            case 'min':
                if (strlen($value) < $ruleParams[0]) {
                    $this->errors[$field][] = "$field deve ter pelo menos {$ruleParams[0]} caracteres.";
                }
                break;
            case 'cpf':
                if (!$this->validateCPF($value)) {
                    $this->errors[$field][] = "$field deve ser um CPF válido.";
                }
                break;
            case 'int':
                if (filter_var($value, FILTER_VALIDATE_INT) === false) {
                    $this->errors[$field][] = "$field deve ser um número inteiro.";
                }
                break;
            case 'onlyLetters':
                if (!preg_match('/^[a-zA-Z]+$/', $value)) {
                    $this->errors[$field][] = "$field deve conter apenas letras.";
                }
                break;
            default:
                $this->errors[$field][] = "Regra de validação desconhecida: $ruleName";
                break;
        }
    }

    protected function validateCPF($cpf) {
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

    public function errors() {
        $allErrors = [];

        foreach ($this->errors as $field => $messages) {
            foreach ($messages as $message) {
                $allErrors[] = $message;
            }
        }

        return $allErrors;
    }

    public function passes() {
        return empty($this->errors);
    }
}