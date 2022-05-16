<?php

declare(strict_types=1);

namespace Tests\PhpFileMaker;

use Nolikein\FileMaker\Php\PhpFileMaker;
use PHPUnit\Framework\TestCase;

final class SaveFileTest extends TestCase
{
    public function test_can_save_content()
    {
        $cacheFilePath = test_cache_path('contentGenerated.php');

        remove_cache_file('contentGenerated.php');
        $maker = PhpFileMaker::createFromContent('Hello world');
        $maker->saveAt($cacheFilePath);

        $this->assertEquals('Hello world', file_get_contents($cacheFilePath));
        remove_cache_file('contentGenerated.php');
    }
}
