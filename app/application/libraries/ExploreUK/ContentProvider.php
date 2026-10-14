<?php

namespace ExploreUK;

class ContentProvider
{
    public function __construct(private string $assetsDir, private Config $config)
    {
    }

    public function popularResources(): array
    {
        return array_map(
            fn (array $item): array => [
                'image' => $item['image'] ?? '',
                'label' => $item['label'] ?? '',
                'url' => $item['url'] ?? '#',
            ],
            $this->load('popular_resources.json'),
        );
    }

    public function additionalResources(): array
    {
        return array_map(
            fn (array $item): array => [
                'image' => $item['image'] ?? '',
                'label' => $item['label'] ?? '',
                'url' => $item['url'] ?? '#',
                'description' => $item['description'] ?? '',
            ],
            $this->load('additional_resources.json'),
        );
    }

    public function getRandomBackgroundImage(): array
    {
        $items = $this->load('background_rotation.json');
        $item = $items ? $items[array_rand($items)] : [];
        return [
            'image' => $item['image'] ?? '',
            'label' => $item['label'] ?? '',
            'url' => $item['url'] ?? '#',
        ];
    }

    // helpers
    private function load(string $name): array
    {
        $path = $this->assetsDir . '/data/' . $name;
        if (!file_exists($path)) {
            error_log("Missing site asset: $path");
            return [];
        }
        try {
            $data = json_decode(
                file_get_contents($path),
                true,
                512,
                JSON_THROW_ON_ERROR,
            );
            return array_map(function (array $item): array {
                foreach (['image', 'url'] as $key) {
                    if (isset($item[$key])) {
                        $item[$key] = $this->config->path($item[$key]);
                    }
                }
                return $item;
            }, $data['data'] ?? []);
        } catch (\JsonException $e) {
            error_log("Invalid JSON in $path: " . $e->getMessage());
            return [];
        }
    }
}
