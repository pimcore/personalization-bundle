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

use Pimcore\Bundle\PersonalizationBundle\Targeting\Model\VisitorInfo;

class TargetGroup extends AbstractVariableCondition implements ConditionInterface
{
    private ?int $targetGroupId = null;

    public function __construct(?int $targetGroupId = null)
    {
        $this->targetGroupId = $targetGroupId;
    }

    public static function fromConfig(array $config): self
    {
        return new self($config['targetGroup'] ?? null);
    }

    public function canMatch(): bool
    {
        return null !== $this->targetGroupId && $this->targetGroupId > 0;
    }

    public function match(VisitorInfo $visitorInfo): bool
    {
        foreach ($visitorInfo->getAssignedTargetGroups() as $targetGroup) {
            if ($targetGroup->getId() === $this->targetGroupId) {
                $this->setMatchedVariable('target_group_id', $targetGroup->getId());

                return true;
            }
        }

        return false;
    }
}
