<?php

namespace App\AcmeBundle\Mixin;

use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

/**
 * SecurityMixin can be used to restrict certain content to certain groups by
 * as an HTML Element
 */
class SecurityMixin extends TestMixin
{
    protected $tag_name = 'security';
    protected $security;

    public function __construct(AuthorizationChecker $auth)
    {
        $this->security = $auth;
    }

    protected function applyToElement(\DOMElement &$element): void
    {
        // correct names to accept and understand multiple variations
        $allowed_groups = $element->getAttribute('is-granted');
        $denied = true;
        foreach ($allowed_groups as $role) {
            if ($this->security->isGranted($role)) {
                $denied = false;
                break;
            }
        }

        if ($denied) {
            // remove node as it is not granted to be viewed
            $element->parentNode->removeChild($element);
        } else {
            // granted, but just in case, remove list of granted roles
            $element->removeAttribute('is-granted');
        }
    }

    /**
     * As different users need to see different things, the cache must be user aware,
     * but it isn't, so no, we ain't support cache with this mixin. At least for now.
     *
     * @return bool
     */
    public function supportsCache(): bool
    {
        return false;
    }
}
