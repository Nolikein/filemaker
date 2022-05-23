<?php

declare(strict_types=1);

namespace Tests\PhpFileMaker\VariableToolkit;

use Nolikein\FileMaker\Php\FunctionToolkit\Argument;
use PHPUnit\Framework\TestCase;

final class ArgumentTest extends TestCase
{
    public function test_can_instanciate_argument()
    {
        $arg = new Argument('try');
        $this->assertInstanceOf(Argument::class, $arg);
    }

    public function test_can_set_arg_nullable()
    {
        $arg = new Argument('try', 'boolean', null, true);
        $this->assertTrue($arg->isNullable());
        $arg->setIsNullable(false);
        $this->assertFalse($arg->isNullable());
    }

    public function test_can_set_var_as_reference()
    {
        $arg = new Argument('try', 'boolean', null, false, true);
        $this->assertTrue($arg->isReference());
        $arg->setIsReference(false);
        $this->assertFalse($arg->isReference());
    }
}
