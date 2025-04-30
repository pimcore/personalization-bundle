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

use Pimcore\Bundle\PersonalizationBundle\Targeting\DataProvider\Device;
use Pimcore\Bundle\PersonalizationBundle\Targeting\DataProviderDependentInterface;
use Pimcore\Bundle\PersonalizationBundle\Targeting\Model\VisitorInfo;

class OperatingSystem extends AbstractVariableCondition implements DataProviderDependentInterface
{
    private ?string $system = null;

    /**
     * Mapping from admin UI values to DeviceDetector results
     *
     */
    protected static array $osMapping = [
        'MAC' => 'macos',
        'WIN' => 'windows',
        'LIN' => 'linux',
        'AND' => 'android',
        'IOS' => 'ios',
    ];

    public function __construct(?string $system = null)
    {
        $this->system = $system;
    }

    public static function fromConfig(array $config): static
    {
        return new static($config['system'] ?? null);
    }

    public function getDataProviderKeys(): array
    {
        return [Device::PROVIDER_KEY];
    }

    public function canMatch(): bool
    {
        return !empty($this->system);
    }

    public function match(VisitorInfo $visitorInfo): bool
    {
        $device = $visitorInfo->get(Device::PROVIDER_KEY);

        if (!$device || true === ($device['is_bot'] ?? false)) {
            return false;
        }

        $osInfo = $device['os'] ?? null;
        if (!$osInfo) {
            return false;
        }

        $os = $osInfo['short_name'] ?? null;
        if (!empty($os) && isset(static::$osMapping[$os])) {
            $os = static::$osMapping[$os];
        }

        if ($this->matchesOperatingSystem($os)) {
            $this->setMatchedVariable('os', $os);

            return true;
        }

        return false;
    }

    private function matchesOperatingSystem(?string $os = null): bool
    {
        if (empty($os)) {
            return false;
        }

        if ('all' === $this->system) {
            return true;
        }

        return $os === $this->system;
    }
}
