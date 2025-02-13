<?php

declare(strict_types=1);

namespace App\Service;

use App\Enum\Transaction\TransactionTypeEnum;
use App\Model\Card;
use App\Model\Transaction;
use App\Model\User;

class TransactionService
{
	private function __construct() {
	}

	public static function instantiate(): self
	{
	return new self();
	}

	public function create(User $user, Card $card, string $description, TransactionTypeEnum $type, int $value): Transaction
	{
		$transaction = Transaction::create([
			'user_id' => $user->id,
			'card_id' => $card->id,
			'description' => $description,
			'type' => $type->value,
			'value' => $value,
		]);

		CardService::instantiate()->fundsOut($card, $value);

		return $transaction->load('user', 'card');
	}
}
