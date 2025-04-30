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

use Pimcore\Bundle\PersonalizationBundle\Targeting\Condition\ConditionInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BuildConditionEvent extends Event
{
    private string $type;

    private string $class;

    private array $config;

    private ?ConditionInterface $condition = null;

    public function __construct(string $type, string $class, array $config)
    {
        $this->type = $type;
        $this->class = $class;
        $this->config = $config;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function hasCondition(): bool
    {
        return null !== $this->condition;
    }

    public function getCondition(): ?ConditionInterface
    {
        return $this->condition;
    }

    public function setCondition(ConditionInterface $condition): void
    {
        $this->condition = $condition;

        $this->stopPropagation();
    }
}
