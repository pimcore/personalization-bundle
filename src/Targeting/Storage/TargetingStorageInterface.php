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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting\Storage;

use Pimcore\Bundle\PersonalizationBundle\Targeting\Model\VisitorInfo;

/**
 * This defines the interface for a persistent targeting storage (e.g. Session). The targeting storage needs to define
 * by itself if it needs a unique visitor ID to store data and fetch if from the visitor info itself.
 */
interface TargetingStorageInterface
{
    const SCOPE_SESSION = 'session';

    const SCOPE_VISITOR = 'visitor';

    const VALID_SCOPES = [
        self::SCOPE_SESSION,
        self::SCOPE_VISITOR,
    ];

    /**
     * The meta entry does not store any data, but can be used if a value is needed for metadata handling. Use cases:
     *
     *  - write an entry to make sure the storage has a created/updated date
     *  - set the entry created date to something in the past when migrating from another storage
     */
    const STORAGE_KEY_META_ENTRY = '_m';

    public function all(VisitorInfo $visitorInfo, string $scope): array;

    public function has(VisitorInfo $visitorInfo, string $scope, string $name): bool;

    public function set(VisitorInfo $visitorInfo, string $scope, string $name, mixed $value): void;

    public function get(VisitorInfo $visitorInfo, string $scope, string $name, mixed $default = null): mixed;

    public function clear(VisitorInfo $visitorInfo, ?string $scope = null): void;

    public function migrateFromStorage(TargetingStorageInterface $storage, VisitorInfo $visitorInfo, string $scope): void;

    public function getCreatedAt(VisitorInfo $visitorInfo, string $scope): ?\DateTimeImmutable;

    public function getUpdatedAt(VisitorInfo $visitorInfo, string $scope): ?\DateTimeImmutable;
}
