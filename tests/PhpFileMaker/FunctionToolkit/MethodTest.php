<?php

declare(strict_types=1);

namespace Tests\PhpFileMaker\VariableToolkit;

use Closure;
use InvalidArgumentException;
use Nolikein\FileMaker\Php\FunctionToolkit\Argument;
use Nolikein\FileMaker\Php\FunctionToolkit\FunctionPattern;
use Nolikein\FileMaker\Php\FunctionToolkit\MethodPattern;
use Nolikein\FileMaker\Php\FunctionToolkit\ReturnType;
use PhpParser\Node\Arg;
use PHPUnit\Framework\TestCase;

final class MethodTest extends TestCase
{
    public function test_can_instanciate_function()
    {
        $fn = new MethodPattern('hello');
        $this->assertInstanceOf(MethodPattern::class, $fn);
    }

    public function test_can_set_visibility()
    {
        $fn = new MethodPattern('hello', visibility: 'public');
        $this->assertIsString($fn->getVisibility());
        $this->assertEquals('public', $fn->getVisibility());
        $fn->setVisibility('private');
        $this->assertEquals('private', $fn->getVisibility());
    }

    public function test_visibility_must_be_valid()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid visibility "doesNotExists"');
        $fn = new MethodPattern('hello', visibility: 'doesNotExists');
    }

}
