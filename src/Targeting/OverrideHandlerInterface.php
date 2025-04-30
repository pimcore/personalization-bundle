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

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface for override handlers which can influence the debug toolbar form and override
 * targeting data based on form results.
 */
interface OverrideHandlerInterface
{
    const REQUEST_ATTRIBUTE = 'pimcore_targeting_overrides';

    /**
     * Add fields to the targeting toolbar override form
     */
    public function buildOverrideForm(FormBuilderInterface $form, Request $request): void;

    /**
     * Override targeting data from the override data as gathered from the form
     */
    public function overrideFromRequest(array $overrides, Request $request): void;
}
