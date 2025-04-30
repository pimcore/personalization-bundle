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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting\Debug;

use Pimcore\Bundle\PersonalizationBundle\Targeting\OverrideHandlerInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class OverrideHandler
{
    private FormFactoryInterface $formFactory;

    /**
     * @var OverrideHandlerInterface[]
     */
    private iterable $overrideHandlers;

    /**
     * @param OverrideHandlerInterface[] $overrideHandlers
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        array $overrideHandlers
    ) {
        $this->formFactory = $formFactory;
        $this->overrideHandlers = $overrideHandlers;
    }

    public function getForm(Request $request): FormInterface
    {
        if ($request->attributes->has('pimcore_targeting_override_form')) {
            /** @var FormInterface $form */
            $form = $request->attributes->get('pimcore_targeting_override_form');

            return $form;
        }

        $form = $this->buildForm($request);

        $request->attributes->set('pimcore_targeting_override_form', $form);

        return $form;
    }

    protected function buildForm(Request $request): FormInterface
    {
        $formBuilder = $this->formFactory->createNamedBuilder('_ptg_overrides', FormType::class, null, [
            'csrf_protection' => false,
        ]);

        $formBuilder->setMethod('GET');

        foreach ($this->overrideHandlers as $handler) {
            $handler->buildOverrideForm($formBuilder, $request);
        }

        return $formBuilder->getForm();
    }

    public function handleRequest(Request $request): void
    {
        $form = $this->getForm($request);

        $this->handleForm($form, $request);
    }

    public function handleForm(FormInterface $form, Request $request): void
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if (!empty($data)) {
                foreach ($this->overrideHandlers as $handler) {
                    $handler->overrideFromRequest($data, $request);
                }
            }
        }
    }
}
