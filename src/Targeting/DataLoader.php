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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting;

use Pimcore\Bundle\PersonalizationBundle\Debug\Traits\StopwatchTrait;
use Pimcore\Bundle\PersonalizationBundle\Targeting\DataProvider\DataProviderInterface;
use Pimcore\Bundle\PersonalizationBundle\Targeting\Model\VisitorInfo;
use Psr\Container\ContainerInterface;

class DataLoader implements DataLoaderInterface
{
    use StopwatchTrait;

    private ContainerInterface $dataProviders;

    public function __construct(ContainerInterface $dataProviders)
    {
        $this->dataProviders = $dataProviders;
    }

    public function loadDataFromProviders(VisitorInfo $visitorInfo, array|string $providerKeys): void
    {
        if (!is_array($providerKeys)) {
            $providerKeys = [(string)$providerKeys];
        }

        foreach ($providerKeys as $providerKey) {
            $loadedProviders = $visitorInfo->get('_data_providers', []);

            // skip already loaded providers to avoid circular reference loops
            if (in_array($providerKey, $loadedProviders)) {
                continue;
            }

            $loadedProviders[] = $providerKey;
            $visitorInfo->set('_data_providers', $loadedProviders);

            $dataProvider = $this->dataProviders->get($providerKey);

            // load data from required providers
            if ($dataProvider instanceof DataProviderDependentInterface) {
                $this->loadDataFromProviders(
                    $visitorInfo,
                    $dataProvider->getDataProviderKeys()
                );
            }

            $this->startStopwatch('Targeting:load:' . $providerKey, 'targeting');

            $dataProvider->load($visitorInfo);

            $this->stopStopwatch('Targeting:load:' . $providerKey);
        }
    }

    public function hasDataProvider(string $type): bool
    {
        return $this->dataProviders->has($type);
    }

    public function getDataProvider(string $type): DataProviderInterface
    {
        if (!$this->dataProviders->has($type)) {
            throw new \InvalidArgumentException(sprintf(
                'There is no data provider registered for type "%s"',
                $type
            ));
        }

        return $this->dataProviders->get($type);
    }
}
