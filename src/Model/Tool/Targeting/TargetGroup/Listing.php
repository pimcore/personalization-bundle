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

namespace Pimcore\Bundle\PersonalizationBundle\Model\Tool\Targeting\TargetGroup;

use Pimcore\Bundle\PersonalizationBundle\Model\Tool\Targeting\TargetGroup;
use Pimcore\Model;

/**
 * @internal
 *
 * @method Listing\Dao getDao()
 * @method TargetGroup[] load()
 * @method TargetGroup|false current()
 */
class Listing extends Model\Listing\AbstractListing
{
    /**
     * @param TargetGroup[] $targetGroups
     *
     * @return $this
     */
    public function setTargetGroups(array $targetGroups): static
    {
        return $this->setData($targetGroups);
    }

    /**
     * @return TargetGroup[]
     */
    public function getTargetGroups(): array
    {
        return $this->getData();
    }
}
