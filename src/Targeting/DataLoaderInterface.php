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

use Pimcore\Bundle\PersonalizationBundle\Targeting\DataProvider\DataProviderInterface;
use Pimcore\Bundle\PersonalizationBundle\Targeting\Model\VisitorInfo;

interface DataLoaderInterface
{
    /**
     * Loads data from given data providers while taking
     * data provider dependencies into account
     */
    public function loadDataFromProviders(VisitorInfo $visitorInfo, array|string $providerKeys): void;

    /**
     * Checks if a data provider is registered
     */
    public function hasDataProvider(string $type): bool;

    /**
     * Returns the data provider instance identified by name
     */
    public function getDataProvider(string $type): DataProviderInterface;
}
