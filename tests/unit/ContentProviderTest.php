<?php

namespace ExploreUK;

use PHPUnit\Framework\TestCase;

final class ContentProviderTest extends TestCase
{
    private string $fixtureDir;

    protected function setUp(): void
    {
        $this->fixtureDir = sys_get_temp_dir() . '/exploreuk-contentprovider-' . uniqid();
        mkdir($this->fixtureDir . '/data', 0700, true);
    }

    protected function tearDown(): void
    {
        $this->rmdirRecursive($this->fixtureDir);
    }

    public function testPopularResourcesJsonIsValid(): void
    {
        $this->assertAssetJsonIsValid('popular_resources.json');
    }

    public function testAdditionalResourcesJsonIsValid(): void
    {
        $this->assertAssetJsonIsValid('additional_resources.json');
    }

    public function testBackgroundRotationJsonIsValid(): void
    {
        $this->assertAssetJsonIsValid('background_rotation.json');
    }

    public function testDefaultConstructorReadsAssetFiles(): void
    {
        $provider = new ContentProvider(realpath(__DIR__ . '/../../app/assets'));

        $this->assertNotEmpty($provider->popularResources());
        $this->assertNotEmpty($provider->additionalResources());
        $this->assertNotEmpty($provider->getRandomBackgroundImage()['image']);
    }

    // shape and defaults

    public function testPopularResourcesReturnsExpectedShape(): void
    {
        $provider = $this->makeProviderWithData('popular_resources.json', [
            'data' => [
                ['image' => '/img/a.jpg', 'label' => 'Alpha', 'url' => '/a'],
                ['image' => '/img/b.jpg', 'label' => 'Beta', 'url' => '/b'],
            ],
        ]);

        $result = $provider->popularResources();

        $this->assertCount(2, $result);
        $this->assertSame(['image' => '/img/a.jpg', 'label' => 'Alpha', 'url' => '/a'], $result[0]);
        $this->assertSame(['image' => '/img/b.jpg', 'label' => 'Beta', 'url' => '/b'], $result[1]);
    }

    public function testPopularResourcesAppliesDefaultsForMissingFields(): void
    {
        $provider = $this->makeProviderWithData('popular_resources.json', [
            'data' => [['label' => 'No URL or Image']],
        ]);

        $result = $provider->popularResources();

        $this->assertSame('', $result[0]['image']);
        $this->assertSame('No URL or Image', $result[0]['label']);
        $this->assertSame('#', $result[0]['url']);
    }

    public function testAdditionalResourcesIncludesDescription(): void
    {
        $provider = $this->makeProviderWithData('additional_resources.json', [
            'data' => [
                ['label' => 'X with desc', 'description' => 'about X'],
                ['label' => 'Y no desc'],
            ],
        ]);

        $result = $provider->additionalResources();

        $this->assertSame('about X', $result[0]['description']);
        $this->assertSame('', $result[1]['description']);
    }

    public function testGetRandomBackgroundImageReturnsSingleDict(): void
    {
        $provider = $this->makeProviderWithData('background_rotation.json', [
            'data' => [
                ['image' => '/bg1.jpg', 'label' => 'BG1', 'url' => '/1'],
            ],
        ]);

        $result = $provider->getRandomBackgroundImage();

        $this->assertArrayHasKey('image', $result);
        $this->assertArrayHasKey('label', $result);
        $this->assertArrayHasKey('url', $result);
        $this->assertIsString($result['image']);
    }

    // graceful degradation

    public function testPopularResourcesReturnsEmptyArrayWhenFileMissing(): void
    {
        $provider = new ContentProvider($this->fixtureDir);

        $this->assertSame([], $provider->popularResources());
    }

    public function testPopularResourcesReturnsEmptyArrayOnMalformedJson(): void
    {
        file_put_contents(
            $this->fixtureDir . '/data/popular_resources.json',
            '{"not_valid',
        );
        $provider = new ContentProvider($this->fixtureDir);

        $this->assertSame([], $provider->popularResources());
    }

    public function testGetRandomBackgroundImageReturnsEmptyShapeWhenFileMissing(): void
    {
        $provider = new ContentProvider($this->fixtureDir);

        $this->assertSame(
            ['image' => '', 'label' => '', 'url' => '#'],
            $provider->getRandomBackgroundImage(),
        );
    }

    // helpers
    private function assertAssetJsonIsValid(string $filename): void
    {
        $path = realpath(__DIR__ . '/../../app/assets/data/' . $filename);
        $this->assertNotFalse($path, "$filename not found");

        $data = json_decode(
            file_get_contents($path),
            true,
            512,
            JSON_THROW_ON_ERROR,
        );

        $this->assertIsArray($data['data'] ?? null, "$filename must have a \"data\" array");
    }

    private function makeProviderWithData(string $filename, array $data): ContentProvider
    {
        file_put_contents(
            $this->fixtureDir . '/data/' . $filename,
            json_encode($data),
        );
        return new ContentProvider($this->fixtureDir);
    }

    private function rmdirRecursive(string $dir): void
    {
        if (!is_dir($dir)) {
            return;
        }
        foreach (scandir($dir) as $entry) {
            if ($entry === '.' || $entry === '..') {
                continue;
            }
            $path = $dir . '/' . $entry;
            if (is_dir($path)) {
                $this->rmdirRecursive($path);
            } else {
                unlink($path);
            }
        }
        rmdir($dir);
    }
}
