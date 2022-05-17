<?php

declare(strict_types=1);

namespace Tests\PhpFileMaker;

use Nolikein\FileMaker\Enums\Newline;
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
        $maker = PhpFileMaker::createFromContent('');
        $maker->addPhpHeader();
        $this->assertEquals("<?php" . Newline::LF, $maker->getContent());
    }

    public function test_instruction_finish_with_semicolon()
    {
        $maker = PhpFileMaker::createFromContent('');
        $maker
            ->setNewlineCharacter(Newline::LF)
            ->addInstruction("echo 'Hello world'");
        $this->assertEquals("echo 'Hello world';" . Newline::LF, $maker->getContent());
    }

    public function test_can_add_bracket_section()
    {
        $maker = PhpFileMaker::createFromContent('');
        $maker
            ->setNewlineCharacter(Newline::LF)
            ->addBracketSection(function (PhpFileMaker $maker) {
                $maker->addLine('Hello world');
            });
        $this->assertEquals("{" . Newline::LF .
            "\tHello world" . Newline::LF
            . "}" . Newline::LF, $maker->getContent());
    }
}
