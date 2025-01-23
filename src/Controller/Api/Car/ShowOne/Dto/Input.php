<?php

namespace App\Controller\Api\Car\ShowOne\Dto;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use App\Infrastructure\Symfony\Validator\Constraints as AppAssert;
#[Assert\GroupSequence(['Input', 'g1', 'g2', 'g3'])]
class Input
{
    #[Assert\Type(type: 'numeric', groups: ['g1'])]
    #[Assert\Positive(groups: ['g2'])]
    #[AppAssert\EntityExist(
        entity: 'App\Entity\Car',
        property: 'id',
        message: 'Машина с указанным ID не найдена',
        groups: ['g3']
    )]
    private ?string $id;

    public function __construct(Request $request)
    {
        $this->id = $request->get('id');
    }

    public function getId(): int
    {
        return $this->id;
    }
}