<?php

namespace App\AcmeBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Controller that handles the login and logout procedure to and from the main
 * KWI website.
 */
class LoginController extends AbstractController
{

    /**
     * @Template("Test:Login:login.html.twig")
     */
    public function loginAction(): array
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // Render the login form.
        return array();
    }

    public function securityCheckAction(): void
    { }

    public function logoutAction(): void
    { }
}
