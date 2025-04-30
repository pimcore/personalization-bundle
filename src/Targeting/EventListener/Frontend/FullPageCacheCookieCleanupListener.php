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

namespace Pimcore\Bundle\PersonalizationBundle\Targeting\EventListener\Frontend;

use Pimcore\Bundle\PersonalizationBundle\Targeting\Service\TargetingEnableService;
use Pimcore\Bundle\PersonalizationBundle\Targeting\Storage\CookieStorage;
use Pimcore\Event\Cache\FullPage\PrepareResponseEvent;
use Pimcore\Event\FullPageCacheEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Removes cookie storage cookies from cached response (only from the response object, not
 * from the client's browser).
 */
class FullPageCacheCookieCleanupListener implements EventSubscriberInterface
{
    private TargetingEnableService $targetingEnableService;

    public function __construct(
        TargetingEnableService $targetingEnableService
    ) {
        $this->targetingEnableService = $targetingEnableService;
    }

    /**
     * @return string[]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            FullPageCacheEvents::PREPARE_RESPONSE => 'onPrepareFullPageCacheResponse',
        ];
    }

    public function onPrepareFullPageCacheResponse(PrepareResponseEvent $event): void
    {
        if (!$this->targetingEnableService->isTargetingEnabled()) {
            return;
        }
        $response = $event->getResponse();
        $cookies = $response->headers->getCookies();

        $blocklist = [
            CookieStorage::COOKIE_NAME_VISITOR,
            CookieStorage::COOKIE_NAME_SESSION,
        ];

        foreach ($cookies as $cookie) {
            if (in_array($cookie->getName(), $blocklist)) {
                $response->headers->removeCookie(
                    $cookie->getName(),
                    $cookie->getPath(),
                    $cookie->getDomain()
                );
            }
        }
    }
}
