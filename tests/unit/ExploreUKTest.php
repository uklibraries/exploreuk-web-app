<?php

namespace ExploreUK;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class ExploreUKTest extends TestCase
{
    #[DataProvider('dipStoreUrlProvider')]
    public function testCleanupHostUsesConfiguredDipStoreBaseUrl(
        string $configuredBaseUrl,
        string $sourceUrl,
        string $expectedUrl,
    ): void {
        $exploreUk = $this->makeExploreUk($configuredBaseUrl);

        $this->assertSame($expectedUrl, $exploreUk->cleanupHost($sourceUrl));
    }

    public static function dipStoreUrlProvider(): array
    {
        return [
            'preview converts production path' => [
                '/dipstest/',
                'https://nyx.uky.edu/dips/abc/data/image.jpg',
                'https://exploreuk.uky.edu/dipstest/abc/data/image.jpg',
            ],
            'production converts preview path' => [
                '/dips/',
                'https://nyx.uky.edu/dipstest/abc/data/image.jpg',
                'https://exploreuk.uky.edu/dips/abc/data/image.jpg',
            ],
            'missing configured trailing slash is normalized' => [
                '/dipstest',
                'https://nyx.uky.edu/dips/abc/data/image.jpg',
                'https://exploreuk.uky.edu/dipstest/abc/data/image.jpg',
            ],
            'unrelated path is preserved' => [
                '/dipstest/',
                'https://nyx.uky.edu/fa/findingaid/?id=abc',
                'https://exploreuk.uky.edu/fa/findingaid/?id=abc',
            ],
        ];
    }

    public function testCleanupDocUsesConfiguredDipStoreForEveryEnvironment(): void
    {
        $exploreUk = $this->makeExploreUk('/dipstest/', 'production');
        $doc = [
            'image' => 'https://nyx.uky.edu/dips/abc/image.jpg',
            'pages' => [
                'https://nyx.uky.edu/dips/abc/page-1.jpg',
                'https://nyx.uky.edu/dips/abc/page-2.jpg',
            ],
            'sequence' => 1,
        ];

        $this->assertSame(
            [
                'image' => 'https://exploreuk.uky.edu/dipstest/abc/image.jpg',
                'pages' => [
                    'https://exploreuk.uky.edu/dipstest/abc/page-1.jpg',
                    'https://exploreuk.uky.edu/dipstest/abc/page-2.jpg',
                ],
                'sequence' => 1,
            ],
            $exploreUk->cleanupDoc($doc),
        );
    }

    private function makeExploreUk(
        string $dipStoreBaseUrl,
        string $appEnv = 'development',
    ): ExploreUK {
        $config = new Config([
            'app_env' => $appEnv,
            'solr_url' => 'https://example.com/solr/select',
            'fa_base_url' => '/fa/findingaid/?id=',
            'dip_store_base_url' => $dipStoreBaseUrl,
        ]);

        return new ExploreUK($config, __DIR__);
    }
}
