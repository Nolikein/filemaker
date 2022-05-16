<?php

namespace Nolikein\FileMaker;

use InvalidArgumentException;
use Nolikein\FileMaker\Enums\Newline;

abstract class FileMaker implements ContentInterface, NewlineInterface, TabulationInterface, SaveFileInterface
{
    /** @var string The tabulation character */
    const TAB = "\t";

    /** @var string $content The file content */
    protected $content = '';

    /** @var int $tabCount The count of used tabulations */
    protected $tabCount = 0;

    /**
     * @param string $newline The newline character. Must be one of the Newline enum value.
     */
    public function __construct(protected string $newline = Newline::LF)
    {
        $this->setNewlineCharacter($newline);
    }

    /**
     * @inheritDoc
     */
    public static function createFromContent(string $existingContent): static
    {
        $myself = new static();
        $myself->content = $existingContent;
        return $myself;
    }

    /**
     * @inheritDoc
     */
    public function getContent(): string
    {
        return $this->content;
    }


    /**
     * @inheritDoc
     */
    public function addContent(string $content): static
    {
        $this->content .= $content;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getNewlineCharacter(): string
    {
        return $this->newline;
    }

    /**
     * @inheritDoc
     */
    public function setNewlineCharacter(string $newline): static
    {
        if (!Newline::exists($newline)) {
            throw new InvalidArgumentException('Invalid newline character');
        }
        $this->newline = $newline;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addLine(string $content): static
    {
        return $this->addTabulationLevel()->addContent($content)->newline();
    }


    /**
     * @inheritDoc
     */
    public function newline(): static
    {
        $this->content .= $this->newline;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function incrementTabulationCounter(): static
    {
        $this->tabCount++;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function decrementTabulationCounter(): static
    {
        $this->tabCount--;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addTabulationLevel(): static
    {
        $this->content .= str_repeat(self::TAB, $this->tabCount);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addContentWithTabulationLevel(string $content): static
    {
        return $this->addTabulationLevel()->addContent($content);
    }

    /**
     * @inheritDoc
     */
    public function addTabulationSection(callable $actions): static
    {
        $this->tabCount++;
        $actions($this);
        $this->tabCount--;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function saveAt(string $path): void
    {
        if(file_exists($path) && !is_writable($path)) {
            throw new \RuntimeException('File is not writable');
        }
        file_put_contents($path, $this->content);
    }
}
