<?php

namespace app\api\controller;

use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use DomainException;
use InvalidArgumentException;
use UnexpectedValueException;

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use Dotenv\Dotenv;
use Exception;

class JWTAuthenticationController
{
    //key é vazia pq ele pega do dontenv
    private $key = '';

    public function __construct($key = null)
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();
        
        $this->key = !empty($key) ? $key : $_ENV['KEY'];
    }

    public function generateToken($payload, $alg)
    {
        $this->token = JWT::encode($payload, $this->key, $alg);

        return JWT::encode($payload, $this->key, $alg);
    }

    public function decodeToken($token)
    {
        if (empty($token)) {
            $logout = InstanceController::app()->UsuarioService->logout();

            return false;
        }

        try {
            return JWT::decode($token, new Key($this->key, 'HS256'));
        } catch (Exception $e) {

            return false;
        }
    }

    public function decodeTokenWithMsg($token) {
        if (empty($token)) {
            return false;
        }

        try {
            return JWT::decode($token, new Key($this->key, 'HS256'));
        } catch (InvalidArgumentException $e) {
            // Token fornecido é inválido
            return "InvalidArgumentException: " . $e->getMessage();
        } catch (DomainException $e) {
            // Algoritmo fornecido não é suportado ou chave fornecida é inválida
            return "DomainException: " . $e->getMessage();
        } catch (SignatureInvalidException $e) {
            // A verificação da assinatura do JWT fornecido falhou
            return "SignatureInvalidException: " . $e->getMessage();
        } catch (BeforeValidException $e) {
            // JWT fornecido está sendo usado antes da "nbf" ou "iat" claim
            return "BeforeValidException: " . $e->getMessage();
        } catch (ExpiredException $e) {
            // JWT fornecido está sendo usado após a "exp" claim
            return "ExpiredException: " . $e->getMessage();
        } catch (UnexpectedValueException $e) {
            // JWT fornecido está malformado ou faltando algoritmo/suporte
            return "UnexpectedValueException: " . $e->getMessage();
        }
    }
}

?>
