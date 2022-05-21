<?php

namespace Nolikein\FileMaker\Enums;

use InvalidArgumentException;

/**
 * Enum to retrieve the PHP types.
 */
class PhpTypes implements FakeEnumInterface
{
    const ACCEPTED_TYPES = [
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

    const GETTYPE_CONVERSION = [
        'int' => 'integer',
        'bool' => 'boolean'
    ];

    const ARGUMENT_CONVERSION = [
        'integer' => 'int',
        'boolean' => 'bool'
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
     * @param string $type The type to check
     * 
     * @return bool
     */
    public static function exists(string $type)
    {
        return in_array($type, self::ACCEPTED_TYPES);
    }

    /**
     * Is the type valid when used as function argument ?
     * 
     * @param string $type The type to check
     * 
     * @return bool
     */
    public static function isValidAsArgument(string $type): bool
    {
        return !key_exists($type, self::ARGUMENT_CONVERSION);
    }

    /**
     * Get an equivalent as argument for a valid php type
     * 
     * @param string $type The type that you want to get an equivalent
     * 
     * @return string
     */
    public static function getArgumentEquivalent(string $type): string
    {
        if (self::isValidAsArgument($type)) {
            return $type;
        }
        return self::ARGUMENT_CONVERSION[$type];
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
        return !key_exists($type, self::GETTYPE_CONVERSION);
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
        return self::GETTYPE_CONVERSION[$type];
    }
}
