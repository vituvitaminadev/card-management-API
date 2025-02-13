<?php

declare(strict_types=1);

namespace App\Trait;

trait EnumTrait
{
	public static function availableCases(): array
	{
		return array_map(fn($case) => $case->value, self::cases());
	}

	public static function valuesAsString(): string
	{
		return implode(',', self::availableCases());
	}
}
