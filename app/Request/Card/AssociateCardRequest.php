<?php

declare(strict_types=1);

namespace App\Request\Card;

class AssociateCardRequest extends BaseCardRequest
{
	protected bool $onlyAdmin = true;

	public function rules(): array
	{
		return [
			'card' => ['required', 'exists:cards,id'],
			'holder' => ['required', 'exists:users,id'],
		];
	}
}
