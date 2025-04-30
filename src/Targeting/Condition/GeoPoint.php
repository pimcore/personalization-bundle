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

use Location\Coordinate;
use Location\Distance\Haversine;
use Pimcore\Bundle\PersonalizationBundle\Targeting\DataProvider\GeoLocation;
use Pimcore\Bundle\PersonalizationBundle\Targeting\DataProviderDependentInterface;
use Pimcore\Bundle\PersonalizationBundle\Targeting\Model\GeoLocation as GeoLocationModel;
use Pimcore\Bundle\PersonalizationBundle\Targeting\Model\VisitorInfo;

class GeoPoint extends AbstractVariableCondition implements DataProviderDependentInterface
{
    private ?float $latitude;

    private ?float $longitude;

    private ?int $radius;

    public function __construct(?float $latitude = null, ?float $longitude = null, ?int $radius = null)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->radius = $radius;
    }

    public static function fromConfig(array $config): static
    {
        return new static(
            $config['latitude'] ? (float)$config['latitude'] : null,
            $config['longitude'] ? (float)$config['longitude'] : null,
            $config['radius'] ? (int)$config['radius'] : null
        );
    }

    public function getDataProviderKeys(): array
    {
        return [GeoLocation::PROVIDER_KEY];
    }

    public function canMatch(): bool
    {
        return !empty($this->latitude) && !empty($this->longitude) && !empty($this->radius);
    }

    public function match(VisitorInfo $visitorInfo): bool
    {
        /** @var GeoLocationModel|null $location */
        $location = $visitorInfo->get(GeoLocation::PROVIDER_KEY);

        if (!$location) {
            return false;
        }

        $distance = $this->calculateDistance(
            $this->latitude,
            $this->longitude,
            $location->getLatitude(),
            $location->getLongitude()
        );

        if ($distance < ($this->radius * 1000)) {
            $this->setMatchedVariables([
                'latitude' => $location->getLatitude(),
                'longitude' => $location->getLongitude(),
            ]);

            return true;
        }

        return false;
    }

    private function calculateDistance(float $latA, float $longA, float $latB, float $longB): float
    {
        $coordA = new Coordinate($latA, $longA);
        $coordB = new Coordinate($latB, $longB);

        return (new Haversine())->getDistance($coordA, $coordB);
    }
}
