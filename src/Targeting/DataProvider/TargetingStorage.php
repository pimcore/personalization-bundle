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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting\DataProvider;

use Pimcore\Bundle\PersonalizationBundle\Targeting\Model\VisitorInfo;
use Pimcore\Bundle\PersonalizationBundle\Targeting\Storage\TargetingStorageInterface;

class TargetingStorage implements DataProviderInterface
{
    const PROVIDER_KEY = 'targeting_storage';

    private TargetingStorageInterface $storage;

    public function __construct(TargetingStorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function load(VisitorInfo $visitorInfo): void
    {
        $visitorInfo->set(self::PROVIDER_KEY, $this->storage);
    }
}
