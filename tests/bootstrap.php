<?php

use Nolikein\FileMaker\Php\FunctionToolkit\FunctionPattern;
use Nolikein\FileMaker\Php\FunctionToolkit\ReturnType;
use Nolikein\FileMaker\Php\PhpFileMaker;

require dirname(__DIR__) . '/vendor/autoload.php';

new FunctionPattern('Hello', [], new ReturnType('string'), function() {
    return 'Hello';
});

function dd()
{
    array_map(function ($x) {
        var_dump($x);
    }, func_get_args());
    die;
}
