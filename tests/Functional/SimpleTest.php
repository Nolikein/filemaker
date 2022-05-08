<?php

declare(strict_types=1);

namespace Tests\Functional;

use PHPUnit\Framework\TestCase;

final class SimpleTest extends TestCase
{
    public function test_something()
    {
        $this->assertTrue(true);
        // $maker = new PhpFileMaker(newline: Newline::LF);
        // $maker = $maker
        //     ->addNamespace('Nolikein\FileMaker')
        //     ->newline()
        //     ->addUseStatement('Nolikein\FileMaker\Enums\Newline')
        //     ->newline()
        //     ->addClassSection('PhpFileMaker', function (PhpFileMaker $maker) {
        //         $maker
        //             ->addAnnotationBloc([
        //                 '@prop string $luke Je suis vieux',
        //                 '@var string $jeanMi Im a test variable',
        //             ])
        //             ->addProperty(new Property('jeanMi', 'string', 'Jean-Mi', 'protected'))
        //             ->newline()
        //             ->addProperty(new Property('Edouard', ['int', 'string'], visibility: 'private'))
        //             ->newline()
        //             ->addMethod(
        //                 new MethodPattern(
        //                     name: 'myTest',
        //                     arguments: [
        //                         new Argument(name: 'arg1', types: ['string', 'int'], defaultValue: 'test"', isNullable: false),
        //                         new Argument('$arg2', 'string', isReference: true),
        //                     ],
        //                     returnType: new ReturnType(type: 'string', isNullable: true),
        //                     actions: function (PhpFileMaker $maker) {
        //                         $maker->addLine('# Add comment');
        //                     },
        //                     visibility: 'private'
        //                 )
        //             );
        //     });


        // dd($maker->getContent());
    }
}
