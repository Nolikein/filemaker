<?php

namespace Nolikein\FileMaker\Php\FunctionToolkit;

/**
 * Define a method into a PHP file.
 */
class MethodPattern extends FunctionPattern implements MethodPatternInterface
{
    /**
     * @param string $name The function name
     * @param Argument[] $arguments The function arguments
     * @param ReturnType $returnType The function return type
     * @param \Closure  $actions The function actions
     */
    public function __construct(
        string $name,
        array $arguments = [],
        ReturnType|null $returnType = null,
        \Closure|null $actions = null,
        protected string $visibility = 'public'
    ) {
        parent::__construct($name, $arguments, $returnType, $actions);
        $this->setVisibility($visibility);
    }

    /**
     * @inheritDoc
     */
    public function getVisibility(): string
    {
        return $this->visibility;
    }

    /**
     * @inheritDoc
     */
    public function setVisibility(string $visibility): self
    {
        if (!in_array($visibility, ['public', 'protected', 'private'])) {
            throw new \InvalidArgumentException('Invalid visibility "' . $visibility . '".');
        }
        $this->visibility = $visibility;
        return $this;
    }
}
