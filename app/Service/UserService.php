<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\User;
use Hyperf\Collection\Collection;

use function Hyperf\Support\make;

class UserService
{
	public function __construct() {}

	public static function instantiate(): self
	{
		return make(self::class);
	}

	public function list(): Collection
	{
		return User::with('cards', 'heldCards')->get();
	}
}
