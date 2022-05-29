<?php

namespace Nolikein\FileMaker\Php;

use Nolikein\FileMaker\Php\FunctionToolkit\FunctionPattern;

trait UsePhpBasics
{
    /**
     * Add the PHP header
     */
    public function addPhpHeader()
    {
        $this->content .= '<?php' . $this->newline;
    }

    /**
     * Add a php instruction.
     * 
     * @param string $instruction The php instruction to add
     * 
     * @return static
     */
    public function addInstruction(string $instruction): static
    {
        return $this->addLine(rtrim($instruction, ';') . ';');
    }

    /**
     * Add a Bracket section.
     * 
     * @param callable $callback The callback to use to add the content in the bracket.
     * 
     * @return static
     */
    public function addBracketSection(callable $actions, bool $avoidBeginningTabulation = false): static
    {
        if ($avoidBeginningTabulation) {
            $this->addContent('{')->newline();
        } else {
            $this->addLine('{');
        }

        $this->addTabulationSection(function ($maker) use ($actions) {
            $actions($maker);
        });
        $this->addLine('}');
        return $this;
    }

    /**
     * Add a function.
     */
    public function addFunction(FunctionPattern $function): static
    {
        // Add the function header
        $this->addContentWithTabulationLevel('function ' . $function->getName() . '(');
        foreach ($function->getArguments() as $argument) {
            // If the argument is nullable, add the question mark
            if ($argument->isNullable()) {
                $this->addContent('?');
            }
            // Add the current argument type and name parts
            $this->addContent(implode('|', $argument->getTypes()) . ' ' . ($argument->isReference() ? '&$' : '$') . $argument->getName());
            // Add the default value if it exists
            if ($argument->hasDefaultValue()) {
                $this->addContent(' = ' . var_export($argument->getDefaultValue(), true));
            }
            // Add a comma at the end of the argument (even if its not the last one)
            $this->addContent(', ');
        }
        // Remove the last comma that separe the arguments
        $this->content = rtrim($this->content, ', ');

        // Add the end of function and the return type
        $this->addContent(')');
        // Add the return type if it exists
        if ($function->hasReturnType()) {
            $this->addContent(': ' . ($function->getReturnType()->isNullable() ? '?' : '') . $function->getReturnType()->getType());
        }
        $this->newline();

        // Add the function content
        $this->addBracketSection(function ($maker) use ($function) {
            if ($function->hasActions()) {
                $function->getActions()($maker);
            } else {
                $maker->addLine('# Add your code here');
            }
        });

        return $this;
    }
}
