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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting\Debug\Override;

use Pimcore\Bundle\PersonalizationBundle\Targeting\Debug\Form\DeviceType;
use Pimcore\Bundle\PersonalizationBundle\Targeting\Debug\Util\OverrideAttributeResolver;
use Pimcore\Bundle\PersonalizationBundle\Targeting\OverrideHandlerInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;

class DeviceOverrideHandler implements OverrideHandlerInterface
{
    public function buildOverrideForm(FormBuilderInterface $form, Request $request): void
    {
        $form->add('device', DeviceType::class, [
            'label' => 'Device',
            'required' => false,
            'attr' => [
                'class' => '_ptgtb__override-form__collapse-section',
            ],
        ]);
    }

    public function overrideFromRequest(array $overrides, Request $request): void
    {
        $device = $overrides['device'] ?? [];
        if (empty($device)) {
            return;
        }

        OverrideAttributeResolver::setOverrideValue($request, 'device', $device);
    }
}
