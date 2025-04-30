<?php

/**
 * This source file is available under the terms of the
 * Pimcore Open Core License (POCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (https://www.pimcore.com)
 *  @license    Pimcore Open Core License (POCL)
 */

namespace Pimcore\Bundle\PersonalizationBundle\Model\Document\Snippet;

use Pimcore\Bundle\PersonalizationBundle\Model\Document\Targeting\TargetingDocumentDaoInterface;
use Pimcore\Bundle\PersonalizationBundle\Model\Document\Targeting\TargetingDocumentDaoTrait;
use Pimcore\Model;

/**
 * @internal
 *
 * @property \Pimcore\Bundle\PersonalizationBundle\Model\Document\Snippet $model
 */
class Dao extends Model\Document\Snippet\Dao implements TargetingDocumentDaoInterface
{
    use TargetingDocumentDaoTrait;
}
