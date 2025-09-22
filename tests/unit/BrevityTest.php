<?php

use PHPUnit\Framework\TestCase;
use function ExploreUK\brevity;

final class BrevityTest extends TestCase
{

	public static function setUpBeforeClass(): void
	{
		require_once('/omeka/application/libraries/ExploreUK/definitions.php');
	}

	public function testTruncates(): void
	{
		$this->assertSame("Hello…", brevity("Hello world from the Special Collections Research Center!", 10));
	}
}
