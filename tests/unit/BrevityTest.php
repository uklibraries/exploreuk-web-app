<?php

use PHPUnit\Framework\TestCase;

use function ExploreUK\brevity;

final class BrevityTest extends TestCase
{
    public function testTruncates(): void
    {
        $this->assertSame("Hello…", brevity("Hello world from the Special Collections Research Center!", 10));
    }
}
