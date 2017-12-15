<?php

namespace Phpshko\Test\Helpers;

class ConfigHelper
{
    /**
     * Fill object properties form $config
     * @param object $object
     * @param array  $config
     */
    public static function load(object $object, array $config = []): void
    {
        foreach ($config as $name => $value) {
            $object->$name = $value;
        }
    }
}