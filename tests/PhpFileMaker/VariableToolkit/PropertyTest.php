<?php

declare(strict_types=1);

namespace Tests\PhpFileMaker\VariableToolkit;

use InvalidArgumentException;
use Nolikein\FileMaker\Php\VariableToolkit\Property;
use PHPUnit\Framework\TestCase;

final class PropertyTest extends TestCase
{
    const VALID_VISIBILITIES = ['public', 'protected', 'private'];

    public function test_can_instanciate_property_by_just_a_name()
    {
        $var = new Property('maVar');
        $this->assertInstanceOf(Property::class, $var);
        $this->assertFalse($var->hasDefaultValue());

        $var = new Property('maVar', 'string', 'Hello world', false, 'private');
        $var = new Property('maVar', visibility: 'private');
    }

    public function test_visibility_must_be_valid()
    {
        $var = new Property('maVar');
        foreach (self::VALID_VISIBILITIES as $visibility) {
            $var->setVisibility($visibility);
        }

        $badVisibility = 'pabloc';
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The property "maVar" has an invalid visibility. Got "' . $badVisibility . '" but only can select ' . implode(', ', self::VALID_VISIBILITIES) . '.');
        $var->setVisibility($badVisibility);
    }
}
