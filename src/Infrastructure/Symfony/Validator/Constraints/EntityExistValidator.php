<?php

namespace App\Infrastructure\Symfony\Validator\Constraints;

use Doctrine\ORM\EntityManagerInterface;
use LogicException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class EntityExistValidator extends ConstraintValidator
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function validate($value, Constraint $constraint): void
    {
        if ($value === null) {
            return;
        }

        if (!$constraint instanceof EntityExist) {
            throw new LogicException(
                sprintf('You can only pass %s constraint to this validator.', EntityExist::class)
            );
        }

        $entity = $this->entityManager->getRepository($constraint->entity)->findOneBy(
            [
                $constraint->property => $value,
            ]
        );

        if ($entity === null) {
            $this->context->buildViolation($constraint->message)
                          ->setParameter('{{ entity }}', $constraint->entity)
                          ->setParameter('{{ property }}', $constraint->property)
                          ->setParameter('{{ value }}', $value)
                          ->addViolation();
        }
    }
}