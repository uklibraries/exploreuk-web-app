<?php

namespace ExploreUK;

use PHPUnit\Framework\TestCase;

final class RenderTest extends TestCase
{
    private function render($extref): string
    {
        return fa_render_string("<p>$extref</p>");
    }

    public function testExtrefStaysInTheSameTabByDefault(): void
    {
        $html = $this->render('<extref href="https://example.org/">the guide</extref>');

        $this->assertStringContainsString('<span class="show-for-sr">(external link)</span>', $html);
        $this->assertStringNotContainsString('target="_blank"', $html);
    }

    public function testExtrefOptsIntoANewTabWithShowNew(): void
    {
        $html = $this->render('<extref href="https://example.org/" show="new">the guide</extref>');

        $this->assertStringContainsString('target="_blank"', $html);
        $this->assertStringContainsString('rel="noopener noreferrer"', $html);
        $this->assertStringContainsString(
            '<span class="show-for-sr">(external link, opens in a new tab)</span>',
            $html
        );
    }

    /* show="replace" is XLink for "stay here", and any value the spec leaves
     * unconstrained should fail safe the same way.
     */
    public function testOnlyShowNewOpensANewTab(): void
    {
        foreach (['replace', 'embed', 'other', 'none', 'nonsense'] as $show) {
            $html = $this->render("<extref href=\"https://example.org/\" show=\"$show\">the guide</extref>");
            $this->assertStringNotContainsString('target="_blank"', $html, "show=\"$show\" opened a new tab");
        }
    }

    public function testExtrefWithoutLinkTextRendersNothing(): void
    {
        $html = $this->render('<extref actuate="onLoad" show="embed" href="http://example.org/seal.gif"/>');

        $this->assertSame('', $html);
    }

    public function testExtrefWithoutHrefFallsBackToItsText(): void
    {
        $html = $this->render('<extref>text only</extref>');

        $this->assertSame('text only', $html);
        $this->assertStringNotContainsString('<a ', $html);
    }

    public function testHrefAndTextFromTheEadAreEscaped(): void
    {
        $html = $this->render('<extref href="https://example.org/?a=1&amp;b=&quot;x&quot;">Smith &amp; Co</extref>');

        $this->assertStringContainsString('href="https://example.org/?a=1&amp;b=&quot;x&quot;"', $html);
        $this->assertStringContainsString('Smith &amp; Co', $html);
    }
}
