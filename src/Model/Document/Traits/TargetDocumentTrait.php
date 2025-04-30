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

namespace Pimcore\Bundle\PersonalizationBundle\Model\Document\Traits;

use Pimcore\Bundle\PersonalizationBundle\Model\Document\Targeting\TargetingDocumentDaoInterface;
use Pimcore\Model\Document\Editable;

/**
 * @internal
 *
 * @method TargetingDocumentDaoInterface getDao()
 */
trait TargetDocumentTrait
{
    /**
     * @internal
     */
    private ?int $useTargetGroup = null;

    public function setUseTargetGroup(?int $useTargetGroup = null): void
    {
        $this->useTargetGroup = $useTargetGroup;
    }

    public function getUseTargetGroup(): ?int
    {
        return $this->useTargetGroup;
    }

    public function getTargetGroupEditablePrefix(?int $targetGroupId = null): string
    {
        $prefix = '';

        if (!$targetGroupId) {
            $targetGroupId = $this->getUseTargetGroup();
        }

        if ($targetGroupId) {
            $prefix = self::TARGET_GROUP_EDITABLE_PREFIX . $targetGroupId . self::TARGET_GROUP_EDITABLE_SUFFIX;
        }

        return $prefix;
    }

    public function getTargetGroupEditableName(string $name): string
    {
        if (!$this->getUseTargetGroup()) {
            return $name;
        }

        $prefix = $this->getTargetGroupEditablePrefix();
        if (!preg_match('/^' . preg_quote($prefix, '/') . '/', $name)) {
            $name = $prefix . $name;
        }

        return $name;
    }

    public function hasTargetGroupSpecificEditables(): bool
    {
        return $this->getDao()->hasTargetGroupSpecificEditables();
    }

    public function getTargetGroupSpecificEditableNames(): array
    {
        return $this->getDao()->getTargetGroupSpecificEditableNames();
    }

    public function setEditable(Editable $editable): static
    {
        if ($this->getUseTargetGroup()) {
            $name = $this->getTargetGroupEditableName($editable->getName());
            $editable->setName($name);
        }

        parent::setEditable($editable);

        return $this;
    }

    /**
     * Get an editable with the given key/name
     *
     *
     */
    public function getEditable(string $name): ?Editable
    {
        // check if a target group is requested for this page, if yes deliver a different version of the editable (prefixed)
        if ($this->getUseTargetGroup()) {
            $targetGroupEditableName = $this->getTargetGroupEditableName($name);

            if ($editable = parent::getEditable($targetGroupEditableName)) {
                return $editable;
            } else {
                // if there's no dedicated content for this target group, inherit from the "original" content (unprefixed)
                // and mark it as inherited so it is clear in the ui that the content is not specific to the selected target group
                // replace all occurrences of the target group prefix, this is needed because of block-prefixes
                $inheritedName = str_replace($this->getTargetGroupEditablePrefix(), '', $name);
                $inheritedEditable = parent::getEditable($inheritedName);

                if ($inheritedEditable) {
                    $inheritedEditable = clone $inheritedEditable;
                    $inheritedEditable->setDao(null);
                    $inheritedEditable->setName($targetGroupEditableName);
                    $inheritedEditable->setInherited(true);

                    $this->setEditable($inheritedEditable);

                    return $inheritedEditable;
                }
            }
        }

        // delegate to default
        return parent::getEditable($name);
    }

    public function __sleep(): array
    {
        $finalVars = [];
        $parentVars = parent::__sleep();

        $blockedVars = ['useTargetGroup'];

        foreach ($parentVars as $key) {
            if (!in_array($key, $blockedVars)) {
                $finalVars[] = $key;
            }
        }

        return $finalVars;
    }
}
