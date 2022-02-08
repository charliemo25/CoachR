<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class SeanceDate extends Constraint
{
    public $message = "La date de séance n'est pas valide";
    public $mode = "strict";

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}