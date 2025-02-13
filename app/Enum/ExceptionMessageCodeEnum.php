<?php

declare(strict_types=1);

namespace App\Enum;

enum ExceptionMessageCodeEnum: string
{
	case INVALID_CREDENTIALS = 'invalid_credentials';
	case UNAUTHORIZED = 'unauthorized';
	case USER_NOT_FOUND = 'user_not_found';
	case CARD_NOT_FOUND = 'card_not_found';
	case INSUFFICIENT_BALANCE = 'card_insufficient_balance';
}
