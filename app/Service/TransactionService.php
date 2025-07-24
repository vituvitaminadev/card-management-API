<?php

declare(strict_types=1);

namespace App\Service;

use App\Enum\Transaction\TransactionTypeEnum;
use App\Model\Card;
use App\Model\Transaction;
use App\Model\User;
use function Hyperf\Support\make;

class TransactionService
{
	public function __construct() {}

	public static function instantiate(): self
	{
		return make(self::class);
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

		$this->handleCardBalanceChange($card, $type, $value);

		return $transaction->load('user', 'card');
	}

	private function handleCardBalanceChange(Card $card, TransactionTypeEnum $type, int $value): void
	{
		if ($type === TransactionTypeEnum::FundsIn) {
			CardService::instantiate()->fundsIn($card, $value);
			return;
		}

		CardService::instantiate()->fundsOut($card, $value);
	}
}
