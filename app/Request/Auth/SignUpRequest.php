<?php

namespace App\Request\Auth;

use App\Enum\User\UserTypeEnum;
use Hyperf\Validation\Request\FormRequest;

class SignUpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['string', 'required'],
            'email' => ['string', 'required', 'email', 'unique:users'],
            'document' => ['string', 'required', 'unique:users'],
            'password' => ['string', 'required'],
            'passwordConfirmation' => ['string', 'required', 'same:password'],
            'type' => ['string', 'in:' . UserTypeEnum::valuesAsString()]
        ];
    }
}
