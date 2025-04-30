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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting\Storage;

interface MaintenanceStorageInterface
{
    /**
     * Runs maintenance tasks which can be potentially heavy and should only be executed
     * asynchronously (e.g. in maintenance task).
     */
    public function maintenance(): void;
}
