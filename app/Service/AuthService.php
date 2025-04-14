<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\Auth\InvalidCredentialsException;
use App\Exception\Auth\UnauthorizedException;
use App\Model\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Hyperf\Context\Context;
use Throwable;

use function Hyperf\Config\config;
use function Hyperf\Support\make;

class AuthService
{
	private const CONTEXT_KEY = 'jwt_token';

	private string $secretKey;

	public function __construct()
	{
		$this->secretKey = config('app_secret');
	}

	public static function instantiate(): self
	{
		return make(self::class);
	}

	public function signUp(array $data): User
	{
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'document' => $data['document'],
			'password' => password_hash($data['password'], PASSWORD_BCRYPT),
			'type' => $data['type'],
		]);
	}

	public function signIn(?User $user, array $data): string
	{
		if (!$user || !password_verify($data['password'], $user->password)) {
			throw new InvalidCredentialsException();
		}

		return $this->issueToken($user);
	}

	public function decodeToken(string $token): ?object
	{
		try {
			return JWT::decode($token, new Key($this->secretKey, 'HS256'));
		} catch (Throwable) {
			return null;
		}
	}

	public function getLoggedUser(): User
	{
		try {
			$token = Context::get(self::CONTEXT_KEY);

			return User::findOrFail($token->sub);
		} catch (Throwable) {
			throw new UnauthorizedException();
		}
	}

	private function issueToken(User $user): string
	{
		$payload = $this->getTokenData($user);

		return JWT::encode($payload, $this->secretKey, 'HS256');
	}

	private function getTokenData(User $user): array
	{
		return [
			'iss' => config('app_url'),
			'aud' => config('app_url'),
			'iat' => time(),
			'nbf' => time(),
			'exp' => time() + 3600,
			'sub' => $user->id,
			'type' => $user->type,
		];
	}
}
