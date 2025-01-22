<?php

namespace App\Application\Constraint;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class ConstraintErrorListConverter
{
    public function convert(ConstraintViolationListInterface $errorList): array
    {
        $errors = [];
        if (count($errorList) > 0) {
            foreach ($errorList as $error) {
                $errors[] = [
                    'property' => $error->getPropertyPath(),
                    'message'  => $error->getMessage(),
                ];
            }
        }
        return $errors;
    }
}