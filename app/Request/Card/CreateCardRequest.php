<?php

declare(strict_types=1);

namespace App\Request\Card;

use App\Request\BaseRequest;

class CreateCardRequest extends BaseRequest
{
	protected bool $onlyAdmin = true;

	public function rules(): array
	{
		return [
			'alias' => ['required', 'string'],
		];
	}

	public function getAlias(): string
	{
		return $this->input('alias');
	}
}
