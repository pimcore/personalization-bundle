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

/**
 * Defines a component which depends on data providers. Currently supported for
 *
 *  - Conditions
 *  - Data Providers (depending on other data providers)
 *  - Action Handlers
 */
interface DataProviderDependentInterface
{
    /**
     * Returns keys of data providers which this component depends on.
     *
     */
    public function getDataProviderKeys(): array;
}
