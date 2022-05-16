<?php

declare(strict_types=1);

namespace Tests\PhpFileMaker;

use InvalidArgumentException;
use Nolikein\FileMaker\Enums\Newline;
use Nolikein\FileMaker\Php\PhpFileMaker;
use PHPUnit\Framework\TestCase;

final class NewlineTest extends TestCase
{
    public function test_can_instanciate_maker_without_anything()
    {
        $maker = new PhpFileMaker();
        $this->assertInstanceOf(PhpFileMaker::class, $maker);
    }

    public function test_newline_enum_are_string()
    {
        foreach (Newline::all() as $value) {
            $this->assertIsString($value);
        }
    }

    public function test_newline_enum_exist()
    {
        foreach (Newline::all() as $value) {
            $this->assertTrue(Newline::exists($value));
        }
    }

    public function test_select_newline_character()
    {
        $maker = new PhpFileMaker(Newline::LF);
        $this->assertIsString($maker->getNewlineCharacter());
        $this->assertEquals(Newline::LF, $maker->getNewlineCharacter());
        $maker->setNewlineCharacter(Newline::CRLF);
        $this->assertEquals(Newline::CRLF, $maker->getNewlineCharacter());
    }

    public function test_cant_add_any_character_as_newline()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid newline character');
        $this->expectExceptionCode(0);
        $maker = new PhpFileMaker();
        $maker->setNewlineCharacter('anything is bad');
    }

    public function test_constructor_use_newline_setter_to_check_error()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid newline character');
        $this->expectExceptionCode(0);
        $maker = new PhpFileMaker('anything is bad');
    }

    public function test_can_apply_newline_in_maker()
    {
        foreach (Newline::all() as $newlineCharacter) {
            $maker = PhpFileMaker::createFromContent('');
            $maker->setNewlineCharacter($newlineCharacter);
            $maker->newline();
            $this->assertEquals($newlineCharacter, $maker->getContent());
        }
    }

    public function test_can_add_line_with_content()
    {
        foreach (Newline::all() as $newlineCharacter) {
            $maker = PhpFileMaker::createFromContent('');
            $maker->setNewlineCharacter($newlineCharacter);
            $maker->addLine('Hello world');
            $this->assertEquals('Hello world' . $newlineCharacter, $maker->getContent());
        }
    }
}
