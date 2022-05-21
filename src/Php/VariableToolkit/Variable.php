<?php

namespace Nolikein\FileMaker\Php\VariableToolkit;

use Nolikein\FileMaker\Enums\PhpTypes;
use RuntimeException;

class Variable implements VariableInterface
{
    /** @var array $types The property types */
    protected array $types = [];

    /** @var bool $hasDefaultValue Tells if the current variable has a setted default value */
    protected $hasDefaultValue = false;

    /**
     * @param string $name The name of the property
     * @param array<string>|string $types The property types
     * @param mixed $defaultValue The default value of the property
     * @param bool $defaultValueIsNull Allow a null default value to be defined
     */
    public function __construct(
        protected string $name,
        array|string $types = [],
        protected mixed $defaultValue = null,
        bool $defaultValueIsNull = false
    ) {
        $this->setName($name);
        if (is_array($types)) {
            $this->setTypes($types);
        } else {
            $this->setTypes([$types]);
        }
        if ($defaultValue !== null || $defaultValueIsNull) {
            $this->setDefaultValue($defaultValue);
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
        if (in_array($type, $this->types)) {
            throw new \InvalidArgumentException('The type "' . $type . '" has been already set');
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

    public function hasType(): bool
    {
        return !empty($this->types);
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
        // Check if the type is valid
        if ($this->hasType() && $defaultValue !== null) {
            $isWellTyped = false;
            foreach ($this->getTypes() as $type) {
                if ($type === gettype($defaultValue)) {
                    $isWellTyped = true;
                }
            }
            if (!$isWellTyped) {
                throw new \InvalidArgumentException('The default value of the ' . $this->name . ' variable must be of any of these types : ' . implode(', ', $this->types) . '. Got ' . gettype($defaultValue));
            }
        }

        $this->defaultValue = $defaultValue;
        $this->hasDefaultValue = true;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hasDefaultValue(): bool
    {
        return $this->hasDefaultValue;
    }
}
