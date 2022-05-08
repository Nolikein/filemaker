<?php

namespace Nolikein\FileMaker;

interface TabulationInterface
{
    /**
     * Add the current tabulation level.
     * 
     * @return static
     */
    public function addTabulationLevel(): static;

    /**
     * Add a content with the current tabulations level.
     * 
     * @param string $content The content to add
     * 
     * @return static
     */
    public function addContentWithTabulationLevel(string $content): static;

    /**
     * Add content with a tabulation. The method could be nested.
     * 
     * @param Callable $actions The action to do with with one more tabulation
     * 
     * @return static
     */
    public function addTabulationSection(callable $actions): static;
}