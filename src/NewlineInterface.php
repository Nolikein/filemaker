<?php

namespace Nolikein\FileMaker;

interface NewlineInterface
{
    /**
     * Set the newline character.
     * 
     * @param string $newline The newline character to use
     * 
     * @return static
     */
    public function setNewlineCharacter(string $newline): static;

    /**
     * Add a content from a new line and tabulations.
     * 
     * @param string $content The content to add
     * 
     * @return static
     */
    public function addLine(string $content): static;

    /**
     * Add a new line.
     * 
     * @return static
     */
    public function newline(): static;
}