<?php

namespace Nolikein\FileMaker\Php\VariableToolkit;

interface PropertyInterface extends VariableInterface
{
    /**
     * Get the visibility of the property.
     * 
     * @return string
     */
    public function getVisibility(): string;

    /**
     * Set the visibility of the property.
     * 
     * @param string $visibility The visibility of the property
     * 
     * @return self
     */
    public function setVisibility(string $visibility): self;
}
