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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting\ActionHandler;

use Pimcore\Bundle\PersonalizationBundle\Model\Tool\Targeting\Rule;
use Pimcore\Bundle\PersonalizationBundle\Targeting\Model\VisitorInfo;
use Pimcore\Http\Response\CodeInjector;
use Symfony\Component\HttpFoundation\Response;

class CodeSnippet implements ActionHandlerInterface, ResponseTransformingActionHandlerInterface
{
    private CodeInjector $codeInjector;

    public function __construct(CodeInjector $codeInjector)
    {
        $this->codeInjector = $codeInjector;
    }

    public function apply(VisitorInfo $visitorInfo, array $action, ?Rule $rule = null): void
    {
        $code = $action['code'] ?? '';
        $selector = $action['selector'] ?? '';
        $position = $action['position'] ?? '';

        if (empty($code) || empty($selector) || empty($position)) {
            return;
        }

        $visitorInfo->addAction([
            'type' => 'codesnippet',
            'scope' => VisitorInfo::ACTION_SCOPE_RESPONSE,
            'code' => $code,
            'selector' => $selector,
            'position' => $position,
        ]);
    }

    public function transformResponse(VisitorInfo $visitorInfo, Response $response, array $actions): void
    {
        foreach ($actions as $action) {
            $this->codeInjector->inject(
                $response,
                $action['code'],
                $action['selector'],
                $action['position']
            );
        }
    }
}
