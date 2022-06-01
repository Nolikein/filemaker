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

final class NamespaceTest extends TestCase
{
    public function test_namespace()
    {
        $maker = PhpFileMaker::createFromContent('');
        $maker->setNewlineCharacter(Newline::LF)->addNamespace('App');
        $this->assertEquals('namespace App;' . Newline::LF, $maker->getContent());
    }

    public function test_use_statement()
    {
        $maker = PhpFileMaker::createFromContent('');
        $maker->setNewlineCharacter(Newline::LF)->addUseStatement('App');
        $this->assertEquals('use App;' . Newline::LF, $maker->getContent());

        $maker = PhpFileMaker::createFromContent('');
        $maker->setNewlineCharacter(Newline::LF)->addUseStatement([
            'App',
            'Test\\Debug'
        ]);
        $this->assertEquals(
            'use App;' . Newline::LF
                . 'use Test\\Debug;' . Newline::LF,
            $maker->getContent()
        );
    }

    public function test_use_statement_can_use_aliasing()
    {
        $maker = PhpFileMaker::createFromContent('');
        $maker->setNewlineCharacter(Newline::LF)->addUseStatement([
            'App' => 'Delta'
        ]);
        $this->assertEquals(
            'use App as Delta;' . Newline::LF,
            $maker->getContent()
        );
    }
}
