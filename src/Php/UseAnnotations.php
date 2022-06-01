<?php

namespace Nolikein\FileMaker\Php;

use InvalidArgumentException;
use RuntimeException;

trait UseAnnotations
{
    /**
     * @param array<string> $annotations The annotations to add
     */
    public function addAnnotationBloc(string|array $annotations): static
    {
        // Add the annotation header
        $this->addLine('/**');
        $lastAnnotationType = '';

        // The next instruction will only support array. So we convert it to it
        if (is_string($annotations)) {
            $annotations = [$annotations];
        }

        // Add the annotation text
        for ($i = 0; $i < count($annotations); $i++) {
            if (!is_string($annotations[$i])) {
                throw new InvalidArgumentException('You given an annotation bloc with other type than string.');
            }
            $currentAnnotation = trim($annotations[$i]);

            // If the annotation has a specific type...
            if ($this->annotationHasType($currentAnnotation)) {
                // And if the annotation is not the first element and the type is different from the previous, jump a newline
                if ($i > 0 && $lastAnnotationType !== $this->getAnnotationType($currentAnnotation)) {
                    $this->addLine(' *');
                }
                // Mean for the next iteration, the previous iteration had an annotation type
                $lastAnnotationType = $this->getAnnotationType($currentAnnotation);
            } else {
                // Mean for the next iteration, the previous iteration had no type
                $lastAnnotationType = '';
            }

            // Add the line
            $this->addLine(' * ' . $currentAnnotation);
        }
        // Add the annotation footer
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
