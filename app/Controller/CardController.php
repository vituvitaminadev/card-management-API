<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\Card\AssociateCardRequest;
use App\Request\Card\BlockCardRequest;
use App\Request\Card\CreateCardRequest;
use App\Request\Card\UnblockCardRequest;
use App\Request\Card\UpdateCardBalanceRequest;
use App\Resource\CardResource;
use App\Service\CardService;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class CardController
{
	public function __construct(protected readonly CardService $cardService) {}

	public function create(CreateCardRequest $request): PsrResponseInterface
	{
		$card = $this->cardService->create($request->getUser(), $request->getAlias());

		return CardResource::make($card)->toResponse();
	}

	public function associate(AssociateCardRequest $request): PsrResponseInterface
	{
		$card = $this->cardService->associate($request->getCard(), $request->getHolder());

		return CardResource::make($card)->toResponse();
	}

	public function unblock(UnblockCardRequest $request): PsrResponseInterface
	{
		$card = $this->cardService->unblock($request->getCard());

		return CardResource::make($card)->toResponse();
	}

	public function block(BlockCardRequest $request): PsrResponseInterface
	{
		$card = $this->cardService->block($request->getCard());

		return CardResource::make($card)->toResponse();
	}

	public function balance(UpdateCardBalanceRequest $request): PsrResponseInterface
	{
		$card = $this->cardService->balance($request->getCard(), $request->getBalance());

		return CardResource::make($card)->toResponse();
	}
}
