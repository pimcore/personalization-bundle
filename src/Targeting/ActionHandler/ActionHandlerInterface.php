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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting\ActionHandler;

use Pimcore\Bundle\PersonalizationBundle\Model\Tool\Targeting\Rule;
use Pimcore\Bundle\PersonalizationBundle\Targeting\Model\VisitorInfo;

interface ActionHandlerInterface
{
    /**
     * Applies the action
     */
    public function apply(VisitorInfo $visitorInfo, array $action, ?Rule $rule = null): void;
}
