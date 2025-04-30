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

namespace Pimcore\Bundle\PersonalizationBundle\Event\Targeting;

use Pimcore\Bundle\PersonalizationBundle\Model\Tool\Targeting\TargetGroup;
use Pimcore\Bundle\PersonalizationBundle\Targeting\Model\VisitorInfo;
use Pimcore\Model\Document;

class AssignDocumentTargetGroupEvent extends TargetingEvent
{
    private Document $document;

    private TargetGroup $targetGroup;

    public function __construct(VisitorInfo $visitorInfo, Document $document, TargetGroup $targetGroup)
    {
        parent::__construct($visitorInfo);

        $this->document = $document;
        $this->targetGroup = $targetGroup;
    }

    public function getDocument(): Document
    {
        return $this->document;
    }

    public function getTargetGroup(): TargetGroup
    {
        return $this->targetGroup;
    }
}
