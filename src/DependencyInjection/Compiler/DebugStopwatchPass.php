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

use Pimcore\Bundle\PersonalizationBundle\Targeting\DataLoader;
use Pimcore\Bundle\PersonalizationBundle\Targeting\Debug\TargetingDataCollector;
use Pimcore\Bundle\PersonalizationBundle\Targeting\EventListener\TargetingListener;
use Pimcore\Bundle\PersonalizationBundle\Targeting\VisitorInfoResolver;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * The debug.stopwatch service is always defined, so we can't just add it to services if defined. This
 * only adds the stopwatch to services if the debug flag is set.
 *
 * @internal
 */
final class DebugStopwatchPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $debug = $container->getParameter('kernel.debug');
        if (!$debug) {
            return;
        }

        if (!$container->hasDefinition('debug.stopwatch')) {
            return;
        }

        $services = [
            DataLoader::class,
            VisitorInfoResolver::class,
            TargetingListener::class,
            TargetingDataCollector::class,
        ];

        foreach ($services as $service) {
            if ($container->hasDefinition($service)) {
                $container
                    ->getDefinition($service)
                    ->addMethodCall('setStopwatch', [
                        new Reference(
                            'debug.stopwatch',
                            ContainerInterface::IGNORE_ON_INVALID_REFERENCE
                        ),
                    ]);
            }
        }
    }
}
