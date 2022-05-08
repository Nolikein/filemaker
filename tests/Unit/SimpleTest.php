<?php

declare(strict_types=1);

namespace Tests\Unit;

use Nolikein\FileMaker\Php\PhpFileMaker;
use PHPUnit\Framework\TestCase;

final class SimpleTest extends TestCase
{
    public function test_can_instanciate_maker()
    {
        $maker = new PhpFileMaker();
        $this->assertInstanceOf(PhpFileMaker::class, $maker);
    }
}
