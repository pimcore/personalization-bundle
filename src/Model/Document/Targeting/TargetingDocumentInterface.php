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

namespace Pimcore\Bundle\PersonalizationBundle\Model\Document\Targeting;

use Pimcore\Model\Element\ElementInterface;

interface TargetingDocumentInterface extends ElementInterface
{
    const TARGET_GROUP_EDITABLE_PREFIX = 'persona_-';

    const TARGET_GROUP_EDITABLE_SUFFIX = '-_';

    /**
     * Build target group element prefix for a given target group or for
     * the configured one if $targetGroupId is null and there is a configured
     * target group.
     *
     *
     */
    public function getTargetGroupEditablePrefix(?int $targetGroupId = null): string;

    /**
     * Adds target group prefix to element name if it is not already prefixed and
     * if a target group is set.
     *
     *
     */
    public function getTargetGroupEditableName(string $name): string;

    /**
     * Sets the target group to use
     *
     */
    public function setUseTargetGroup(?int $useTargetGroup = null): void;

    /**
     * Returns the target group to use
     *
     */
    public function getUseTargetGroup(): ?int;

    /**
     * Checks if the document has targeting specific elements
     *
     */
    public function hasTargetGroupSpecificEditables(): bool;

    /**
     * Returns targeting specific element names
     *
     */
    public function getTargetGroupSpecificEditableNames(): array;
}
