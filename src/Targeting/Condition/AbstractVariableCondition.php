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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting\Condition;

abstract class AbstractVariableCondition implements ConditionInterface, VariableConditionInterface
{
    /**
     * @var array<string, mixed>
     */
    private array $variables = [];

    public function getMatchedVariables(): array
    {
        return $this->variables;
    }

    final protected function setMatchedVariables(array $variables): void
    {
        $this->variables = $variables;
    }

    final protected function setMatchedVariable(string $key, mixed $value): void
    {
        $this->variables[$key] = $value;
    }
}
