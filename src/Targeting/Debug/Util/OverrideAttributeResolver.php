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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting\Debug\Util;

use Pimcore\Bundle\PersonalizationBundle\Targeting\OverrideHandlerInterface;
use Symfony\Component\HttpFoundation\Request;

class OverrideAttributeResolver
{
    public static function setOverrideValue(Request $request, string $key, mixed $value): void
    {
        $overrides = $request->attributes->get(OverrideHandlerInterface::REQUEST_ATTRIBUTE, []);
        $overrides[$key] = $value;

        $request->attributes->set(OverrideHandlerInterface::REQUEST_ATTRIBUTE, $overrides);
    }

    public static function getOverrideValue(Request $request, string $key, mixed $default = null): mixed
    {
        $overrides = $request->attributes->get(OverrideHandlerInterface::REQUEST_ATTRIBUTE, []);

        return $overrides[$key] ?? $default;
    }
}
