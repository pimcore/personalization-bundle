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

namespace Pimcore\Bundle\PersonalizationBundle\Model\Tool\Targeting\Rule;

use Pimcore\Bundle\PersonalizationBundle\Model\Tool\Targeting\Rule;
use Pimcore\Model;

/**
 * @internal
 *
 * @method Listing\Dao getDao()
 * @method Rule[] load()
 * @method Rule|false current()
 */
class Listing extends Model\Listing\AbstractListing
{
    /**
     * @param Rule[] $targets
     *
     * @return $this
     */
    public function setTargets(array $targets): static
    {
        return $this->setData($targets);
    }

    /**
     * @return Rule[]
     */
    public function getTargets(): array
    {
        return $this->getData();
    }
}
