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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting\Condition;

use Pimcore\Bundle\PersonalizationBundle\Event\TargetingEvents;
use Pimcore\Bundle\PersonalizationBundle\Targeting\DataProvider\VisitedPagesCounter;
use Pimcore\Bundle\PersonalizationBundle\Targeting\DataProviderDependentInterface;
use Pimcore\Bundle\PersonalizationBundle\Targeting\Model\VisitorInfo;
use Pimcore\Bundle\PersonalizationBundle\Targeting\Service\VisitedPagesCounter as VisitedPagesCounterService;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class VisitedPagesBefore extends AbstractVariableCondition implements DataProviderDependentInterface, EventDispatchingConditionInterface
{
    private int $count;

    public function __construct(int $count)
    {
        $this->count = $count;
    }

    public static function fromConfig(array $config): static
    {
        return new static($config['number'] ?? 0);
    }

    public function getDataProviderKeys(): array
    {
        return [VisitedPagesCounter::PROVIDER_KEY];
    }

    public function canMatch(): bool
    {
        return $this->count > 0;
    }

    public function match(VisitorInfo $visitorInfo): bool
    {
        /** @var VisitedPagesCounterService $counter */
        $counter = $visitorInfo->get(VisitedPagesCounter::PROVIDER_KEY);
        $count = $counter->getCount($visitorInfo);

        if ($count >= $this->count) {
            $this->setMatchedVariable('visited_pages_count', $count);

            return true;
        }

        return false;
    }

    public function postMatch(VisitorInfo $visitorInfo, EventDispatcherInterface $eventDispatcher): void
    {
        // emit event which instructs VisitedPagesCountListener to increment the count after matching
        $eventDispatcher->dispatch(new GenericEvent(), TargetingEvents::VISITED_PAGES_COUNT_MATCH);
    }

    public function preMatch(VisitorInfo $visitorInfo, EventDispatcherInterface $eventDispatcher): void
    {
        // noop
    }
}
