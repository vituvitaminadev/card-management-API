<?php

declare(strict_types=1);

namespace App\Exception\Card;

use App\Enum\ExceptionMessageCodeEnum;
use App\Exception\AbstractException;
use Swoole\Http\Status;

class CardInsufficientBalanceException extends AbstractException
{
	public function __construct()
	{
		$code = Status::PAYMENT_REQUIRED;
		$message = ExceptionMessageCodeEnum::INSUFFICIENT_BALANCE;
		parent::__construct($message, $code);
	}
}
