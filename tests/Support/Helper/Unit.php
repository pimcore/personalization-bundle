<?php

namespace Pimcore\Bundle\PersonalizationBundle\Tests\Support\Helper;

use Pimcore\Bundle\PersonalizationBundle\Installer;
use Pimcore\Tests\Support\Helper\Pimcore;
use Pimcore\Db;

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
