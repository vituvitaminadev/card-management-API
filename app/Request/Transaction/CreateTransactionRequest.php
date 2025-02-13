<?php

declare(strict_types=1);

namespace App\Request\Transaction;

use App\Enum\Transaction\TransactionTypeEnum;
use App\Exception\Card\CardInsufficientBalanceException;
use App\Exception\Card\CardNotFoundException;
use App\Model\Card;
use App\Request\BaseRequest;

class CreateTransactionRequest extends BaseRequest
{
	public function rules(): array
	{
		return [
			'user' => ['required', 'exists:users,id'],
			'card' => ['required', 'exists:cards,id'],
			'description' => ['required', 'string'],
			'type' => ['string', 'in:' . TransactionTypeEnum::valuesAsString()],
			'value' => ['integer', 'required'],
		];
	}

	public function getCard(): Card
	{
		$card = Card::find($this->input('card'));

		if (!$card) {
			throw new CardNotFoundException();
		}

		return $card;
	}

	public function getDescription(): string
	{
		return $this->input('description');
	}

	public function getType(): TransactionTypeEnum
	{
		$type = $this->input('type');

		return match ($type) {
			TransactionTypeEnum::PURCHASE->value => TransactionTypeEnum::PURCHASE,
			TransactionTypeEnum::REFUND->value => TransactionTypeEnum::REFUND
		};
	}

	public function getValue(): int
	{
		$value = (int) $this->input('value');

		if ($value > $this->getCard()->balance) {
			throw new CardInsufficientBalanceException();
		}

		return $value;
	}
}
