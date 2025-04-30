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

/**
 * NOTE: using this save handler is inherently insecure and can open vulnerabilities by injecting malicious data into the
 * client cookie. Use only for testing!
 */
class JsonCookieSaveHandler extends AbstractCookieSaveHandler
{
    protected function parseData(string $scope, string $name, ?string $data): array
    {
        if (null === $data) {
            return [];
        }

        $json = json_decode($data, true);
        if (is_array($json)) {
            return $json;
        }

        return [];
    }

    protected function prepareData(string $scope, string $name, \DateTimeInterface|int|string $expire, ?array $data): bool|string|null
    {
        if (empty($data)) {
            return null;
        }
        $preparedData = json_encode($data);

        return json_encode($data);
    }
}
