<?php

declare(strict_types=1);

namespace Tests\PhpFileMaker;

use Nolikein\FileMaker\Enums\Newline;
use Nolikein\FileMaker\Php\PhpFileMaker;
use PHPUnit\Framework\TestCase;

final class ContentTest extends TestCase
{
    public function test_can_create_maker_from_content()
    {
        $maker = PhpFileMaker::createFromContent('Hello world');
        $this->assertInstanceOf(PhpFileMaker::class, $maker);
    }

    public function test_content_created_can_be_retrieved()
    {
        $maker = PhpFileMaker::createFromContent('Hello world');
        $this->assertIsString($maker->getContent());
        $this->assertEquals('Hello world', $maker->getContent());
    }

    public function test_can_add_content()
    {
        $maker = PhpFileMaker::createFromContent('');
        $maker->addContent('Hello world');
        $this->assertEquals('Hello world', $maker->getContent());
    }
}
