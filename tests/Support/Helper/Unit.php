<?php

/**
 * This source file is available under the terms of the
 * Pimcore Open Core License (POCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (https://www.pimcore.com)
 *  @license    Pimcore Open Core License (POCL)
 */

namespace Pimcore\Bundle\PersonalizationBundle\Tests\Support\Helper;

use Pimcore\Bundle\PersonalizationBundle\Installer;
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

        $installer = $pimcoreModule->getContainer()->get(Installer::class);
        $installer->install();
    }
}
