<?php

namespace Nolikein\FileMaker\Enums;

interface FakeEnumInterface
{
    /**
     * Retrieves all the values of the enum.
     * 
     * @return array
     */
    public static function all();

    /**
     * Checks if the given value exists in the enum.
     * 
     * @param bool
     */
    public static function exists(string $datasource);
}