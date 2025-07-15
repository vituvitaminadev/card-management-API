<?php

declare(strict_types=1);

namespace App\Service;

use App\Enum\Card\CardStatusEnum;
use App\Model\Card;
use App\Model\User;
use function Hyperf\Support\make;

class CardService
{
	public function __construct() {}

	public static function instantiate(): self
	{
		return make(self::class);
	}

	public function create(User $user, string $alias): Card
	{
		$card = Card::create([
			'user_id' => $user->id,
			'holder_id' => $user->id,
			'alias' => $alias,
			'status' => CardStatusEnum::BLOCKED->value,
			'balance' => 0,
		]);

		return $card->load('user', 'holder');
	}

	public function associate(Card $card, User $holder): Card
	{
		$card->update([
			'holder_id' => $holder->id,
		]);

		$card->refresh();

		return $card;
	}

	public function unblock(Card $card): Card
	{
		$card->update([
			'status' => CardStatusEnum::ACTIVE->value,
		]);

		return $card;
	}

	public function block(Card $card): Card
	{
		$card->update([
			'status' => CardStatusEnum::BLOCKED->value,
		]);

		return $card;
	}

	public function fundsIn(Card $card, int $value): Card
	{
		$card->update([
			'balance' => $card->balance + $value,
		]);

		return $card;
	}

	public function fundsOut(Card $card, int $value): Card
	{
		$card->update([
			'balance' => $card->balance - $value,
		]);

		return $card;
	}
}
