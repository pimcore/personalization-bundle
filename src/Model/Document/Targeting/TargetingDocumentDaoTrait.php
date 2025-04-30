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

use Pimcore\Model\Document\PageSnippet;

/**
 * @internal
 */
trait TargetingDocumentDaoTrait
{
    public function hasTargetGroupSpecificEditables(): bool
    {
        /** @var PageSnippet\Dao $this */
        $count = $this->db->fetchOne(
            'SELECT count(*) FROM documents_editables WHERE documentId = ? AND name LIKE ?',
            [
                $this->model->getId(),
                '%' . TargetingDocumentInterface::TARGET_GROUP_EDITABLE_PREFIX . '%' . TargetingDocumentInterface::TARGET_GROUP_EDITABLE_SUFFIX . '%',
            ]
        );

        return $count > 0;
    }

    public function getTargetGroupSpecificEditableNames(): array
    {
        /** @var PageSnippet\Dao $this */
        $names = $this->db->fetchFirstColumn(
            'SELECT name FROM documents_editables WHERE documentId = ? AND name LIKE ?',
            [
                $this->model->getId(),
                '%' . TargetingDocumentInterface::TARGET_GROUP_EDITABLE_PREFIX . '%' . TargetingDocumentInterface::TARGET_GROUP_EDITABLE_SUFFIX . '%',
            ]
        );

        return $names;
    }
}
