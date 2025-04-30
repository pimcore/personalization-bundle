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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting\EventListener\Frontend;

use Pimcore\Bundle\PersonalizationBundle\Targeting\Document\DocumentTargetingConfigurator;
use Pimcore\Event\DocumentEvents;
use Pimcore\Event\Model\DocumentEvent;
use Pimcore\Http\Request\Resolver\DocumentResolver;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Handles block state for sub requests (saves parent state and restores it after request completes)
 *
 * @internal
 */
class TargetingDocumentRendererListener implements EventSubscriberInterface
{
    public function __construct(
        private DocumentTargetingConfigurator $targetingConfigurator,
        protected DocumentResolver $documentResolver
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            DocumentEvents::RENDERER_PRE_RENDER => 'onPreRender',
            DocumentEvents::INCLUDERENDERER_PRE_RENDER => 'onPreRender',
        ];
    }

    public function onPreRender(DocumentEvent $event): void
    {
        $document = $event->getDocument();
        $this->targetingConfigurator->configureTargetGroup($document);
    }
}
