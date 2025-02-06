<?php

namespace App\Request\Card;

class UnblockCardRequest extends BaseCardRequest
{
    protected bool $onlyAdmin = true;

    public function rules(): array
    {
        return [];
    }
}
