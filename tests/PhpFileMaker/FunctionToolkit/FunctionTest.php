<?php

declare(strict_types=1);

namespace Tests\PhpFileMaker\VariableToolkit;

use Closure;
use Nolikein\FileMaker\Php\FunctionToolkit\Argument;
use Nolikein\FileMaker\Php\FunctionToolkit\FunctionPattern;
use Nolikein\FileMaker\Php\FunctionToolkit\ReturnType;
use PhpParser\Node\Arg;
use PHPUnit\Framework\TestCase;

final class FunctionTest extends TestCase
{
    public function test_can_instanciate_function()
    {
        $fn = new FunctionPattern('hello');
        $this->assertInstanceOf(FunctionPattern::class, $fn);
    }

    public function test_can_set_name()
    {
        $fn = new FunctionPattern('hello');
        $this->assertIsString($fn->getName());
        $this->assertEquals('hello', $fn->getName());
        $fn->setName('world');
        $this->assertEquals('world', $fn->getName());
    }

    public function test_can_set_argument()
    {
        $fn = new FunctionPattern('hello', []);
        $this->assertIsArray($fn->getArguments());
        $this->assertEmpty($fn->getArguments());
        $fn->setArguments([
            new Argument('world')
        ]);
        $this->assertCount(1, $fn->getArguments());
        $this->assertInstanceOf(Argument::class, $fn->getArguments()[0]); 
        $this->assertEquals('world', $fn->getArguments()[0]->getName());
    }

    public function test_can_set_return_type()
    {
        $fn = new FunctionPattern('hello', [], null);
        $this->assertNull($fn->getReturnType());
        $fn->setReturnType(new ReturnType('string'));
        $this->assertInstanceOf(ReturnType::class, $fn->getReturnType());
    }

    public function test_can_set_action()
    {
        $fn = new FunctionPattern('hello', [], null, null);
        $this->assertNull($fn->getActions());
        $fn->setActions(function() {});
        $this->assertInstanceOf(Closure::class, $fn->getActions());
    }
}
