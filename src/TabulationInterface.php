<?php

namespace Nolikein\FileMaker;

interface TabulationInterface
{
    /**
     * Increment the tabulation counter.
     * 
     * @return static
     */
    public function incrementTabulationCounter(): static;

    /**
     * Decrement the tabulation counter.
     * 
     * @return static
     */
    public function decrementTabulationCounter(): static;

    /**
     * Add the current tabulation level to the current content.
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