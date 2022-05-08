<?php

namespace Nolikein\FileMaker\Enums;

class Newline implements FakeEnumInterface
{
    const CRLF = "\r\n";
    const LF = "\n";
    const CR = "\r";

    /**
     * @inheritDoc
     */
    public static function all()
    {
        return [
            self::CRLF,
            self::LF,
            self::CR
        ];
    }

    /**
     * @inheritDoc
     */
    public static function exists(string $newline)
    {
        return in_array($newline, self::all());
    }
}
