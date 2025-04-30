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

namespace Pimcore\Bundle\PersonalizationBundle\EventListener;

use Pimcore\Bundle\AdminBundle\Event\IndexActionSettingsEvent;

class IndexSettingsListener
{
    public function indexSettings(IndexActionSettingsEvent $settingsEvent): void
    {
        $settingsEvent->addSetting('maxmind_geoip_installed', (bool) \Pimcore::getContainer()->getParameter('pimcore.geoip.db_file'));
    }
}
