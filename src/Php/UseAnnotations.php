<?php

namespace Nolikein\FileMaker\Php;

trait UseAnnotations
{
    /**
     * @param array<string> $annotations The annotations to add
     */
    public function addAnnotationBloc(array $annotations): static
    {
        $this->addLine('/**');
        for ($i = 0; $i < count($annotations); $i++) {
            // If annotation begin by @, jump a new line
            if ($i > 0 && strpos($annotations[$i], '@') === 0) {
                $this->addLine(' *');
            }
            $this->addLine(' * ' . $annotations[$i]);
        }
        $this->addLine(' */');
        return $this;
    }
}
