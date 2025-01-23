<?php

namespace App\Application\Request\Dto;

interface RequestInterface
{
    public function getCarId(): int;

    public function getLoanProgramId(): int;

    public function getInitialPayment(): float;

    public function getLoanTerm(): int;
}