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

use Pimcore\Bundle\PersonalizationBundle\Targeting\DataProvider\GeoIp;
use Pimcore\Bundle\PersonalizationBundle\Targeting\DataProviderDependentInterface;
use Pimcore\Bundle\PersonalizationBundle\Targeting\Model\VisitorInfo;

class Country extends AbstractVariableCondition implements DataProviderDependentInterface
{
    private ?string $country = null;

    public function __construct(?string $country = null)
    {
        $this->country = $country;
    }

    public static function fromConfig(array $config): static
    {
        return new static($config['country'] ?? null);
    }

    public function getDataProviderKeys(): array
    {
        return [GeoIp::PROVIDER_KEY];
    }

    public function canMatch(): bool
    {
        return !empty($this->country);
    }

    public function match(VisitorInfo $visitorInfo): bool
    {
        $city = $visitorInfo->get(GeoIp::PROVIDER_KEY);

        if (!$city || ! isset($city['country'])) {
            return false;
        }

        if ($city['country']['iso_code'] === $this->country) {
            $this->setMatchedVariable('iso_code', $city['country']['iso_code']);

            return true;
        }

        return false;
    }
}
