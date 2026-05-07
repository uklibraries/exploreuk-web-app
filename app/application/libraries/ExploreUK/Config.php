<?php

namespace ExploreUK;

class Config
{
    private array $config;

    public function __construct()
    {
        $this->config = [
            'app_env' => $this->ensureEnv('APP_ENV'),
            'solr_url' => $this->ensureEnv('SOLR_URL'),
            'fa_base_url' => $this->ensureEnv('FA_BASE_URL'),
            'dip_store_base_url' => $this->ensureEnv('DIP_STORE_BASE_URL')
        ];
    }

    public function get(string $key): string
    {
        if (!array_key_exists($key, $this->config)) {
            throw new \RuntimeException("Unknown config key: $key");
        }
        return $this->config[$key];
    }

    private function ensureEnv(string $key): string
    {
        $value = getenv($key);

        if ($value === false || $value === "") {
            throw new \RuntimeException("Critical config field missing: $key");
        }
        return $value;
    }
}
