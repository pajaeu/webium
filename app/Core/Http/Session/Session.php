<?php

namespace App\Core\Http\Session;

class Session
{

    public function init()
    {
        session_set_cookie_params([
            'lifetime' => $_ENV['SESSION_LIFETIME'],
            'secure' => $_ENV['SESSION_SECURE'],
            'httponly' => $_ENV['SESSION_HTTPONLY'],
            'samesite' => $_ENV['SESSION_SAMESITE'],
        ]);

        session_name($_ENV['SESSION_NAME']);

        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function get(string $key): mixed
    {
        if (!$this->has($key)){
            return null;
        }

        return $_SESSION[$key];
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $_SESSION);
    }

    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function put(string $key, mixed $value): void
    {
        $_SESSION[$key][] = $value;
    }

    public function delete(string $key): void
    {
        unset($_SESSION[$key]);
    }
}