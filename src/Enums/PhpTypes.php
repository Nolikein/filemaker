<?php

namespace Nolikein\FileMaker\Enums;

/**
 * Enum to retrieve the PHP types.
 */
class PhpTypes implements FakeEnumInterface
{
    const ACCEPTED_TYPES = [
        'integer',
        'float',
        'string',
        'bool',
        'array',
        'callable',
        'object',
        'iterable',
        'resource',
        'null'
    ];

    /**
     * @inheritDoc
     * @return string[]
     */
    public static function all()
    {
        return self::ACCEPTED_TYPES;
    }

    /**
     * @inheritDoc
     * @param string $type
     * 
     * @return bool
     */
    public static function exists(string $type)
    {
        return in_array($type, self::ACCEPTED_TYPES);
    }
}