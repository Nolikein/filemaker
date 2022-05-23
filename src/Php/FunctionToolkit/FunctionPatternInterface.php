<?php

namespace Nolikein\FileMaker\Php\FunctionToolkit;

interface FunctionPatternInterface
{
    /**
     * Get the function name.
     * 
     * @return string
     */
    public function getName(): string;

    /**
     * Get the function arguments.
     * 
     * @return Argument[]
     */
    public function getArguments(): array;

    /**
     * Get the function return type.
     * 
     * @return ReturnType
     */
    public function getReturnType(): ?ReturnType;

    /**
     * Get the actions to do inside the function. The actions are executed
     * in the context of the maker.
     * 
     * @return callable
     */
    public function getActions(): ?callable;

    /**
     * Set the function name.
     * 
     * @param string $name The function name
     * 
     * @return self
     * 
     * @throws \InvalidArgumentException If the function name is not valid
     */
    public function setName(string $name): self;

    /**
     * Add an argument to the function.
     * 
     * @param Argument $argument The argument to add
     * 
     * @return self
     * 
     * @throws \LogicException If the argument is already set
     */
    public function addArgument(Argument $argument): self;
    
    /**
     * Add the arguments to the function.
     * 
     * @param Argument[] $arguments The arguments to add
     * 
     * @return self
     */
    public function setArguments(array $arguments): self;

    /**
     * Set the function return type.
     * 
     * @param ReturnType $returnType The function return type
     * 
     * @return self
     */
    public function setReturnType(ReturnType $returnType): self;

    /**
     * Set the actions to do inside the function. The actions are executed in the context of the maker.
     * 
     * @param callable $actions The actions to do inside the function
     * 
     * @return self
     */
    public function setActions(callable $actions): self;

    /**
     * Check if the function has a return type.
     * 
     * @return bool
     */
    public function hasReturnType(): bool;

    /**
     * Check if the function has actions.
     * 
     * @return bool
     */
    public function hasActions(): bool;
}