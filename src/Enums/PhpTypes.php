<?php

namespace Nolikein\FileMaker\Enums;

use InvalidArgumentException;

/**
 * Enum to retrieve the PHP types.
 */
class PhpTypes implements FakeEnumInterface
{
    const TYPE_ACCEPTED_NAME = [
        'integer',
        'int',
        'float',
        'string',
        'bool',
        'boolean',
        'array',
        'callable',
        'object',
        'iterable',
        'resource',
        'null'
    ];

    const TYPE_ALIAS = [
        'integer' => 'int',
        'boolean' => 'bool'
    ];

    const GETTYPE_ALIAS = [
        'int' => 'integer',
        'bool' => 'boolean'
    ];

    /**
     * @inheritDoc
     * @return string[]
     */
    public static function all()
    {
        return self::TYPE_ACCEPTED_NAME;
    }

    /**
     * @inheritDoc
     * @param string $type The type to check
     * 
     * @return bool
     */
    public static function exists(string $type)
    {
        return in_array($type, self::TYPE_ACCEPTED_NAME);
    }

    /**
     * Is the type valid when used as function argument ?
     * 
     * @param string $type The type to check
     * 
     * @return bool
     */
    public static function shouldBeRenamed(string $type): bool
    {
        return key_exists($type, self::TYPE_ALIAS);
    }

    /**
     * Get an equivalent as argument for a valid php type
     * 
     * @param string $type The type that you want to get an equivalent
     * 
     * @return string
     */
    public static function rename(string $type): string
    {
        if (!self::shouldBeRenamed($type)) {
            return $type;
        }
        return self::TYPE_ALIAS[$type];
    }

    /**
     * Checks if a type is valid for gettype function
     * 
     * @param string $type The type to check
     * 
     * @return bool
     */
    public static function isValidForTypeChecking(string $type): bool
    {
        return !key_exists($type, self::GETTYPE_ALIAS);
    }

    /**
     * Get an equivalent of the current type for type checking with gettype
     * 
     * @param string $type The type that you want an equivalent
     * 
     * @return string
     */
    public static function getTypeCheckingEquivalent(string $type): string
    {
        if (self::isValidForTypeChecking($type)) {
            return $type;
        }
        return self::GETTYPE_ALIAS[$type];
    }
}
