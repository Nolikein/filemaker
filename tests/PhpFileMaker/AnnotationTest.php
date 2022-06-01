<?php

declare(strict_types=1);

namespace Tests\PhpFileMaker;

use Nolikein\FileMaker\Enums\Newline;
use Nolikein\FileMaker\Php\PhpFileMaker;
use PHPUnit\Framework\TestCase;

final class AnnotationTest extends TestCase
{
    public function test_simple_annot()
    {
        $maker = PhpFileMaker::createFromContent('', Newline::LF);
        $maker->addAnnotationBloc('@param string $test Test something');
        $this->assertEquals(
            '/**' . Newline::LF
                . ' * @param string $test Test something' . Newline::LF
                . ' */' . Newline::LF,
            $maker->getContent()
        );
    }

    public function test_multiple_annotations()
    {
        $maker = PhpFileMaker::createFromContent('', Newline::LF);
        $maker->addAnnotationBloc([
            '@param string $test Test something',
            '@return string'
        ]);
        $this->assertEquals(
            '/**' . Newline::LF
                . ' * @param string $test Test something' . Newline::LF
                . ' *' . Newline::LF
                . ' * @return string' . Newline::LF
                . ' */' . Newline::LF,
            $maker->getContent()
        );
    }

    public function test_same_type_annot_do_not_jump_line()
    {
        $maker = PhpFileMaker::createFromContent('', Newline::LF);
        $maker->addAnnotationBloc([
            'Element without type',
            '@param string $test Test something',
            '@param int $check To check',
            'Element without type',
            'Element without type',
            '@param int $checkTwo To check two',
            '@return string',
            'Element without type',
        ]);

        $this->assertEquals(
            '/**' . Newline::LF
                . ' * Element without type' . Newline::LF
                . ' *' . Newline::LF
                . ' * @param string $test Test something' . Newline::LF
                . ' * @param int $check To check' . Newline::LF
                . ' * Element without type' . Newline::LF
                . ' * Element without type' . Newline::LF
                . ' *' . Newline::LF
                . ' * @param int $checkTwo To check two' . Newline::LF
                . ' *' . Newline::LF
                . ' * @return string' . Newline::LF
                . ' * Element without type' . Newline::LF
                . ' */' . Newline::LF,
            $maker->getContent()
        );
    }
}
