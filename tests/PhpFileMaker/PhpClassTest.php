<?php

declare(strict_types=1);

namespace Tests\PhpFileMaker;

use Nolikein\FileMaker\Enums\Newline;
use Nolikein\FileMaker\Php\FunctionToolkit\Argument;
use Nolikein\FileMaker\Php\FunctionToolkit\MethodPattern;
use Nolikein\FileMaker\Php\FunctionToolkit\ReturnType;
use Nolikein\FileMaker\Php\PhpFileMaker;
use Nolikein\FileMaker\Php\VariableToolkit\Property;
use PHPUnit\Framework\TestCase;

final class PhpClassTest extends TestCase
{
    public function test_can_add_class_section_with_nothing()
    {
        $maker = PhpFileMaker::createFromContent('', Newline::LF);
        $maker->addClassSection('Hello', function () {
        });
        $this->assertEquals(
            'class Hello' . Newline::LF
                . "{" . Newline::LF
                . "}" . Newline::LF,
            $maker->getContent()
        );
    }

    public function test_can_add_class_section_with_something()
    {
        $maker = PhpFileMaker::createFromContent('', Newline::LF);
        $maker->addClassSection('Hello', function ($maker) {
            $maker->addInstruction('echo "Hello world"');
        });
        $this->assertEquals(
            'class Hello' . Newline::LF
                . "{" . Newline::LF
                . "\techo \"Hello world\";" . Newline::LF
                . "}" . Newline::LF,
            $maker->getContent()
        );
    }

    public function test_can_add_property()
    {
        $maker = PhpFileMaker::createFromContent('', Newline::LF);
        $maker->addProperty(new Property('hello', ['int', 'string'], 'world', false, 'private'));
        $this->assertEquals(
            'private int|string $hello = \'world\';' . Newline::LF,
            $maker->getContent()
        );
    }

    public function test_can_add_method()
    {
        $maker = PhpFileMaker::createFromContent('', Newline::LF);
        $maker->addMethod(new MethodPattern(
            'test1',
            [
                new Argument('test2', ['string', 'integer'], defaultValue: 123, isNullable: false, isReference: true)
            ],
            new ReturnType('string', isNullable: true),
            function (PhpFileMaker $maker) {
                $maker->addLine('Hello');
            },
            'protected'
        ));
        $this->assertEquals(
            "protected function test1(string|int &\$test2 = 123): ?string" . Newline::LF
                . "{" . Newline::LF
                . "\tHello" . Newline::LF
                . "}" . Newline::LF,

            $maker->getContent()
        );
    }
}
