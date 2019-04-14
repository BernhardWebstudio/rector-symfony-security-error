<?php

namespace App\AcmeBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Authorization extends Constraint
{
    public $message = "unauthorized.test";

    public function getTargets(): string
    {
        // apply on Test
        return self::CLASS_CONSTRAINT;
    }
}
