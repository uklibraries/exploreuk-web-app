<?php

namespace ExploreUK;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class ExploreUKTest extends TestCase
{
    # [
    #   explanation of scenario => [
    #     dipStoreUrl,
    #     fixtureSolrValue,
    #     expectedUrl,
    #   ]
    # ]
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
        ];
    }

    #[DataProvider('dipStoreUrlProvider')]
    public function testCleanupHostUsesConfiguredDipStoreBaseUrl(
        string $dipStoreUrl,
        string $fixtureSolrValue,
        string $expectedUrl,
    ): void {
        $exploreUk = $this->makeExploreUk($dipStoreUrl);

        $this->assertSame($expectedUrl, $exploreUk->cleanupHost($fixtureSolrValue));
    }

    # [
    #   explanation of scenario => [
    #     faBaseUrl,
    #     fixtureSolrValue,
    #     expectedUrl,
    #   ]
    # ]
    public static function faBaseUrlProvider(): array
    {
        return [
            'same base url, exploreuk host' => [
                '/fa/findingaid/?id=',
                'https://exploreuk.uky.edu/fa/findingaid/?id=abc',
                '/fa/findingaid/?id=abc',
            ],
            'differing base url, exploreuk host' => [
                '/review/euk-118/fa/findingaid/?id=',
                'https://exploreuk.uky.edu/fa/findingaid/?id=abc',
                '/review/euk-118/fa/findingaid/?id=abc',
            ],
            'same base url, nyx host' => [
                '/fa/findingaid/?id=',
                'https://nyx.uky.edu/fa/findingaid/?id=abc',
                '/fa/findingaid/?id=abc',
            ],
            'differing base url, nyx host' => [
                '/review/euk-118/fa/findingaid/?id=',
                'https://nyx.uky.edu/fa/findingaid/?id=abc',
                '/review/euk-118/fa/findingaid/?id=abc',
            ],
        ];
    }

    #[DataProvider('faBaseUrlProvider')]
    public function testCleanupHostRebuildsFindingAidUrlsFromConfig(
        string $faBaseUrl,
        string $fixtureSolrValue,
        string $expectedUrl,
    ): void {
        $exploreUk = $this->makeExploreUk('/dips/', faBaseUrl: $faBaseUrl);

        $this->assertSame(
            $expectedUrl,
            $exploreUk->cleanupHost($fixtureSolrValue),
        );
    }

    # characterization tests; if we change behavior, these tests will fail
    # [
    #   explanation of scenario => [
    #     fixtureSolrValue,
    #     expectedValue
    #   ]
    # ]
    public static function unrecognizedValueProvider(): array
    {
        return [
            'outside host is left unchanged' => [
                'https://alternative.test/fa/findingaid/?id=abc',
                'https://alternative.test/fa/findingaid/?id=abc',
            ],
            'unknown path on exploreuk host is left unchanged' => [
                'https://exploreuk.uky.edu/malformed/baseUrl/?id=abc',
                'https://exploreuk.uky.edu/malformed/baseUrl/?id=abc',
            ],
            'unknown path on nyx host only has its host rewritten' => [
                'https://nyx.uky.edu/malformed/baseUrl/?id=abc',
                'https://exploreuk.uky.edu/malformed/baseUrl/?id=abc',
            ],
            'plain text is left unchanged' => [
                'University of Kentucky Chemistry Department',
                'University of Kentucky Chemistry Department',
            ],
        ];
    }

    #[DataProvider('unrecognizedValueProvider')]
    public function testCleanupHostKeepsPathsOfUnrecognizedValues(
        string $fixtureSolrValue,
        string $expectedValue,
    ): void {
        $exploreUk = $this->makeExploreUk('/dips/');

        $this->assertSame($expectedValue, $exploreUk->cleanupHost($fixtureSolrValue));
    }

    public function testCleanupDocUsesConfiguredDipStoreForEveryEnvironment(): void
    {
        $exploreUk = $this->makeExploreUk('/dipstest/');
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
        string $faBaseUrl = '/fa/findingaid/?id=',
    ): ExploreUK {
        $config = new Config([
            'app_env' => $appEnv,
            'solr_url' => 'https://example.com/solr/select',
            'fa_base_url' => $faBaseUrl,
            'dip_store_base_url' => $dipStoreBaseUrl,
        ]);

        return new ExploreUK($config, __DIR__);
    }
}
