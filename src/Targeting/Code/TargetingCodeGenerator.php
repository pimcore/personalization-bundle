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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting\Code;

use Pimcore\Bundle\PersonalizationBundle\Event\Targeting\TargetingCodeEvent;
use Pimcore\Bundle\PersonalizationBundle\Event\TargetingEvents;
use Pimcore\Bundle\PersonalizationBundle\Targeting\Model\VisitorInfo;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class TargetingCodeGenerator
{
    const BLOCK_BEFORE_SCRIPT_TAG = 'beforeScriptTag';

    const BLOCK_BEFORE_SCRIPT = 'beforeScript';

    const BLOCK_AFTER_SCRIPT = 'afterScript';

    const BLOCK_AFTER_SCRIPT_TAG = 'afterScriptTag';

    private EventDispatcherInterface $eventDispatcher;

    private EngineInterface $templatingEngine;

    private array $blocks = [
        self::BLOCK_BEFORE_SCRIPT_TAG,
        self::BLOCK_BEFORE_SCRIPT,
        self::BLOCK_AFTER_SCRIPT,
        self::BLOCK_AFTER_SCRIPT_TAG,
    ];

    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        EngineInterface $templatingEngine
    ) {
        $this->eventDispatcher = $eventDispatcher;
        $this->templatingEngine = $templatingEngine;
    }

    public function generateCode(VisitorInfo $visitorInfo): string
    {
        $data = [
            'inDebugMode' => \Pimcore::inDebugMode(),
            'dataProviderKeys' => $visitorInfo->getFrontendDataProviders(),
        ];

        $event = new TargetingCodeEvent(
            '@PimcorePersonalization/Targeting/targetingCode.html.twig',
            $this->buildCodeBlocks(),
            $data
        );

        $this->eventDispatcher->dispatch($event, TargetingEvents::TARGETING_CODE);

        return $this->renderTemplate($event);
    }

    private function renderTemplate(TargetingCodeEvent $event): string
    {
        $data = $event->getData();
        $data['blocks'] = $event->getBlocks();

        $code = $this->templatingEngine->render(
            $event->getTemplate(),
            $data
        );

        $code = trim($code);

        return $code;
    }

    private function buildCodeBlocks(): array
    {
        $blocks = [];
        foreach ($this->blocks as $block) {
            $blocks[$block] = new CodeBlock();
        }

        return $blocks;
    }
}
