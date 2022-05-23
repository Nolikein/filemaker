<?php

namespace Nolikein\FileMaker\Php\FunctionToolkit;

/**
 * Define a function into a PHP file.
 */
class FunctionPattern implements FunctionPatternInterface
{
    /**
     * @param string $name The function name
     * @param Argument[] $arguments The function arguments
     * @param ReturnType $returnType The function return type
     * @param \Closure  $actions The function actions. Use Closure because can't use the callable type for object properties.
     */
    public function __construct(
        protected string $name,
        protected array $arguments = [],
        protected ReturnType|null $returnType = null,
        protected \Closure|null $actions = null
    ) {
        $this->setName($name);
        $this->setArguments($arguments);
        if ($returnType !== null) {
            $this->setReturnType($returnType);
        }
        if ($actions !== null) {
            $this->setActions($actions);
        }
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * @inheritDoc
     */
    public function getReturnType(): ?ReturnType
    {
        return $this->returnType;
    }

    /**
     * @inheritDoc
     */
    public function getActions(): ?callable
    {
        return $this->actions;
    }

    /**
     * @inheritDoc
     */
    public function setName(string $name): self
    {
        if (!preg_match('/[a-zA-Z_]{1}[a-zA-Z0-9_]*/', $name)) {
            throw new \InvalidArgumentException('Function name must contain only letters, numbers and underscores. Also cannot contain a number as first character.');
        }
        $this->name = lcfirst($name);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addArgument(Argument $argument): self
    {
        if (empty($this->arguments)) {
            $this->arguments[] = $argument;
        } else {
            // Check the argument name is not already used
            foreach ($this->arguments as $arg) {
                if ($arg->getName() === $argument->getName()) {
                    throw new \LogicException('Argument name already used.');
                }
            }
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setArguments(array $arguments): self
    {
        $this->arguments = [];
        foreach ($arguments as $argument) {
            $this->addArgument($argument);
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setReturnType(ReturnType $returnType): self
    {
        $this->returnType = $returnType;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setActions(callable $actions): self
    {
        $this->actions = $actions;
        return $this;
    }


    /**
     * @inheritDoc
     */
    public function hasReturnType(): bool
    {
        return $this->returnType !== null;
    }

    /**
     * @inheritDoc
     */
    public function hasActions(): bool
    {
        return $this->actions !== null;
    }
}
