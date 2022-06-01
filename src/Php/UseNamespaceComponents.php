<?php

namespace Nolikein\FileMaker\Php;

trait UseNamespaceComponents
{
    /**
     * Add a namespace.
     * 
     * @param string $namespace The namespace to add
     * 
     * @return static
     */
    public function addNamespace(string $namespace): static
    {
        return $this->addInstruction('namespace ' . $namespace);
    }

    /**
     * Add a use statement.
     * 
     * @param string|array $namespace The namespace to use (array support aliasing)
     * 
     * @example string "App" give 'use App;'
     * @example array "['App' => 'Delta']" give 'use App as Delta;'
     * 
     * @return static
     */
    public function addUseStatement(array|string $class): static
    {
        // Conversion to array
        if (is_string($class)) {
            $class = [$class];
        }
        // Add use instruction
        foreach ($class as $key => $value) {
            // String key mean the user setted a use with an alias
            if (is_string($key)) {
                $this->addInstruction('use ' . $key . ' as ' . $value);
            } else {
                $this->addInstruction('use ' . $value);
            }
        }
        return $this;
    }
}
