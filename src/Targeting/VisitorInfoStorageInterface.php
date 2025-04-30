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

/**
 * Similar to the TokenStorage for user objects, this contains the current
 * visitorInfo valid for the current request.
 */
interface VisitorInfoStorageInterface
{
    public function getVisitorInfo(): VisitorInfo;

    public function setVisitorInfo(VisitorInfo $visitorInfo): void;

    public function hasVisitorInfo(): bool;
}
