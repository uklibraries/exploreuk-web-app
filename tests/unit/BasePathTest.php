<?php

namespace ExploreUK;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class BasePathTest extends TestCase
{
    public static function bases(): array
    {
        return ['root' => [''], 'acceptance' => ['/review/euk-118']];
    }

    private function config(string $base): Config
    {
        return new Config([
            'app_base_path' => $base,
            'solr_url' => 'https://example.test/solr',
            'fa_base_url' => $base . '/fa/findingaid/?id=',
            'dip_store_base_url' => '/dips/',
        ]);
    }

    private function capture(callable $render): string
    {
        ob_start();
        try {
            $render();
            return ob_get_contents();
        } finally {
            ob_end_clean();
        }
    }

    // Every root-relative href, src and action must start with the base, exactly once.
    private function assertNoUnprefixedUrls(string $base, string $html): void
    {
        preg_match_all('/(?:href|src|action)="(\/(?!\/)[^"]*)"/', $html, $matches);
        $this->assertNotEmpty($matches[1]);
        foreach ($matches[1] as $url) {
            $this->assertStringStartsWith($base . '/', $url);
            if ($base !== '') {
                $this->assertStringStartsNotWith($base . $base, $url);
            }
        }
    }

    #[DataProvider('bases')]
    public function testHomePage(string $base): void
    {
        $_SERVER['QUERY_STRING'] = '';
        $app = new ExploreUK($this->config($base), EUK_BASE_DIR . '/assets');

        $this->assertNoUnprefixedUrls($base, $this->capture(fn () => $app->index()));
    }

    #[DataProvider('bases')]
    public function testSearchResults(string $base): void
    {
        $_SERVER['QUERY_STRING'] = 'q=history';
        $app = new ExploreUK($this->config($base), EUK_BASE_DIR . '/assets');

        // pre-fill an extension of Query with fake data, so we don't have to touch real Solr
        $query = new class extends Query {
            public function search()
            {
                return [
                    'response' => ['numFound' => 40, 'docs' => [
                        ['id' => 'abc', 'title_display' => 'History', 'format' => 'books'],
                    ]],
                    'facet_counts' => ['facet_fields' => array_replace(
                        array_fill_keys(EUK_FACETS, []),
                        ['format' => ['books', 30, 'images', 10]],
                    )],
                ];
            }

            public function getFacetsByCount()
            {
                return $this->search();
            }

            public function getFacetsByIndex()
            {
                return $this->search();
            }
        };
        // swap in the fake Query class created above
        (new \ReflectionProperty(ExploreUK::class, 'query'))->setValue($app, $query);

        $this->assertNoUnprefixedUrls($base, $this->capture(fn () => $app->index()));
    }

    #[DataProvider('bases')]
    public function testBookViewer(string $base): void
    {
        $_SERVER['QUERY_STRING'] = '';
        $app = new class ($this->config($base), EUK_BASE_DIR . '/assets') extends ExploreUK {
            public function pages($id)
            {
                return [['id' => $id . '_1', 'reference_image_url_s' => ['https://content.example.test/page.jpg']]];
            }
        };
        $html = $this->capture(fn () => $app->embedPagedViewer('abc'));

        $this->assertNoUnprefixedUrls($base, $html);
        // URLs handed to JavaScript are not attributes, so check them directly.
        $this->assertStringContainsString(json_encode($base . '/catalog/abc/find'), $html);
        $this->assertStringContainsString(json_encode($base . '/assets/BookReader/images/'), $html);
        $this->assertStringContainsString('var appHome = ' . json_encode($base . '/') . ';', $html);

        // Asset versions hash files on disk, which never live beneath the prefix.
        $file = 'BookReaderDemo/BookReaderJSmod.js';
        $view = new View(['query' => new Query()], 'paged', $this->config($base));
        $this->assertSame(
            'sha384-' . base64_encode(hash_file('sha384', EUK_BASE_DIR . '/assets/' . $file, true)),
            $view->assetVersion($file),
        );
    }

    #[DataProvider('bases')]
    public function testItemViewers(string $base): void
    {
        $_SERVER['QUERY_STRING'] = '';
        $_SERVER['HTTP_HOST'] = 'acceptance.example.test';
        $app = new class ($this->config($base), EUK_BASE_DIR . '/assets') extends ExploreUK {
            public string $format = 'images';

            public function document($id)
            {
                return $this->cleanupDoc([
                    'id' => $id,
                    'title_display' => 'Example item',
                    'format' => $this->format,
                    'type_display' => ['Still image'],
                    'compound_object_split_b' => true,
                    'object_type_s' => ['item'],
                    'reference_image_url_s' => ['https://nyx.uky.edu/dips/abc/image.jpg'],
                    'front_thumbnail_url_s' => ['https://nyx.uky.edu/dips/abc/thumb.jpg'],
                    'reference_image_width_s' => [800],
                    'reference_image_height_s' => [600],
                    'reference_audio_url_s' => ['https://nyx.uky.edu/dips/abc/audio.mp3'],
                    'reference_video_url_s' => ['https://nyx.uky.edu/dips/abc/video.mp4'],
                    'text_s' => ['Example text'],
                    'object_id_s' => ['abc'],
                    'source_s' => ['Example collection'],
                    'finding_aid_url_s' => ['https://nyx.uky.edu/fa/findingaid/?id=abc'],
                ]);
            }
        };

        $formats = ['images', 'books', 'audio', 'audiovisual'];
        foreach ($formats as $format) {
            $app->format = $format;
            $html = $this->capture(fn () => $app->pageViewer('abc'));

            $this->assertNoUnprefixedUrls($base, $html);
            $this->assertStringContainsString('href="' . $base . '/fa/findingaid/?id=abc"', $html);
            // Content comes from the DIP store, never from beneath the prefix.
            $this->assertDoesNotMatchRegularExpression('#["\']' . preg_quote($base, '#') . '/dips/#', $html);
        }
    }

    #[DataProvider('bases')]
    public function testOaiBaseUrl(string $base): void
    {
        class_exists(Oai::class); // loads Oai.php, which defines oai_base()
        $GLOBALS['oai_host_options'] = ['host' => 'example.test', 'base_path' => $base];

        $this->assertSame('https://example.test' . $base . '/catalog/oai', oai_base());
    }

    protected function tearDown(): void
    {
        unset($_SERVER['QUERY_STRING'], $_SERVER['HTTP_HOST']);
        unset($GLOBALS['oai_host_options']);
    }
}
