<?php

namespace Nolikein\FileMaker\Php\VariableToolkit;

interface VariableInterface
{
    /**
     * Get the property name.
     * 
     * @return string
     */
    public function getName(): string;

    /**
     * Set the property name.
     * 
     * @param string $name The property name
     * 
     * @return self
     * 
     * @throws \InvalidArgumentException If the name is not valid
     */
    public function setName(string $name): self;

    /**
     * Get the property types.
     * 
     * @return array
     * 
     */
    public function getTypes(): array;

    /**
     * Add a property type.
     * 
     * @param string $type The property type
     * 
     * @return self
     * 
     * @throws \InvalidArgumentException If the argument types are not valid
     * @throws \InvalidArgumentException If the argument type is already set
     */
    public function addType(string $type): self;

    /**
     * Set the property types.
     * 
     * @param array $types The property types
     * 
     * @return self
     */
    public function setTypes(array $types): self;

    /**
     * Checks if the variable has any type.
     * 
     * @return bool
     */
    public function hasType(): bool;

    /**
     * Get the property default value.
     * 
     * @return mixed
     */
    public function getDefaultValue();

    /**
     * Set the property default value.
     * 
     * @param mixed $defaultValue The property default value
     * 
     * @return self
     */
    public function setDefaultValue($defaultValue): self;

    /**
     * Checks if the argument has a default value.
     * 
     * @return bool
     */
    public function hasDefaultValue(): bool;
}
