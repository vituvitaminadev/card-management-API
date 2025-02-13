<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\User;
use Hyperf\Collection\Collection;

class UserService
{
	private function __construct() {}

	public static function instantiate(): self
	{
		return new self();
	}

	public function list(): Collection
	{
		return User::with('cards', 'heldCards')->get();
	}
}
