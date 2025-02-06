<?php

namespace App\Request\Card;

use App\Exception\User\UserNotFoundException;
use App\Model\User;

class AssociateCardRequest extends BaseCardRequest
{
    protected bool $onlyAdmin = true;

    public function rules(): array
    {
        return [
            'card' => 'required|exists:cards,id',
            'holder' => 'required|exists:users,id'
        ];
    }
}
