<?php

namespace App\Request\Card;

use App\Exception\Card\CardNotFoundException;
use App\Exception\User\UserNotFoundException;
use App\Model\Card;
use App\Model\User;
use App\Request\BaseRequest;

class BaseCardRequest extends BaseRequest
{
    public function getCard(): Card
    {
        $card = Card::with('holder', 'user')->find($this->input('card') ?? $this->route('id'));

        if (!$card) {
            throw new CardNotFoundException();
        }

        return $card;
    }

    public function getHolder(): User
    {
        $user = User::find($this->input('holder'));

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
