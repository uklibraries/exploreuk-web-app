<?php

namespace ExploreUK;

readonly class Config
{
    public function __construct(private array $config)
    {
    }

    public static function fromEnv(): self
    {
        return new self([
            'app_env' => self::ensureEnv('APP_ENV'),
            'solr_url' => self::ensureEnv('SOLR_URL'),
            'fa_base_url' => self::ensureEnv('FA_BASE_URL'),
            'dip_store_base_url' => self::ensureEnv('DIP_STORE_BASE_URL'),
        ]);
    }

    public function get(string $key): string
    {
        if (!array_key_exists($key, $this->config)) {
            throw new \RuntimeException("Unknown config key: $key");
        }
        return $this->config[$key];
    }

    private static function ensureEnv(string $key): string
    {
        $value = getenv($key);

        if ($value === false || $value === "") {
            throw new \RuntimeException("Critical config field missing: $key");
        }
        return $value;
    }
}
