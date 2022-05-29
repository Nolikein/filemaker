<?php

declare(strict_types=1);

namespace Tests\PhpFileMaker;

use InvalidArgumentException;
use Nolikein\FileMaker\Enums\Newline;
use Nolikein\FileMaker\Php\FunctionToolkit\Argument;
use Nolikein\FileMaker\Php\FunctionToolkit\FunctionPattern;
use Nolikein\FileMaker\Php\FunctionToolkit\ReturnType;
use Nolikein\FileMaker\Php\PhpFileMaker;
use PHPUnit\Framework\TestCase;

final class PhpBasicsTest extends TestCase
{
    public function test_file_begin_with_php_tag_and_two_newlines()
    {
        $maker = new PhpFileMaker(Newline::LF);
        $this->assertEquals("<?php" . Newline::LF . Newline::LF, $maker->getContent());
    }

    public function test_php_header_is_correct_with_newline()
    {
        $maker = PhpFileMaker::createFromContent('', Newline::LF);
        $maker->addPhpHeader();
        $this->assertEquals("<?php" . Newline::LF, $maker->getContent());
    }

    public function test_instruction_finish_with_semicolon()
    {
        $maker = PhpFileMaker::createFromContent('', Newline::LF);
        $maker->addInstruction("echo 'Hello world'");
        $this->assertEquals("echo 'Hello world';" . Newline::LF, $maker->getContent());
    }

    public function test_can_add_bracket_section_beginning_without_tab()
    {
        $maker = PhpFileMaker::createFromContent('', Newline::LF);
        $maker
            ->addContent('test ')
            ->addBracketSection(function (PhpFileMaker $maker) {
                $maker->addLine('Hello world');
            });
        $this->assertEquals("test {" . Newline::LF .
            "\tHello world" . Newline::LF
            . "}" . Newline::LF, $maker->getContent());
    }

    public function test_can_add_bracket_section_beginning_with_tab_disabled()
    {
        $maker = PhpFileMaker::createFromContent('', Newline::LF);
        $maker
            ->addTabulationSection(function ($maker) {
                $maker
                    ->addContent('test ')
                    ->addBracketSection(function (PhpFileMaker $maker) {
                        $maker->addLine('Hello world');
                    }, true);
            });

        $this->assertEquals("test {" . Newline::LF .
            "\t\tHello world" . Newline::LF
            . "\t}" . Newline::LF, $maker->getContent());
    }

    public function test_can_add_bracket_section_beginning_with_tab_enabled()
    {
        $maker = PhpFileMaker::createFromContent('', Newline::LF);
        $maker
            ->addTabulationSection(function ($maker) {
                $maker
                    ->addBracketSection(function (PhpFileMaker $maker) {
                        $maker->addLine('Hello world');
                    }, false);
            });

        $this->assertEquals("\t{" . Newline::LF .
            "\t\tHello world" . Newline::LF
            . "\t}" . Newline::LF, $maker->getContent());
    }

    public function test_can_add_function_not_nullable()
    {
        $maker = PhpFileMaker::createFromContent('', Newline::LF);
        $maker->addFunction(new FunctionPattern(
            'test1',
            [
                new Argument('test2', ['string', 'integer'], defaultValue: 123, isNullable: false, isReference: true)
            ],
            new ReturnType('string', isNullable: true),
            function (PhpFileMaker $maker) {
                $maker->addLine('Hello');
            }
        ));
        $this->assertEquals(
            "function test1(string|int &\$test2 = 123): ?string" . Newline::LF
                . "{" . Newline::LF
                . "\tHello" . Newline::LF
                . "}" . Newline::LF,

            $maker->getContent()
        );
    }

    public function test_can_add_function_nullable()
    {
        $maker = PhpFileMaker::createFromContent('', Newline::LF);
        $maker->addFunction(new FunctionPattern(
            'test1',
            [
                new Argument('test2', ['string'], defaultValue: 'Hello world', isNullable: true, isReference: true)
            ],
            new ReturnType('string', isNullable: true),
            function (PhpFileMaker $maker) {
                $maker->addLine('Hello');
            }
        ));
        $this->assertEquals(
            "function test1(?string &\$test2 = 'Hello world'): ?string" . Newline::LF
                . "{" . Newline::LF
                . "\tHello" . Newline::LF
                . "}" . Newline::LF,

            $maker->getContent()
        );
    }

    public function test_function_nullable_must_have_at_least_one_argument()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('Argument "test2" cannot be nullable if it has no type');

        $maker = PhpFileMaker::createFromContent('', Newline::LF);
        $maker->addFunction(new FunctionPattern(
            'test1',
            [
                new Argument('test2', [], defaultValue: null, isNullable: true, isReference: true)
            ],
            new ReturnType('string', isNullable: true),
            function (PhpFileMaker $maker) {
                $maker->addLine('Hello');
            }
        ));
    }

    public function test_function_nullable_must_have_more_than_one_argument()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('Argument "test2" cannot be nullable if it has more than one type');

        $maker = PhpFileMaker::createFromContent('', Newline::LF);
        $maker->addFunction(new FunctionPattern(
            'test1',
            [
                new Argument('test2', ['string', 'integer'], defaultValue: 123, isNullable: true, isReference: true)
            ],
            new ReturnType('string', isNullable: true),
            function (PhpFileMaker $maker) {
                $maker->addLine('Hello');
            }
        ));
    }

    public function test_that_arg_type_equivalent_are_converted()
    {
        foreach ([
            ['handle' => ['boolean', 'bool'], 'result' => 'bool'],
            ['handle' => ['integer', 'int'], 'result' => 'int'],
        ] as $test) {
            foreach ($test['handle'] as $type) {
                $maker = PhpFileMaker::createFromContent('', Newline::LF);
                $maker->addFunction(new FunctionPattern(
                    'test1',
                    [
                        new Argument('test2', $type)
                    ],
                    new ReturnType('string', isNullable: true),
                    function (PhpFileMaker $maker) {
                        $maker->addLine('Hello');
                    }
                ));
                $this->assertEquals(
                    "function test1(" . $test['result'] . " \$test2): ?string" . Newline::LF
                        . "{" . Newline::LF
                        . "\tHello" . Newline::LF
                        . "}" . Newline::LF,

                    $maker->getContent()
                );
            }
        }
    }
}
