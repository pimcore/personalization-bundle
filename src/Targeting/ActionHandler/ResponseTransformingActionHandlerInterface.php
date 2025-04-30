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

use Pimcore\Bundle\PersonalizationBundle\Targeting\Model\VisitorInfo;
use Symfony\Component\HttpFoundation\Response;

interface ResponseTransformingActionHandlerInterface
{
    /**
     * Applies previously recorded actions to the response
     */
    public function transformResponse(VisitorInfo $visitorInfo, Response $response, array $actions): void;
}
