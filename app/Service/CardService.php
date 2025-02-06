<?php

namespace App\Service;

use App\Enum\Card\CardStatusEnum;
use App\Model\Card;
use App\Model\User;

class CardService
{
    public function create(User $user, string $alias): Card
    {
        return Card::with('user', 'holder')->create([
            'user_id' => $user->id,
            'holder_id' => $user->id,
            'alias' => $alias,
            'status' => CardStatusEnum::BLOCKED->value,
            'balance' => 0
        ]);
    }

    public function associate(Card $card, User $holder): Card
    {
       $card->update([
            'holder_id' => $holder->id
       ]);

       $card->refresh();

       return $card;
    }

    public function unblock(Card $card): Card
    {
        $card->update([
            'status' => CardStatusEnum::ACTIVE->value
        ]);

        return $card;
    }

    public function balance(Card $card, int $balance): Card
    {
        $card->update([
            'balance' => $card->balance +$balance
        ]);

        return $card;
    }
}
