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

use Pimcore\Bundle\PersonalizationBundle\Model\Tool\Targeting\TargetGroup;
use Pimcore\Bundle\PersonalizationBundle\Targeting\Document\DocumentTargetingConfigurator;
use Pimcore\Bundle\PersonalizationBundle\Targeting\OverrideHandlerInterface;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;

class DocumentTargetingOverrideHandler implements OverrideHandlerInterface
{
    private DocumentTargetingConfigurator $documentTargetingConfigurator;

    public function __construct(DocumentTargetingConfigurator $documentTargetingConfigurator)
    {
        $this->documentTargetingConfigurator = $documentTargetingConfigurator;
    }

    public function buildOverrideForm(FormBuilderInterface $form, Request $request): void
    {
        $form->add('documentTargetGroup', ChoiceType::class, [
            'label' => 'Document Target Group',
            'required' => false,
            'choice_loader' => new CallbackChoiceLoader(function () {
                return (new TargetGroup\Listing())->load();
            }),
            'choice_value' => function (?TargetGroup $targetGroup = null) {
                return $targetGroup ? $targetGroup->getId() : '';
            },
            'choice_label' => function (?TargetGroup $targetGroup = null) {
                return $targetGroup ? $targetGroup->getName() : '';
            },
        ]);
    }

    public function overrideFromRequest(array $overrides, Request $request): void
    {
        $targetGroup = $overrides['documentTargetGroup'] ?? null;
        if ($targetGroup && $targetGroup instanceof TargetGroup) {
            $this->documentTargetingConfigurator->setOverrideTargetGroup($targetGroup);
        }
    }
}
