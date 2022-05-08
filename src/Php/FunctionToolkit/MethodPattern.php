<?php

namespace Nolikein\FileMaker\Php\FunctionToolkit;

/**
 * Define a method into a PHP file.
 */
class MethodPattern extends FunctionPattern implements FunctionPatternInterface
{
    /**
     * @param string $name The function name
     * @param Argument[] $arguments The function arguments
     * @param ReturnType $returnType The function return type
     * @param \Closure  $actions The function actions
     */
    public function __construct(
        string $name,
        array $arguments,
        ReturnType $returnType,
        \Closure $actions,
        protected string $visibility = 'public'
    ) {
        parent::__construct($name, $arguments, $returnType, $actions);
        $this->setVisibility($visibility);
    }

    /**
     * Get the function visibility.
     * 
     * @return string
     */
    public function getVisibility(): string
    {
        return $this->visibility;
    }

    /**
     * Set the function visibility.
     * 
     * @param string $visibility The function visibility
     * 
     * @return self
     * 
     * @throws \InvalidArgumentException If the function visibility is not valid
     */
    public function setVisibility(string $visibility): self
    {
        if(!in_array($visibility, ['public', 'protected', 'private'])) {
            throw new \InvalidArgumentException('Invalid visibility');
        }
        $this->visibility = $visibility;
        return $this;
    }

}
