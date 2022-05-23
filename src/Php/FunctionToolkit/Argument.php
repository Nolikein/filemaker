<?php

namespace Nolikein\FileMaker\Php\FunctionToolkit;

use Nolikein\FileMaker\Enums\PhpTypes;
use Nolikein\FileMaker\Php\VariableToolkit\Variable;

class Argument extends Variable implements ArgumentInterface
{
    /**
     * @param string $name The name of the argument
     * @param array<string>|string $type The argument type or types (with PHP 8.0)
     * @param string $defaultValue The default value of the argument
     * @param bool $isNullable Is the argument nullable?
     * @param bool $isReference Is the argument a reference?
     */
    public function __construct(
        string $name,
        array|string $types,
        mixed $defaultValue = null,
        private bool $isNullable = false,
        private bool $isReference = false
    ) {
        parent::__construct($name, $types, $defaultValue);
        $this->setIsNullable($isNullable);
        $this->setIsReference($isReference);
    }

    /**
     * @inheritDoc
     */
    public function isNullable(): bool
    {
        return $this->isNullable;
    }

    /**
     * @inheritDoc
     */
    public function setIsNullable(bool $isNullable): self
    {
        // If the types variable has more than one type, the argument cannot be nullable
        if ($isNullable) {
            if (empty($this->types)) {
                throw new \InvalidArgumentException('Argument "' . $this->name . '" cannot be nullable if it has no type');
            }
            if (count($this->types) > 1) {
                throw new \InvalidArgumentException('Argument "' . $this->name . '" cannot be nullable if it has more than one type');
            }
        }
        $this->isNullable = $isNullable;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isReference(): bool
    {
        return $this->isReference;
    }

    /**
     * @inheritDoc
     */
    public function setIsReference(bool $isReference): self
    {
        $this->isReference = $isReference;
        return $this;
    }
}
