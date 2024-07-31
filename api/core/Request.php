<?php

namespace app\api\core;

use Exception;

class Request extends Validator
{
    protected $controller;
    protected $request;
    protected $attributes = [];
    protected $headers;
    protected $server;

    public function __construct()
    {
        $this->headers = getallheaders() ?? [];
        $this->server  = $_SERVER ?? [];

        switch ($this->method()) {
            case 'GET':
                $this->request = $_GET ?? [];
                break;
            case 'POST':
                $this->request = $_POST ?? [];
                break;
            case 'PUT':
            case 'DELETE':
                $this->request = parseInput();
                break;
            default:
                $this->request = [];
                break;
        }

        $this->controller = $this->request['function'];
        unset($this->request['function']);

        $this->attributes = $this->request;
    }

    public function header($key, $default = null)
    {
        $key = str_replace(' ', '-', ucwords(str_replace('-', ' ', $key)));
        return $this->headers[$key] ?? $default;
    }

    public function only($keys)
    {
        $result = [];

        foreach ((array) $keys as $key) {
            if (array_key_exists($key, $this->attributes)) {
                $result[$key] = $this->attributes[$key];
            }
        }

        return $result;
    }

    public function all()
    {
        return $this->attributes;
    }

    public function method()
    {
        return $this->server['REQUEST_METHOD'] ?? null;
    }

    public function uri()
    {
        return $this->server['REQUEST_URI'] ?? null;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        } else {
            return null; //para validar com empty as requisições que vem do front, caso contrario, sempre vai dizer que propriedade não existe
        }
    }

    public function __isset($name) {
        $this->__get($name);

        return array_key_exists($name, $this->attributes);
    }
}