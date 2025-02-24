<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\Transaction\CreateTransactionRequest;
use App\Request\Transaction\ListTransactionRequest;
use App\Resource\TransactionResource;
use App\Service\TransactionService;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class TransactionController
{
	public function __construct(protected readonly TransactionService $transactionService)
	{
	}

    public function index(ListTransactionRequest $request): PsrResponseInterface
    {
        $request->applyFilters();
        $transactions = $request->applySort()->paginate();

        return TransactionResource::collection($transactions)->toResponse();
    }

	public function create(CreateTransactionRequest $request): PsrResponseInterface
	{
		$transaction = TransactionService::instantiate()->create(
			$request->getUser(),
			$request->getCard(),
			$request->getDescription(),
			$request->getType(),
			$request->getValue()
		);

		return TransactionResource::make($transaction)->toResponse();
	}
}
