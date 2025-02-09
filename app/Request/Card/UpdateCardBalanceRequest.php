<?php

declare(strict_types=1);

namespace App\Request\Card;

class UpdateCardBalanceRequest extends BaseCardRequest
{
	protected bool $onlyAdmin = true;

	public function rules(): array
	{
		return [
			'balance' => 'required|integer|gt:0',
		];
	}

	public function getBalance(): int
	{
		return (int) $this->input('balance');
	}
}
