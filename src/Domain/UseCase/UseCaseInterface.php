<?php

namespace Fira\Domain\UseCase;

interface UseCaseInterface
{
    public function validate(): void;

    public function execute();
}