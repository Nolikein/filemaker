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
     * @param string|array $namespace The namespace to use
     * 
     * @return static
     */
    public function addUseStatement(array|string $class): static
    {
        if (is_array($class)) {
            foreach ($class as $curClass) {
                $this->addInstruction('use ' . $curClass);
            }
        } else {
            $this->addInstruction('use ' . $class);
        }
        return $this;
    }
}
