<?php

declare(strict_types=1);

/**
 * This source file is available under the terms of the
 * Pimcore Open Core License (POCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (https://www.pimcore.com)
 *  @license    Pimcore Open Core License (POCL)
 */

namespace Pimcore\Bundle\PersonalizationBundle\Event\Targeting;

use Pimcore\Bundle\PersonalizationBundle\Targeting\Code\CodeBlock;
use Symfony\Contracts\EventDispatcher\Event;

class TargetingCodeEvent extends Event
{
    /**
     * @var CodeBlock[]
     */
    private array $blocks;

    private string $template;

    private array $data;

    /**
     * @param CodeBlock[] $blocks
     */
    public function __construct(
        string $template,
        array $blocks,
        array $data
    ) {
        $this->template = $template;
        $this->blocks = $blocks;
        $this->data = $data;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function setTemplate(string $template): void
    {
        $this->template = $template;
    }

    /**
     * @return CodeBlock[]
     */
    public function getBlocks(): array
    {
        return $this->blocks;
    }

    public function getBlock(string $block): CodeBlock
    {
        if (!isset($this->blocks[$block])) {
            throw new \InvalidArgumentException(sprintf('Invalid block "%s"', $block));
        }

        return $this->blocks[$block];
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }
}
