<?php

namespace Nolikein\FileMaker\Php\FunctionToolkit;

interface MethodPatternInterface extends FunctionPatternInterface
{
    /**
     * Get the function visibility.
     * 
     * @return string
     */
    public function getVisibility(): string;

    /**
     * Set the function visibility.
     * 
     * @param string $visibility The function visibility
     * 
     * @return self
     * 
     * @throws \InvalidArgumentException If the function visibility is not valid
     */
    public function setVisibility(string $visibility): self;
}