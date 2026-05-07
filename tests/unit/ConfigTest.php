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

    public function testGetReturnsStoredValues(): void
    {
        $config = new Config();

        $this->assertSame('development', $config->get('app_env'));
        $this->assertSame('https://example.com/solr/select', $config->get('solr_url'));
        $this->assertSame('/fa/findingaid/?id=', $config->get('fa_base_url'));
        $this->assertSame('/dips', $config->get('dip_store_base_url'));
    }

    public function testGetThrowsOnUnknownKey(): void
    {
        $config = new Config();

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Unknown config key: not_a_key');

        $config->get('not_a_key');
    }

    public function testConstructorThrowsWhenEnvVarIsUnset(): void
    {
        putenv('SOLR_URL');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Critical config field missing: SOLR_URL');

        new Config();
    }

    public function testConstructorThrowsWhenEnvVarIsEmptyString(): void
    {
        putenv('SOLR_URL=');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Critical config field missing: SOLR_URL');

        new Config();
    }
}
