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

namespace Pimcore\Bundle\PersonalizationBundle;

use Pimcore\Bundle\AdminBundle\PimcoreAdminBundle;
use Pimcore\Bundle\PersonalizationBundle\DependencyInjection\Compiler\DebugStopwatchPass;
use Pimcore\Bundle\PersonalizationBundle\DependencyInjection\Compiler\TargetingOverrideHandlersPass;
use Pimcore\Bundle\PersonalizationBundle\DependencyInjection\PimcorePersonalizationExtension;
use Pimcore\Extension\Bundle\AbstractPimcoreBundle;
use Pimcore\Extension\Bundle\PimcoreBundleAdminClassicInterface;
use Pimcore\Extension\Bundle\Traits\BundleAdminClassicTrait;
use Pimcore\Extension\Bundle\Traits\PackageVersionTrait;
use Pimcore\HttpKernel\Bundle\DependentBundleInterface;
use Pimcore\HttpKernel\BundleCollection\BundleCollection;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

class PimcorePersonalizationBundle extends AbstractPimcoreBundle implements PimcoreBundleAdminClassicInterface, DependentBundleInterface
{
    use BundleAdminClassicTrait;
    use PackageVersionTrait;

    protected function getComposerPackageName(): string
    {
        return 'pimcore/personalization-bundle';
    }

    public function getContainerExtension(): ExtensionInterface
    {
        return new PimcorePersonalizationExtension();
    }

    public function getCssPaths(): array
    {
        return [
            '/bundles/pimcorepersonalization/css/icons.css',
            '/bundles/pimcorepersonalization/css/targeting.css',
        ];
    }

    public function getJsPaths(): array
    {
        return [
            '/bundles/pimcorepersonalization/js/startup.js',
            '/bundles/pimcorepersonalization/js/settings/condition/abstract.js',
            '/bundles/pimcorepersonalization/js/settings/conditions.js',
            '/bundles/pimcorepersonalization/js/settings/action/abstract.js',
            '/bundles/pimcorepersonalization/js/settings/actions.js',
            '/bundles/pimcorepersonalization/js/settings/rules/panel.js',
            '/bundles/pimcorepersonalization/js/settings/rules/item.js',
            '/bundles/pimcorepersonalization/js/settings/targetGroups/panel.js',
            '/bundles/pimcorepersonalization/js/settings/targetGroups/item.js',
            '/bundles/pimcorepersonalization/js/settings/targetingtoolbar.js',
            '/bundles/pimcorepersonalization/js/targeting.js',
            '/bundles/pimcorepersonalization/js/document/areatoolbar.js',
            '/bundles/pimcorepersonalization/js/object/classes/data/targetGroup.js',
            '/bundles/pimcorepersonalization/js/object/classes/data/targetGroupMultiselect.js',
            '/bundles/pimcorepersonalization/js/object/tags/targetGroup.js',
            '/bundles/pimcorepersonalization/js/object/tags/targetGroupMultiselect.js',
        ];
    }

    public function getInstaller(): Installer
    {
        return $this->container->get(Installer::class);
    }

    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new TargetingOverrideHandlersPass());
        $container->addCompilerPass(new DebugStopwatchPass());
    }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    public static function registerDependentBundles(BundleCollection $collection): void
    {
        $collection->addBundle(new PimcoreAdminBundle(), 60);
    }
}
