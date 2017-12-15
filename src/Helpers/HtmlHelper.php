<?php

namespace Phpshko\Test\Helpers;

class HtmlHelper
{
    /**
     * Return string with html attributes and values
     * @param array[] ...$data
     * @return string
     */
    public static function formatOptions(array ...$data): string
    {
        $htmlOptions = [];

        foreach (array_merge(...$data) as $attribute => $value) {
            $htmlOptions[] = $attribute . '="' . $value . '"';
        }

        return implode(' ', $htmlOptions);
    }
}