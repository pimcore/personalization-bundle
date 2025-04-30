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
use Pimcore\Bundle\PersonalizationBundle\Targeting\Service\VisitedPagesCounter as VisitedPagesCounterService;

class VisitedPagesCounter implements DataProviderInterface
{
    const PROVIDER_KEY = 'visited_pages_counter';

    private VisitedPagesCounterService $service;

    public function __construct(VisitedPagesCounterService $service)
    {
        $this->service = $service;
    }

    public function load(VisitorInfo $visitorInfo): void
    {
        $visitorInfo->set(self::PROVIDER_KEY, $this->service);
    }
}
