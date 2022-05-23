<?php

declare(strict_types=1);

namespace Tests\PhpFileMaker\VariableToolkit;

use Nolikein\FileMaker\Php\FunctionToolkit\ReturnType;
use PHPUnit\Framework\TestCase;

final class ReturnTypeTest extends TestCase
{
    public function test_can_instanciate_return_type()
    {
        $rt = new ReturnType('string');
        $this->assertInstanceOf(ReturnType::class, $rt);
    }

    public function test_can_set_type()
    {
        $rt = new ReturnType('int');
        $this->assertEquals('int', $rt->getType());
        $rt->setType('string');
        $this->assertEquals('string', $rt->getType());
    }

    public function test_can_set_is_nullable()
    {
        $rt = new ReturnType('int', true);
        $this->assertTrue($rt->isNullable());
        $rt->setIsNullable(false);
        $this->assertFalse($rt->isNullable());
    }
}
