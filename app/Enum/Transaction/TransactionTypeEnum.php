<?php

declare(strict_types=1);

namespace App\Enum\Transaction;

use App\Trait\EnumTrait;

enum TransactionTypeEnum: string
{
	use EnumTrait;

	case Purchase = 'purchase';
	case Refund = 'refund';
	case FundsIn = 'funds-in';
}
