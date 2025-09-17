<?php

function fa_render_string($s)
{
    $fragment = simplexml_load_string((string) $s);
    return fa_render($fragment);
}

function fa_render($fragment)
{
    $node = dom_import_simplexml($fragment);
    $segments = [];
    foreach ($node->childNodes as $child) {
        switch ($child->nodeName) {
            case 'head':
                break;
            case 'p':
                $segments[] = fa_render($child);
                break;
            case 'emph':
                $segments[] = fa_render_title($child);
                break;
            case 'extref':
                $segments[] = fa_render_extref($child);
                break;
            case 'title':
                $segments[] = fa_render_title($child);
                break;
            default:
                $segments[] = $child->textContent;
                break;
        }
    }
    return trim(implode('', $segments));
}

function fa_render_title($node)
{
    $render = '';
    if ($node->hasAttribute('render')) {
        $render = match ($node->getAttribute('render')) {
            'italic' => '<i>' . $node->textContent . '</i>',
            'doublequote' => '"' . $node->textContent . '"',
            default => '"' . $node->textContent . '"',
        };
    } else {
        $render = $node->textContent;
    }
    return $render;
}

function fa_render_extref($node)
{
    $render = '';
    if ($node->hasAttribute('href')) {
        $href = $node->getAttribute('href');

        $show_new = true;
        if ($node->hasAttribute('show')) {
            $show_desire = $node->getAttribute('show');
            if ($show_desire === 'replace') {
                $show_new = false;
            }
        }
        $link = '<a href="' . $href . '"';
        if ($show_new) {
            $link .= ' target="_blank" rel="nooopener noreferrer"';
        }
        $link .= '>' . $node->textContent . '</a>';
        $render = $link;
    } else {
        $render = $node->textContent;
    }
    return $render;
}
