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
use Pimcore\Model\Document;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Redirect implements ActionHandlerInterface
{
    public function apply(VisitorInfo $visitorInfo, array $action, ?Rule $rule = null): void
    {
        $url = $action['url'] ?? null;
        if (!$url) {
            return;
        }

        $request = $visitorInfo->getRequest();

        // only redirect GET requests
        if ($request->getMethod() !== 'GET') {
            return;
        }

        // don't redirect multiple times to avoid loops
        if (!empty($request->get('_ptr'))) {
            return;
        }

        if (is_numeric($url)) {
            $document = Document::getById($url);
            if (!$document) {
                return;
            }

            $url = $document->getRealFullPath();
        }

        if ($rule) {
            $url = $this->addUrlParam($url, '_ptr', $rule->getId());
        } else {
            $url = $this->addUrlParam($url, '_ptr', 0);
        }

        $code = $action['code'] ?? RedirectResponse::HTTP_FOUND;

        $visitorInfo->setResponse(new RedirectResponse($url, $code));
    }

    private function addUrlParam(string $url, string $param, int $value): string
    {
        // add _ptr parameter
        if (false !== strpos($url, '?')) {
            $url .= '&';
        } else {
            $url .= '?';
        }

        $url .= sprintf('%s=%d', $param, $value);

        return $url;
    }
}
