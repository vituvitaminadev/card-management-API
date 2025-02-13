<?php

declare(strict_types=1);

namespace App\Resource;

use App\Model\Transaction;
use Hyperf\Resource\Json\JsonResource;

/**
 * @mixin Transaction
 */
class TransactionResource extends JsonResource
{
	public function toArray(): array
	{
		$transaction = [
			'id' => $this->id,
			'description' => $this->description,
			'type' => $this->type,
			'value' => $this->value,
		];

		if ($this->relationLoaded('user')) {
			$transaction['user'] = UserResource::make($this->getUser());
		}

		if ($this->relationLoaded('card')) {
			$transaction['card'] = CardResource::make($this->getCard());
		}

		return $transaction;
	}
}
