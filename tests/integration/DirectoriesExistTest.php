<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class DirectoriesExistTest extends TestCase
{
    public function testAppDirectoryExists(): void
    {
        $this->assertDirectoryExists('/app', 'Expected /app directory to exist in the container');
    }

    public function testOmekaDirectoryExists(): void
    {
        $this->assertDirectoryExists('/omeka', 'Expected /omeka directory to exist in the container');
    }
}
