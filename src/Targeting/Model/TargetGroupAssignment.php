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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting\Model;

use Pimcore\Bundle\PersonalizationBundle\Model\Tool\Targeting\TargetGroup;

class TargetGroupAssignment
{
    private TargetGroup $targetGroup;

    private int $count = 1;

    public function __construct(TargetGroup $targetGroup, int $count = 1)
    {
        $this->targetGroup = $targetGroup;

        $this->setCount($count);
    }

    public function getTargetGroup(): TargetGroup
    {
        return $this->targetGroup;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): void
    {
        if ($count < 0) {
            throw new \OutOfBoundsException('Count must be a positive integer');
        }

        $this->count = $count;
    }

    public function inc(int $amount = 1): void
    {
        $this->setCount($this->count += $amount);
    }
}
