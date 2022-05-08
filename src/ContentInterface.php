<?php

namespace Nolikein\FileMaker;

interface ContentInterface
{

    /**
     * Create a new instance from existing content.
     * 
     * @param string $content The content to use
     * 
     * @return PhpFileMaker
     */
    public static function createFromContent(string $existingContent);

    /**
     * Get the content of the file.
     * 
     * @return string
     */
    public function getContent(): string;

    /**
     * Add a content without any space or tabulation characters.
     * 
     * @param string $content The content to add
     * 
     * @return static
     */
    public function addContent(string $content): static;
}