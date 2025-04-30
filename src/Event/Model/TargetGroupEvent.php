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

namespace Pimcore\Bundle\PersonalizationBundle\Event\Model;

use Pimcore\Bundle\PersonalizationBundle\Model\Tool\Targeting\TargetGroup;
use Symfony\Contracts\EventDispatcher\Event;

class TargetGroupEvent extends Event
{
    protected TargetGroup $targetGroup;

    protected array $arguments;

    /**
     * TargetGroupEvent constructor.
     *
     */
    public function __construct(TargetGroup $targetGroup, array $arguments = [])
    {
        $this->targetGroup = $targetGroup;
        $this->arguments = $arguments;
    }

    public function getTargetGroup(): TargetGroup
    {
        return $this->targetGroup;
    }

    public function setTargetGroup(TargetGroup $targetGroup): void
    {
        $this->targetGroup = $targetGroup;
    }

    public function getElement(): TargetGroup
    {
        return $this->getTargetGroup();
    }
}
