<?php

declare(strict_types=1);

namespace App\Resource;

use App\Model\User;
use Hyperf\Resource\Json\JsonResource;

/**
 * @mixin User
 */
class UserResource extends JsonResource
{
	public function toArray(): array
	{
		$user = [
			'id' => $this->id,
			'name' => $this->name,
			'email' => $this->email,
			'document' => $this->document,
			'type' => $this->type,
			'created_at' => $this->created_at,
		];

		if ($this->relationLoaded('cards')) {
			$user['cards'] = CardResource::collection($this->cards);
		}

		if ($this->relationLoaded('heldCards')) {
			$user['heldCards'] = CardResource::collection($this->heldCards);
		}

		if ($this->relationLoaded('transactions')) {
			$user['transactions'] = TransactionResource::collection($this->transactions);
		}

		return $user;
	}
}
