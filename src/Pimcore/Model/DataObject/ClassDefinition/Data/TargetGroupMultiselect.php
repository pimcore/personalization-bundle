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

namespace Pimcore\Model\DataObject\ClassDefinition\Data;

use Pimcore\Bundle\PersonalizationBundle\Model\Tool;
use Pimcore\Model;
use Pimcore\Model\DataObject\ClassDefinition\Service;

class TargetGroupMultiselect extends Model\DataObject\ClassDefinition\Data\Multiselect
{
    /**
     * @internal
     */
    public function configureOptions(): void
    {
        /** @var Tool\Targeting\TargetGroup\Listing|Tool\Targeting\TargetGroup\Listing\Dao $list */
        $list = new Tool\Targeting\TargetGroup\Listing();
        $list->setOrder('asc');
        $list->setOrderKey('name');

        $targetGroups = $list->load();

        $options = [];
        foreach ($targetGroups as $targetGroup) {
            $options[] = [
                'value' => $targetGroup->getId(),
                'key'   => $targetGroup->getName(),
            ];
        }

        $this->setOptions($options);
    }

    public static function __set_state(array $data): static
    {
        $obj = parent::__set_state($data);
        if (\Pimcore::inAdmin()) {
            $obj->configureOptions();
        }

        return $obj;
    }

    public function jsonSerialize(): mixed
    {
        if (Service::doRemoveDynamicOptions()) {
            $this->options = null;
        }

        return parent::jsonSerialize();
    }

    public function resolveBlockedVars(): array
    {
        $blockedVars = parent::resolveBlockedVars();
        $blockedVars[] = 'options';

        return $blockedVars;
    }

    public function getFieldType(): string
    {
        return 'targetGroupMultiselect';
    }

    public function __wakeup(): void
    {
        $this->init();
    }

    /**
     * @return $this
     *
     * @internal
     *
     */
    private function init(): static
    {
        $options = $this->getOptions();
        if (empty($options)) {
            $this->configureOptions();
        }

        return $this;
    }
}
