<?php

namespace App\Infrastructure\Symfony\Validator\Constraints;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute(Attribute::TARGET_PROPERTY)]
class EntityExist extends Constraint
{
    public string $message = 'Entity "{{ entity }}" with property "{{ property }}": "{{ value }}" does not exist.';
    public string $entity;
    public string $property;

    public function __construct(string $entity, string $property = 'id', ?string $message = null, ?array $groups = null)
    {
        $this->message = $message ?? $this->message;
        $options       = ['entity' => $entity, 'property' => $property];
        parent::__construct($options, $groups);
    }

    public function getRequiredOptions(): array
    {
        return ['entity', 'property'];
    }
}