<?php

namespace Nolikein\FileMaker;

interface SaveFileInterface
{
    /**
     * Save the file content at the given path.
     * 
     * @param string $path The path to save the file
     */
    public function saveAt(string $path): void;
}