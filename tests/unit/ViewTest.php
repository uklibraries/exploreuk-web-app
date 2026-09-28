<?php

namespace ExploreUK;

use PHPUnit\Framework\TestCase;

final class ViewTest extends TestCase
{
    public function testSearchBriefPreservesActiveFacets(): void
    {
        $view = new View(
            [
                'query' => new Query(['q' => 'Frank Fuller']),
                'active_facets' => [
                    [
                        'field_raw' => 'source_s',
                        'hidden_value_label' => 'The Kentucky Kernel & News',
                    ],
                ],
            ],
            'search-brief',
        );

        ob_start();
        $view->render();
        $output = ob_get_clean();

        $this->assertStringContainsString('name="f[source_s][]"', $output);
        $this->assertStringContainsString('value="The Kentucky Kernel &amp; News"', $output);
    }
}
