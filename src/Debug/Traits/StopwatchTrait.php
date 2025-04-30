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

namespace Pimcore\Bundle\PersonalizationBundle\Debug\Traits;

use Symfony\Component\Stopwatch\Stopwatch;

/**
 * @internal
 *
 * Simple integration into the profiler timeline by adding events to
 * the debug stopwatch. Usage:
 *
 *  - use this trait from a service
 *  - configure the service to use the debug stopwatch if available:
 *
 *         calls:
 *              - [setStopwatch, ['@?debug.stopwatch']]
 */
trait StopwatchTrait
{
    private ?Stopwatch $stopwatch = null;

    public function setStopwatch(?Stopwatch $stopwatch = null): void
    {
        $this->stopwatch = $stopwatch;
    }

    private function startStopwatch(string $name, string $category): void
    {
        if ($this->stopwatch) {
            $this->stopwatch->start($name, $category);
        }
    }

    private function stopStopwatch(string $name): void
    {
        if ($this->stopwatch) {
            $this->stopwatch->stop($name);
        }
    }
}
