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

namespace Pimcore\Bundle\PersonalizationBundle\DependencyInjection\Compiler;

use Pimcore\Bundle\PersonalizationBundle\Targeting\Debug\OverrideHandler;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\PriorityTaggedServiceTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @internal
 */
final class TargetingOverrideHandlersPass implements CompilerPassInterface
{
    use PriorityTaggedServiceTrait;

    public function process(ContainerBuilder $container): void
    {
        $handlers = $this->findAndSortTaggedServices('pimcore_personalization.targeting.override_handler', $container);

        $overrideHandler = $container->getDefinition(OverrideHandler::class);
        $overrideHandler->setArgument('$overrideHandlers', $handlers);
    }
}
