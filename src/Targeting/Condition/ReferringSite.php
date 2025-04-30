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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting\Condition;

use Pimcore\Bundle\PersonalizationBundle\Targeting\Model\VisitorInfo;

class ReferringSite extends AbstractVariableCondition implements ConditionInterface
{
    private ?string $pattern = null;

    public function __construct(?string $pattern = null)
    {
        $this->pattern = $pattern;
    }

    public static function fromConfig(array $config): static
    {
        return new static($config['referrer'] ?? null);
    }

    public function canMatch(): bool
    {
        return !empty($this->pattern);
    }

    public function match(VisitorInfo $visitorInfo): bool
    {
        $request = $visitorInfo->getRequest();
        $referrer = $request->headers->get('Referer', 'direct');

        $result = preg_match($this->pattern, $referrer);
        if ($result) {
            $this->setMatchedVariable('referrer', $referrer);

            return true;
        }

        return false;
    }
}
