<?php

namespace App\Request\Card;

class UpdateCardBalanceRequest extends BaseCardRequest
{
    protected bool $onlyAdmin = true;

    public function rules(): array
    {
        return [
            'balance' => 'required|integer|gte:0'
        ];
    }

    public function getBalance(): int
    {
        return $this->input('balance');
    }
}
