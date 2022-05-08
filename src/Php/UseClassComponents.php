<?php

namespace Nolikein\FileMaker\Php;

use Nolikein\FileMaker\Php\FunctionToolkit\MethodPattern;
use Nolikein\FileMaker\Php\VariableToolkit\Property;

trait UseClassComponents
{
    /**
     * Add a class section.
     * 
     * @param string $className The class name
     * @param callable $action The action to perform
     * 
     * @return static
     */
    public function addClassSection(string $className, callable $actions): static
    {
        // Transform className into PascalCase
        $className = ucfirst($className);

        // Add class declaration and content
        return $this
            ->addLine('class ' . $className)
            ->addBracketSection(function ($maker) use ($actions) {
                $actions($maker);
            });
    }

    public function addProperty(Property $property): static
    {
        $this->addInstruction($property->getVisibility() . ' ' . implode('|', $property->getTypes()) . ' $' . $property->getName() . ($property->hasDefaultValue() ? ' = ' . $property->getDefaultValue() : ''));
        return $this;
    }

    public function addMethod(MethodPattern $method): static
    {
        // Add the function header
        $this->addContentWithTabulationLevel($method->getVisibility() . ' function ' . $method->getName() . '(');
        foreach ($method->getArguments() as $argument) {
            // If the argument is nullable, add the question mark
            if ($argument->isNullable()) {
                $this->addContent('?');
            }
            // Add the current argument type and name parts
            $this->addContent(implode('|', $argument->getTypes()) . ' ' . ($argument->isReference() ? '&$' : '$') . $argument->getName());
            // Add the default value if it exists
            if ($argument->hasDefaultValue()) {
                $this->addContent(' = ' . $argument->getDefaultValue());
            }
            // Add a comma at the end of the argument (even if its not the last one)
            $this->addContent(', ');
        }
        // Remove the last comma that separe the arguments
        $this->content = rtrim($this->content, ', ');

        // Add the end of function and the return type
        $this->addContent(')');
        // Add the return type if it exists
        if ($method->hasReturnType()) {
            $this->addContent(' : ' . ($method->getReturnType()->isNullable() ? '?' : '') . $method->getReturnType()->getType());
        }
        $this->newline();

        // Add the function content
        $this->addBracketSection(function ($maker) use ($method) {
            if ($method->hasActions()) {
                $method->getActions()($maker);
            } else {
                $maker->addLine('# Add your code here');
            }
        });
        return $this;
    }
}
