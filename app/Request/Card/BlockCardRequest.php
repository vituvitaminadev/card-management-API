<?php

declare(strict_types=1);

namespace App\Request\Card;

class BlockCardRequest extends BaseCardRequest
{
    protected bool $onlyAdmin = true;

    public function rules(): array
    {
        return [];
    }
}
