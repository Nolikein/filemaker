<?php

namespace Nolikein\FileMaker\Php\FunctionToolkit;

use Nolikein\FileMaker\Php\VariableToolkit\VariableInterface;

interface ArgumentInterface extends VariableInterface
{
    /**
     * Checks if the argument is nullable.
     * 
     * @return bool
     */
    public function isNullable(): bool;

    /**
     * Set if the argument is nullable.
     * 
     * @param bool $isNullable Is the argument nullable?
     * 
     * @return self
     * 
     * @throws \LogicException If the argument is nullable and has multiple types
     */
    public function setIsNullable(bool $isNullable): self;

    /**
     * Check if the argument is a reference.
     * 
     * @return bool
     */
    public function isReference(): bool;

    /**
     * Set if the argument is a reference.
     * 
     * @param bool $isReference Is the argument a reference?
     * 
     * @return self
     */
    public function setIsReference(bool $isReference): self;
}
