<?php

namespace App\Validator;

use App\Entity\Seance;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class SeanceDateValidator extends ConstraintValidator
{

    /**
     * Undocumented function
     *
     * @param Seance $seance
     * @param Constraint $constraint
     * @return void
     */
    public function validate($seance, Constraint $constraint)
    {
        if(!$seance->getBegin()){
            $this->context->buildViolation($constraint->message)
                ->atPath(SeanceDate::class)
                ->addViolation();
        }
    }
}