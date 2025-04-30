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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting\Service;

use Pimcore\Http\RequestHelper;

class TargetingEnableService
{
    private RequestHelper $requestHelper;

    private bool $enabled;

    public function __construct(RequestHelper $requestHelper, bool $enabled)
    {
        $this->enabled = $enabled;
        $this->requestHelper = $requestHelper;
    }

    public function isTargetingEnabled(): bool
    {
        $request = $this->requestHelper->getCurrentRequest();

        if ($this->enabled || $request->cookies->getBoolean('pimcore_targeting_enabled')) {
            return true;
        }

        return false;
    }
}
