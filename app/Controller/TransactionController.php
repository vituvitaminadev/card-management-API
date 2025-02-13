<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\Transaction\CreateTransactionRequest;
use App\Resource\TransactionResource;
use App\Service\TransactionService;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class TransactionController
{
	public function __construct(protected readonly TransactionService $transactionService)
	{
	}

	public function create(CreateTransactionRequest $request): PsrResponseInterface
	{
		$transaction = $this->transactionService->create(
			$request->getUser(),
			$request->getCard(),
			$request->getDescription(),
			$request->getType(),
			$request->getValue()
		);

		return TransactionResource::make($transaction)->toResponse();
	}
}
