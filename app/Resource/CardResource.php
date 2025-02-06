<?php

namespace App\Resource;

use App\Model\Card;
use Hyperf\Resource\Json\JsonResource;

/**
 * @mixin Card
 */
class CardResource extends JsonResource
{
    public function toArray(): array
    {
        $card = [
            'id' => $this->id,
            'alias' => $this->alias,
            'status' => $this->status,
            'balance' => $this->balance,
        ];

        if ($this->relationLoaded('user')) {
            $card['user'] = UserResource::make($this->user);
        }

        if ($this->relationLoaded('holder')) {
            $card['holder'] = UserResource::make($this->holder);
        }

        return $card;
    }
}
