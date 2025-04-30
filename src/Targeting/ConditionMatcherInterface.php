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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting;

use Pimcore\Bundle\PersonalizationBundle\Targeting\Model\VisitorInfo;

interface ConditionMatcherInterface
{
    /**
     * Matches a visitor info against a list of condition configurations (as configured via UI)
     *
     *
     */
    public function match(VisitorInfo $visitorInfo, array $configs, bool $collectVariables = false): bool;

    /**
     * Returns collected variables from last match
     *
     */
    public function getCollectedVariables(): array;
}
