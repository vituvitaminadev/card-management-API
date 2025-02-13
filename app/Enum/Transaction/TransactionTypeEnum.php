<?php

declare(strict_types=1);

namespace App\Enum\Transaction;

use App\Trait\EnumTrait;

enum TransactionTypeEnum: string
{
	use EnumTrait;

	case PURCHASE = 'purchase';
	case REFUND = 'refund';
}
