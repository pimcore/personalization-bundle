<?php

/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Commercial License (PCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 *  @license    http://www.pimcore.org/license     GPLv3 and PCL
 */

namespace Pimcore\Bundle\PersonalizationBundle\Tests\Support\Helper;

use Pimcore\Bundle\PersonalizationBundle\Installer;
use Pimcore\Db;
use Pimcore\Tests\Support\Helper\Pimcore;

class Unit extends \Codeception\Module
{
    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function _beforeSuite($settings = [])
    {

        /** @var Pimcore $pimcoreModule */
        $pimcoreModule = $this->getModule('\\' . Pimcore::class);

        //create migrations table in order to allow installation - needed for SettingsStoreAware Installer

        Db::get()->executeStatement('
            create table migration_versions
            (
                version varchar(1024) not null
                    primary key,
                executed_at datetime null,
                execution_time int null
            )
            collate=utf8_unicode_ci;
            ');

        $installer = $pimcoreModule->getContainer()->get(Installer::class);
        $installer->install();
    }
}
