<?php

namespace App\Acme2Bundle\Validator\Constraints;

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
        if ($this->security->isGranted('TEST_ADD')) {
            return;
        }

        if (!$this->security->isGranted('TEST_ADD_BASIC')) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
