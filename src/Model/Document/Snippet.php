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

namespace Pimcore\Bundle\PersonalizationBundle\Model\Document;

use Pimcore\Bundle\PersonalizationBundle\Model\Document\Targeting\TargetingDocumentInterface;
use Pimcore\Bundle\PersonalizationBundle\Model\Document\Traits\TargetDocumentTrait;

/**
 * @method \Pimcore\Bundle\PersonalizationBundle\Model\Document\Snippet\Dao getDao()
 */
class Snippet extends \Pimcore\Model\Document\Snippet implements TargetingDocumentInterface
{
    use TargetDocumentTrait;

    protected string $type = 'snippet';
}
