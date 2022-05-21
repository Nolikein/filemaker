<?php

namespace Nolikein\FileMaker\Php\VariableToolkit;

class Property extends Variable implements PropertyInterface
{
    const VISIBILITIES = ['public', 'protected', 'private'];
    /**
     * @param string $name The name of the property
     * @param array<string>|string $types The property types
     * @param mixed $defaultValue The default value of the property
     * @param string $visibility The visibility of the property
     */
    public function __construct(
        string $name,
        array|string $types = [],
        mixed $defaultValue = null,
        protected string $visibility = 'public'
    ) {
        parent::__construct($name, $types, $defaultValue);
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
        if (!in_array($visibility, self::VISIBILITIES)) {
            throw new \InvalidArgumentException('The property "' . $this->name . '" has an invalid visibility. Got "' . $visibility . '" but only can select ' . implode(', ', self::VISIBILITIES) . '.');
        }
        $this->visibility = $visibility;
        return $this;
    }
}
