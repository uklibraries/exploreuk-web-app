<?php

namespace ExploreUK;

use PHPUnit\Framework\TestCase;

final class ContentProviderTest extends TestCase
{
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
        $provider = new ContentProvider();

        $this->assertNotEmpty($provider->popularResources());
        $this->assertNotEmpty($provider->additionalResources());
        $this->assertNotEmpty($provider->getRandomBackgroundImage()['image']);
    }

    // helpers
    private function assertAssetJsonIsValid(string $filename): void
    {
        $path = realpath(__DIR__ . '/../../app/themes/assets/' . $filename);
        $this->assertNotFalse($path, "$filename not found");

        $data = json_decode(
            file_get_contents($path),
            true,
            512,
            JSON_THROW_ON_ERROR,
        );

        $this->assertIsArray($data['data'] ?? null, "$filename must have a \"data\" array");
    }
}
