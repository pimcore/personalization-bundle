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
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

interface EventDispatchingConditionInterface
{
    /**
     * Executed before condition is matched
     */
    public function preMatch(VisitorInfo $visitorInfo, EventDispatcherInterface $eventDispatcher): void;

    /**
     * Executed after condition is matched
     */
    public function postMatch(VisitorInfo $visitorInfo, EventDispatcherInterface $eventDispatcher): void;
}
