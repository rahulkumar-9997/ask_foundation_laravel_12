<?php

function clean_html_content($html)
{
    if (empty($html)) return '';
    return preg_replace([
        '/<p[^>]*>\s*&nbsp;\s*<\/p>/i',
        '/<p[^>]*>\s*<\/p>/i',
        '/(<br\s*\/?>\s*){2,}/i'
    ], '', $html);
}