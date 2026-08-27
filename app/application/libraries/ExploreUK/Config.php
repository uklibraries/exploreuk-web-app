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
            'solr_url' => self::ensureUrlEnv('SOLR_URL'),
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

    # For fields that must be URLs rather than site-relative paths.
    private static function ensureUrlEnv(string $key): string
    {
        $value = self::ensureEnv($key);
        $scheme = parse_url($value, PHP_URL_SCHEME);

        if (
            filter_var($value, FILTER_VALIDATE_URL) === false
            || !in_array($scheme, ['http', 'https'], true)
        ) {
            throw new \RuntimeException(
                "Config field $key must be an absolute http(s) URL, got: $value"
            );
        }
        return $value;
    }
}
