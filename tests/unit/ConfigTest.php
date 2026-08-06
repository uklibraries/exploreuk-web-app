<?php

namespace ExploreUK;

use PHPUnit\Framework\TestCase;

final class ConfigTest extends TestCase
{
    protected function setUp(): void
    {
        putenv('APP_ENV=development');
        putenv('SOLR_URL=https://example.com/solr/select');
        putenv('FA_BASE_URL=/fa/findingaid/?id=');
        putenv('DIP_STORE_BASE_URL=/dips');
    }

    protected function tearDown(): void
    {
        putenv('APP_ENV');
        putenv('SOLR_URL');
        putenv('FA_BASE_URL');
        putenv('DIP_STORE_BASE_URL');
    }

    public function testFromEnvReturnsStoredValues(): void
    {
        $config = Config::fromEnv();

        $this->assertSame('development', $config->get('app_env'));
        $this->assertSame('https://example.com/solr/select', $config->get('solr_url'));
        $this->assertSame('/fa/findingaid/?id=', $config->get('fa_base_url'));
        $this->assertSame('/dips', $config->get('dip_store_base_url'));
    }

    public function testGetThrowsOnUnknownKey(): void
    {
        $config = Config::fromEnv();

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Unknown config key: not_a_key');

        $config->get('not_a_key');
    }

    public function testFromEnvThrowsWhenEnvVarIsUnset(): void
    {
        putenv('SOLR_URL');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Critical config field missing: SOLR_URL');

        Config::fromEnv();
    }

    public function testFromEnvThrowsWhenEnvVarIsEmptyString(): void
    {
        putenv('SOLR_URL=');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Critical config field missing: SOLR_URL');

        Config::fromEnv();
    }

    public function testFromEnvThrowsWhenSolrUrlIsAPlaceholderPath(): void
    {
        putenv('SOLR_URL=url/to/solr');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(
            'Config field SOLR_URL must be an absolute http(s) URL, got: url/to/solr'
        );

        Config::fromEnv();
    }

    public function testFromEnvThrowsWhenSolrUrlHasNonHttpScheme(): void
    {
        putenv('SOLR_URL=ftp://example.com/solr');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('must be an absolute http(s) URL');

        Config::fromEnv();
    }

    public function testFromEnvThrowsWhenSolrUrlIsMalformed(): void
    {
        putenv('SOLR_URL=http://');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('must be an absolute http(s) URL');

        Config::fromEnv();
    }

    public function testFromEnvAcceptsSolrUrlWithHostAndPort(): void
    {
        putenv('SOLR_URL=http://localhost:8983/solr');

        $config = Config::fromEnv();

        $this->assertSame('http://localhost:8983/solr', $config->get('solr_url'));
    }

    public function testFromEnvStillAcceptsRelativePathsForOtherFields(): void
    {
        $config = Config::fromEnv();

        $this->assertSame('/fa/findingaid/?id=', $config->get('fa_base_url'));
        $this->assertSame('/dips', $config->get('dip_store_base_url'));
    }

    public function testConstructorAcceptsArrayDirectly(): void
    {
        $config = new Config(['custom_key' => 'custom_value']);

        $this->assertSame('custom_value', $config->get('custom_key'));
    }

    public function testConstructorWithEmptyArrayStillThrowsOnGet(): void
    {
        $config = new Config([]);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Unknown config key: anything');

        $config->get('anything');
    }
}
