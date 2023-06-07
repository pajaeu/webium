<?php

namespace App;

class Config
{
    private array $config;

    public function __construct(array $settings)
    {
        $this->config = $settings;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key = ''): mixed
    {
        return (empty($key)) ? $this->config : $this->config[$key];
    }
}