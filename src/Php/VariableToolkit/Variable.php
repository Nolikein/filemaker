<?php

namespace Nolikein\FileMaker\Php\VariableToolkit;

use Nolikein\FileMaker\Enums\PhpTypes;

class Variable implements VariableInterface
{
    /** @var array $types The property types */
    protected array $types = [];

    /**
     * @param string $name The name of the property
     * @param array<string>|string $types The property types
     * @param mixed $defaultValue The default value of the property
     */
    public function __construct(
        protected string $name,
        array|string $types,
        protected mixed $defaultValue,
    ) {
        $this->setName($name);
        if (is_array($types)) {
            $this->setTypes($types);
        } else {
            $this->setTypes([$types]);
        }
        $this->setDefaultValue($defaultValue);
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
    public function setName(string $name): self
    {
        // Trim the $ character from the name
        $name = trim($name, '$');

        // Check the name is valid
        if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $name)) {
            throw new \InvalidArgumentException('Invalid name "' . $name . '"');
        }
        $this->name = $name;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getTypes(): array
    {
        return $this->types;
    }

    /**
     * @inheritDoc
     */
    public function addType(string $type): self
    {
        if (!PhpTypes::exists($type)) {
            throw new \InvalidArgumentException('The type "' . $type . '" is not valid');
        }
        $this->types[] = $type;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setTypes(array $types): self
    {
        foreach ($types as $type) {
            $this->addType($type);
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * @inheritDoc
     */
    public function setDefaultValue($defaultValue): self
    {
        // Prevent the default value from being null
        if (!is_null($defaultValue)) {
            // Remove quotes when string
            if (is_string($defaultValue)) {
                $defaultValue = trim($defaultValue, '"\'');
            }
            $this->defaultValue = var_export($defaultValue, true);
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hasDefaultValue(): bool
    {
        return !is_null($this->defaultValue);
    }
}
