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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting\Maintenance;

use Pimcore\Bundle\PersonalizationBundle\Targeting\Storage\MaintenanceStorageInterface;
use Pimcore\Bundle\PersonalizationBundle\Targeting\Storage\TargetingStorageInterface;
use Pimcore\Maintenance\TaskInterface;

class TargetingStorageTask implements TaskInterface
{
    private TargetingStorageInterface $targetingStorage;

    public function __construct(TargetingStorageInterface $targetingStorage)
    {
        $this->targetingStorage = $targetingStorage;
    }

    public function execute(): void
    {
        if (!$this->targetingStorage instanceof MaintenanceStorageInterface) {
            return;
        }

        $this->targetingStorage->maintenance();
    }
}
