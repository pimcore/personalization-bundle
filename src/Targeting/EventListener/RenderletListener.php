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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting\EventListener;

use Pimcore\Bundle\PersonalizationBundle\Model\Document\Targeting\TargetingDocumentInterface;
use Pimcore\Bundle\PersonalizationBundle\Model\Tool\Targeting\TargetGroup;
use Pimcore\Event\DocumentEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * Handles target groups configured on the document settings panel. If a document
 * has configured target groups, the assign_target_group will be manually called
 * for that target group before starting to match other conditions.
 */
class RenderletListener implements EventSubscriberInterface
{
    /**
     * @return string[]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            DocumentEvents::EDITABLE_RENDERLET_PRE_RENDER => 'configureElementTargeting',
        ];
    }

    public function configureElementTargeting(GenericEvent $event): void
    {
        $requestParams = $event->getArgument('requestParams');
        $element = $event->getArgument('element');
        if (!$element instanceof TargetingDocumentInterface) {
            return;
        }

        // set selected target group on element
        if ($requestParams['_ptg'] ?? false) {
            $targetGroup = TargetGroup::getById((int)$requestParams['_ptg']);
            if ($targetGroup) {
                $element->setUseTargetGroup($targetGroup->getId());
            }
        }
    }
}
