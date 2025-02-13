<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\User\ListUserRequest;
use App\Resource\UserResource;
use App\Service\UserService;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class UserController
{
	public function __construct(protected readonly UserService $userService) {}

	public function list(ListUserRequest $request): PsrResponseInterface
	{
		$users = $this->userService->list();

		return UserResource::collection($users)->toResponse();
	}
}
