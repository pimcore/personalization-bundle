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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting\Storage\Traits;

trait TimestampsTrait
{
    /**
     * @return \DateTimeInterface[]
     */
    private function normalizeTimestamps(?\DateTimeInterface $createdAt = null, ?\DateTimeInterface $updatedAt = null): array
    {
        $now = new \DateTimeImmutable();

        $timestamps = [
            'createdAt' => $now,
            'updatedAt' => $now,
        ];

        if (null !== $createdAt) {
            $timestamps['createdAt'] = $createdAt;
        }

        if (null !== $updatedAt) {
            $timestamps['updatedAt'] = $updatedAt;
        }

        return $timestamps;
    }
}
