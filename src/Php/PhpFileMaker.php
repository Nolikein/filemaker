<?php

namespace Nolikein\FileMaker\Php;

use Nolikein\FileMaker\Enums\Newline;
use Nolikein\FileMaker\FileMaker;

class PhpFileMaker extends FileMaker
{
    use UsePhpBasics;
    use UseNamespaceComponents;
    use UseClassComponents;
    use UseAnnotations;

    /**
     * @param string $newline The newline character. Must be one of the Newline enum value.
     */
    public function __construct(string $newline = Newline::LF)
    {
        parent::__construct($newline);
        $this->addPhpHeader();
        $this->newline();
    }
}
