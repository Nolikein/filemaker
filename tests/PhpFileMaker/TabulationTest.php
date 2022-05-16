<?php

declare(strict_types=1);

namespace Tests\PhpFileMaker;

use Nolikein\FileMaker\Php\PhpFileMaker;
use PHPUnit\Framework\TestCase;

final class TabulationTest extends TestCase
{
    public function test_can_add_tabulation()
    {
        $maker = PhpFileMaker::createFromContent('');
        $maker->incrementTabulationCounter();
        // The counter do not add any content
        $this->assertEquals('', $maker->getContent());

        $maker->addTabulationLevel();
        // The tabulation level is 1. So there is changes
        $this->assertEquals("\t", $maker->getContent());

        $maker->decrementTabulationCounter();
        $maker->addTabulationLevel();
        // The tabulation level is 0. So there is no changes
        $this->assertEquals("\t", $maker->getContent());
    }

    public function test_can_add_content_with_tabulation_level()
    {
        $maker = PhpFileMaker::createFromContent('');
        $maker
            ->incrementTabulationCounter()
            ->addContentWithTabulationLevel('Hello world');
        $this->assertEquals("\tHello world", $maker->getContent());
    }

    public function test_can_add_tabulation_section()
    {
        $maker = PhpFileMaker::createFromContent('');
        $maker->addTabulationSection(function(PhpFileMaker $maker) {
            return $maker->addContentWithTabulationLevel('Hello world');
        });
        $this->assertEquals("\tHello world", $maker->getContent());
    }
}
