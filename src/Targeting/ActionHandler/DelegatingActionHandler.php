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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting\ActionHandler;

use Pimcore\Bundle\PersonalizationBundle\Model\Tool\Targeting\Rule;
use Pimcore\Bundle\PersonalizationBundle\Targeting\DataLoaderInterface;
use Pimcore\Bundle\PersonalizationBundle\Targeting\DataProviderDependentInterface;
use Pimcore\Bundle\PersonalizationBundle\Targeting\Model\VisitorInfo;
use Psr\Container\ContainerInterface;

class DelegatingActionHandler implements ActionHandlerInterface
{
    private ContainerInterface $actionHandlers;

    private DataLoaderInterface $dataLoader;

    public function __construct(
        ContainerInterface $actionHandlers,
        DataLoaderInterface $dataLoader
    ) {
        $this->actionHandlers = $actionHandlers;
        $this->dataLoader = $dataLoader;
    }

    public function apply(VisitorInfo $visitorInfo, array $action, ?Rule $rule = null): void
    {
        /** @var string $type */
        $type = $action['type'] ?? null;

        if (empty($type)) {
            throw new \InvalidArgumentException('Invalid action: type is not set');
        }

        $actionHandler = $this->getActionHandler($type);

        // load data providers if necessary
        if ($actionHandler instanceof DataProviderDependentInterface) {
            $this->dataLoader->loadDataFromProviders($visitorInfo, $actionHandler->getDataProviderKeys());
        }

        $actionHandler->apply($visitorInfo, $action, $rule);
    }

    public function hasActionHandler(string $type): bool
    {
        return $this->actionHandlers->has($type);
    }

    public function getActionHandler(string $type): ActionHandlerInterface
    {
        if (!$this->actionHandlers->has($type)) {
            throw new \InvalidArgumentException(sprintf(
                'Invalid condition: there is no action handler registered for type "%s"',
                $type
            ));
        }

        return $this->actionHandlers->get($type);
    }
}
