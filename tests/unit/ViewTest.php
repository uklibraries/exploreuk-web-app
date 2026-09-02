<?php

namespace ExploreUK;

use PHPUnit\Framework\TestCase;

final class ViewTest extends TestCase
{
    private const ICON = '<span class="ic ic--popup" aria-hidden="true"></span>';

    public function testPlainLinkGetsNoIconAndNoAnnouncement(): void
    {
        $link = View::renderLink([
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
        $link = View::renderLink([
            'href' => 'https://example.org',
            'content' => 'Example',
            'open_new_tab' => true,
        ]);

        $this->assertStringContainsString('<span class="show-for-sr">(opens in a new tab)</span>', $link);
        $this->assertStringNotContainsString(self::ICON, $link);
    }

    public function testExternalIsAnnouncedAndIconIsHiddenFromAssistiveTech(): void
    {
        $link = View::renderLink([
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
        $link = View::renderLink([
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
        $link = View::renderLink([
            'href' => 'https://example.org',
            'content' => 'Example',
            'open_new_tab' => true,
        ]);

        $this->assertStringContainsString('target="_blank"', $link);
        $this->assertStringContainsString('rel="noopener noreferrer"', $link);
    }

    public function testClassesReplaceTheDefaultStyling(): void
    {
        $link = View::renderLink([
            'href' => 'https://example.org',
            'content' => 'Example',
            'classes' => 'link--fancy',
        ]);

        $this->assertSame(
            '<a class="link--fancy" href="https://example.org">Example</a>',
            $link
        );
    }

    public function testClassesCanStackWhenPassedExplicitly(): void
    {
        $link = View::renderLink([
            'href' => '/about',
            'content' => 'About',
            'classes' => 'underline-link link--fancy',
        ]);

        $this->assertStringContainsString('class="underline-link link--fancy"', $link);
    }

    public function testEmptyClassesOmitTheAttributeEntirely(): void
    {
        $link = View::renderLink([
            'href' => '/about',
            'content' => 'About',
            'classes' => '',
        ]);

        $this->assertSame('<a href="/about">About</a>', $link);
    }

    public function testClassesCannotBreakOutOfTheirAttribute(): void
    {
        $link = View::renderLink([
            'href' => '/about',
            'content' => 'About',
            'classes' => 'x" onmouseover="alert(1)',
        ]);

        $this->assertStringNotContainsString('onmouseover="alert(1)"', $link);
    }

    public function testIdAndTitleAreRenderedAndEscaped(): void
    {
        $link = View::renderLink([
            'href' => '/catalog/xt123/download?type=pdf',
            'content' => 'Download PDF',
            'classes' => 'button button--wildcat-blue',
            'id' => 'pdf_href',
            'title' => 'A "quoted" title',
        ]);

        $this->assertStringContainsString('id="pdf_href"', $link);
        $this->assertStringContainsString('title="A &quot;quoted&quot; title"', $link);
        $this->assertStringNotContainsString('onmouseover', $link);
    }

    public function testAriaLabelIsRendered(): void
    {
        $link = View::renderLink([
            'href' => '/catalog/?offset=20',
            'content' => 'Next',
            'aria_label' => 'Next page of results',
        ]);

        $this->assertStringContainsString('aria-label="Next page of results"', $link);
    }

    public function testAriaLabelAbsorbsTheDestinationNote(): void
    {
        $link = View::renderLink([
            'href' => 'https://ukyarchives.blogspot.com/',
            'content' => 'blogspot',
            'aria_label' => 'Curiosities and Wonders',
            'external' => true,
        ]);

        # The label carries the note, because it overrides the inner text entirely.
        $this->assertStringContainsString('aria-label="Curiosities and Wonders (external link)"', $link);
        $this->assertStringNotContainsString('<span class="show-for-sr">', $link);
        $this->assertStringContainsString(self::ICON, $link);
    }

    public function testAriaLabelCannotBreakOutOfItsAttribute(): void
    {
        $link = View::renderLink([
            'href' => '/about',
            'content' => 'About',
            'aria_label' => 'x" onmouseover="alert(1)',
        ]);

        $this->assertStringNotContainsString('onmouseover="alert(1)"', $link);
    }

    public function testHrefCannotBreakOutOfItsAttribute(): void
    {
        $link = View::renderLink([
            'href' => 'https://example.org/" onmouseover="alert(1)"',
            'content' => 'Example',
        ]);

        $this->assertStringNotContainsString('onmouseover="alert(1)"', $link);
        $this->assertStringContainsString('&quot; onmouseover=&quot;alert(1)', $link);
    }

    public function testContentIsEscaped(): void
    {
        $link = View::renderLink([
            'href' => '/catalog/xt123',
            'content' => '<script>alert(1)</script>',
        ]);

        $this->assertStringNotContainsString('<script>', $link);
        $this->assertStringContainsString('&lt;script&gt;alert(1)&lt;/script&gt;', $link);
    }

    public function testOldKdlRightsStatementBecomesAnAnnouncedScrcLink(): void
    {
        $view = new View(['query' => null], 'about');

        $html = $view->renderField([
            'key' => 'usage_display',
            'value' => 'Protected by copyright. Please go to http://kdl.kyvl.org for more information.',
        ]);

        $this->assertStringContainsString('href="https://libraries.uky.edu/ContactSCRC"', $html);
        $this->assertStringContainsString(self::ICON, $html);
        $this->assertStringContainsString('<span class="show-for-sr">(external link)</span>', $html);
        $this->assertStringNotContainsString('target="_blank"', $html);
        $this->assertStringNotContainsString('kdl.kyvl.org', $html);
    }
}
