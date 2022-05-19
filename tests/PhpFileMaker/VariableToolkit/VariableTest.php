<?php

declare(strict_types=1);

namespace Tests\PhpFileMaker\VariableToolkit;

use Nolikein\FileMaker\Enums\Newline;
use Nolikein\FileMaker\Php\PhpFileMaker;
use Nolikein\FileMaker\Php\VariableToolkit\Variable;
use PHPUnit\Framework\TestCase;

final class VariableTest extends TestCase
{
    public function test_can_instanciate_variable_without_selecting_type()
    {
        $var = new Variable('maVar');
        $this->assertInstanceOf(Variable::class, $var);
        $this->assertFalse($var->hasDefaultValue());
    }

    public function test_can_instanciate_variable_without_default_value()
    {
        $var = new Variable('maVar', 'string');
        $this->assertInstanceOf(Variable::class, $var);
        $this->assertFalse($var->hasDefaultValue());
    }

    public function test_can_add_multiple_types()
    {
        $var = new Variable('maVar', ['string', 'integer']);
        $this->assertInstanceOf(Variable::class, $var);
        $this->assertFalse($var->hasDefaultValue());
    }

    public function test_getters_retrieve_well_type()
    {
        $var = new Variable('maVar', ['string', 'integer'], 'Hello world');
        $this->assertIsString($var->getName());
        $this->assertIsArray($var->getTypes());
        $this->assertIsString($var->getDefaultValue());
        $var->setDefaultValue(123);
        $this->assertIsInt($var->getDefaultValue());
        $var->setDefaultValue(null);
        $this->assertNull($var->getDefaultValue());
        $this->assertIsBool($var->hasDefaultValue());
        $this->assertTrue($var->hasDefaultValue());
    }

    public function test_null_default_value_can_be_setted()
    {
        $var = new Variable('maVar', [], null);
        $this->assertFalse($var->hasDefaultValue());
        $var = new Variable('maVar', [], null, false);
        $this->assertFalse($var->hasDefaultValue());
        $var = new Variable('maVar', [], null, true);
        $this->assertTrue($var->hasDefaultValue());
    }
}
