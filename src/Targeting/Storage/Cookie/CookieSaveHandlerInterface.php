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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting\Storage\Cookie;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface CookieSaveHandlerInterface
{
    /**
     * Loads data from cookie
     */
    public function load(Request $request, string $scope, string $name): array;

    /**
     * Saves data to cookie
     */
    public function save(Response $response, string $scope, string $name, \DateTimeInterface|int|string $expire, ?array $data): void;
}
