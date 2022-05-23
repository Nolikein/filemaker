<?php

namespace Nolikein\FileMaker\Php\FunctionToolkit;

use Nolikein\FileMaker\Enums\PhpTypes;

class ReturnType
{
    /**
     * @param string $type The type of the return type
     * @param bool $isNullable Is the return type nullable?
     */
    public function __construct(
        private string $type,
        private bool $isNullable = false
    ) {
        $this->setType($type);
        $this->setIsNullable($isNullable);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type The type of the return type
     */
    public function setType(string $type): void
    {
        // Check if the type is valid
        if (!PhpTypes::exists($type)) {
            throw new \InvalidArgumentException('The type must be one of the following: ' . implode(', ', PhpTypes::all()));
        }
        $this->type = $type;
    }

    /**
     * @return bool
     */

    public function isNullable(): bool
    {
        return $this->isNullable;
    }

    /**
     * @param bool $isNullable Is the return type nullable?
     */
    public function setIsNullable(bool $isNullable): void
    {
        $this->isNullable = $isNullable;
    }
}
