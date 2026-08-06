<?php

namespace ExploreUK;

use PHPUnit\Framework\TestCase;

final class ViewTest extends TestCase
{
    private View $view;

    private const ICON = '<span class="ic ic--popup" aria-hidden="true"></span>';

    protected function setUp(): void
    {
        $this->view = new View(['query' => null], 'about');
    }

    public function testPlainLinkGetsNoIconAndNoAnnouncement(): void
    {
        $link = $this->view->renderLink([
            'href' => '/catalog/xt123',
            'content' => 'collection guide',
        ]);

        $this->assertSame(
            '<a class="underline-link" href="/catalog/xt123">collection guide</a>',
            $link
        );
    }

    public function testNewTabIsAnnouncedWithoutAnExternalIcon(): void
    {
        $link = $this->view->renderLink([
            'href' => 'https://example.org',
            'content' => 'Example',
            'open_new_tab' => true,
        ]);

        $this->assertStringContainsString('<span class="show-for-sr">(opens in a new tab)</span>', $link);
        $this->assertStringNotContainsString(self::ICON, $link);
    }

    public function testExternalIsAnnouncedAndIconIsHiddenFromAssistiveTech(): void
    {
        $link = $this->view->renderLink([
            'href' => '/catalog/xt123',
            'content' => 'Example',
            'external' => true,
        ]);

        $this->assertStringContainsString(self::ICON, $link);
        $this->assertStringContainsString('<span class="show-for-sr">(external link)</span>', $link);
        $this->assertStringNotContainsString('target="_blank"', $link);
    }

    public function testExternalNewTabAnnouncesBothIntents(): void
    {
        $link = $this->view->renderLink([
            'href' => 'https://example.org',
            'content' => 'Example',
            'external' => true,
            'open_new_tab' => true,
        ]);

        $this->assertStringContainsString(self::ICON, $link);
        $this->assertStringContainsString(
            '<span class="show-for-sr">(external link, opens in a new tab)</span>',
            $link
        );
    }

    public function testOpenNewTabPairsTargetWithRel(): void
    {
        $link = $this->view->renderLink([
            'href' => 'https://example.org',
            'content' => 'Example',
            'open_new_tab' => true,
        ]);

        $this->assertStringContainsString('target="_blank"', $link);
        $this->assertStringContainsString('rel="noopener noreferrer"', $link);
    }

    public function testHrefCannotBreakOutOfItsAttribute(): void
    {
        $link = $this->view->renderLink([
            'href' => 'https://example.org/" onmouseover="alert(1)"',
            'content' => 'Example',
        ]);

        $this->assertStringNotContainsString('onmouseover="alert(1)"', $link);
        $this->assertStringContainsString('&quot; onmouseover=&quot;alert(1)', $link);
    }

    public function testContentIsEscaped(): void
    {
        $link = $this->view->renderLink([
            'href' => '/catalog/xt123',
            'content' => '<script>alert(1)</script>',
        ]);

        $this->assertStringNotContainsString('<script>', $link);
        $this->assertStringContainsString('&lt;script&gt;alert(1)&lt;/script&gt;', $link);
    }
}
