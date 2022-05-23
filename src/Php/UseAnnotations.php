<?php

namespace Nolikein\FileMaker\Php;

use InvalidArgumentException;
use RuntimeException;

trait UseAnnotations
{
    /**
     * @param array<string> $annotations The annotations to add
     */
    public function addAnnotationBloc(array $annotations): static
    {
        $this->addLine('/**');
        $lastAnnotationType = '';
        for ($i = 0; $i < count($annotations); $i++) {
            if (!is_string($annotations[$i])) {
                throw new InvalidArgumentException('You given an annotation bloc with other type than string.');
            }
            $currentAnnotation = trim($annotations[$i]);

            // If the annotation has a specific type
            if ($i > 0 && $this->annotationHasType($currentAnnotation)) {
                // And if the annotation type is different from the old, jump a newline
                if ($lastAnnotationType !== $this->getAnnotationType($currentAnnotation)) {
                    $this->addLine(' *');
                }
                // The current annot will be check as last annot at the next iteration
                $lastAnnotationType = $this->getAnnotationType($currentAnnotation);
            }

            $this->addLine(' * ' . $currentAnnotation);
        }
        $this->addLine(' */');
        return $this;
    }

    /**
     * Checks if the annotation line is a specific command like @ argument
     * 
     * @param string $annotation The annotation to check
     * 
     * @return bool
     */
    private function annotationHasType(string $annotation): bool
    {
        return strpos($annotation, '@') === 0 && strlen($annotation) >= 2;
    }

    /**
     * Get the type of the annotation.
     * 
     * @param string $annotation The annotation to check
     * 
     * @return string
     */
    private function getAnnotationType(string $annotation): string
    {
        if (!$this->annotationHasType($annotation)) {
            return '';
        }
        if (($firstSpace = strpos($annotation, ' ')) === false) {
            return '';
        }
        return substr($annotation, 0, $firstSpace);
    }
}
