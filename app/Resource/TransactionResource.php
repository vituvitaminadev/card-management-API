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
		return [];
	}
}
