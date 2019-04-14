<?php

namespace App\AcmeBundle\Validator\Constraints;

use Carbon\Traits\Test;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\ConstraintValidator;

class AuthorizationValidator extends ConstraintValidator
{
    private $security;

    /**
     * Construct this validator
     *
     * @param Security $sec the 'security.helper' service in order to decide
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function validate($test, Constraint $constraint): void
    {
        if (!($test instanceof Test)) {
            return;
        }

        if ($this->security->isGranted('TEST_ADD')) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->addViolation();
    }
}
